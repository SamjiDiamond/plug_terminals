<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\AirtimeProviders;
use App\Models\BillsHistory;
use App\Models\Business;
use App\Models\ElectricityProviders;
use App\Models\InternetData;
use App\Models\InternetProviders;
use App\Models\Transaction;
use App\Models\TvBouquet;
use App\Models\TvProviders;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BillsPaymentController extends Controller
{
    // Fetch airtime provider List
    public function airtimeProviders(){

        $lists = AirtimeProviders::where(['status' => 1])->get();
        return response()->json(['success' => true, 'message' => 'Fetched', 'data' => $lists->makeHidden(['id', 'c_cent', 'api_cent', 'status', 'created_at', 'updated_at'])]);
    }

    // Airtime Topup
    public function airtimeTopup(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'provider' => 'required|string',
            'number' => 'required',
            'amount' => 'required|numeric',
            'reference' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        Log::info("Airtime Order Incoming Request ". json_encode($input));

        $business = Business::where(["id" => Auth::user()->business_id])->first();

        if(!$business){
            return response()->json(['success' => false, 'message' => 'Business does not exist or does not belongs to you.']);
        }

        Log::info("Business Authenticated on Airtime Order Request [Business: ID - ".$business->id." & Name - ".$business->name."]");

        $wallet = wallet::where('user_id', Auth::id())->first();

        if(!$wallet){
            return response()->json(['success' => false, 'message' => 'Invalid wallet or user']);
        }

        //Check if reference already exist in user account
        $check_ref = BillsHistory::where(["business_id" => $business->id, 'api_req_id'=>$input['reference']])->first();
        if ($check_ref) {
            return response()->json(['success' => false, 'message' => 'Reference order already existed']);
        }

        //check for max and min amount for by the provider
        $network = AirtimeProviders::where(['provider' => $input['provider']])->first();
        $amount=$input['amount'];

        // for api (when you order from api)
        $discount = ($network->api_cent / 100) * $amount;
        $total = $amount - $discount;
        // for dashboard (when you order from dashboard)
        // $discount = ($network->c_cent / 100) * $request->amount;
        // $total = $request->amount - $discount;

        if($amount < $network->minAmount){
            $min = number_format($network->minAmount,2);
            return response()->json(['success' => false, 'message' => 'Amount below the minimum Topup of NGN'.$min]);
        }

        $netcode = "mtn";

        switch ($network->provider) {
            case "9MOBILE":
                $netcode = "etisalat";
                break;
            default:
                $netcode = strtolower($network->provider);
        }

        if ($wallet->balance < 1) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance. Kindly topup and try again']);
        }

        if ($total > $wallet->balance) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance. Kindly topup your wallet']);
        }

        // charge user
        $current_bal = $wallet->balance;
        $wallet->balance -= $total;
        $wallet->save();

        $url = env('VTPASS_URL');
        $phone = $input['number'];

        $trx = Carbon::now()->format('YmdHi') . rand();

        $payload='{"request_id": "' . $trx . '", "serviceID": "' . $netcode . '","amount": "' . $amount . '","number": "' . $phone . '","phone": "' . $phone . '"}';

        Log::info("Attempting Airtime Order [User ID - ".Auth::id()." & Name - ".$business->name."]".json_encode($payload));

        if(env('BILLS_DOMAIN') == "live") {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url . "pay",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . env('VTPASS_AUTH'),
                    'Content-Type: application/json'
                ),
            ));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);
        }else{
            $response='{"code":"000","content":{"transactions":{"status":"delivered","product_name":"MTN Airtime VTU","unique_element":"08166939205","unit_price":100,"quantity":1,"service_verification":null,"channel":"api","commission":3,"total_amount":97,"discount":null,"type":"Airtime Recharge","email":"pe@bud.africa","phone":"+2347040143618","name":null,"convinience_fee":0,"amount":100,"platform":"api","method":"api","transactionId":"16587467846558859747618899"}},"response_description":"TRANSACTION SUCCESSFUL","requestId":"2022072510591055905068","amount":"100.00","transaction_date":{"date":"2022-07-25 11:59:44.000000","timezone_type":3,"timezone":"Africa\/Lagos"},"purchased_code":""}';
        }


        $res = json_decode($response, true);

        Log::info("Airtime Order Response [User: ID - ".Auth::id()." & Name - ".Auth::user()->name."]".json_encode($res));

        if ($res['code'] == '000'){

            //log transaction history

            //activity log

            //log bill history
            $bill['business_id'] = $business->id;
            $bill['user_id'] = Auth::id();
            $bill['service_type'] = "airtime";
            $bill['provider'] = $input['provider'];
            $bill['recipient'] = $input['number'];
            $bill['amount'] = $amount;
            $bill['discount'] = $discount;
            $bill['fee'] = 0;
            $bill['voucher'] = 0;
            $bill['paid'] = $total;
            $bill['init_bal'] = $current_bal;
            $bill['new_bal'] = $wallet->balance;
            $bill['currency'] = "NGN";
            $bill['trx'] = $trx;
            $bill['ref'] = $res['content']['transactions']['transactionId'];
            $bill['api_req_id'] = $input['reference'];
            $bill['channel'] = "API";
            $bill['domain'] = env('BILLS_DOMAIN');
            $bill['status'] = $res['content']['transactions']['status'];
            $bill['errorMsg'] = $res['response_description'];
            BillsHistory::create($bill);

            Transaction::create([
                'business_id' => Auth::user()->business_id,
                'user_id' => Auth::id(),
                'uuid' => Auth::user()->uuid,
                'reference' => $trx,
                'type' => 'debit',
                'remark' => "NGN $request->amount ".$input['provider']." Airtime Purchase Was Successful To ".$phone,
                'amount' => $amount,
                'previous' => $current_bal,
                'balance' => $wallet->balance
            ]);

            Log::notice("Airtime Order Successful [Business: ID - ".$business->id." & Name - ".$business->name."]");

            return response()->json(['success' => true, 'message' => 'Airtime Purchase was successful', 'data' => $trx]);
        }else{

            // balance auto reverse
            $wallet=Wallet::find($wallet->id);
            $wallet->balance = $current_bal;
            $wallet->save();

            Log::alert("Airtime Order Failed [Business: ID - ".$business->id." & Name - ".$business->name."]");

            return response()->json(['success' => false, 'message' => 'Unable to Process this Transaction at the moment, Try again later']);
        }
    }

    // Fetch internet provider List
    public function internetProviders(){

        $lists = InternetProviders::where(['status' => 1])->get();
        return response()->json(['success' => true, 'message' => 'Providers fetched successfully', 'data' => $lists->makeHidden(['c_cent', 'api_cent', 'status', 'created_at', 'updated_at'])]);
    }


    // Fetch internet plans
    public function internetDataPlan($provider){
        $pd = InternetProviders::where(['provider'=>$provider])->first();
        if(!$pd){
            return response()->json(['success' => false, 'message' => 'Invalid Internet Provider supplied']);
        }
        $lists = InternetData::where(['ip_id'=>$pd->id,'status' => 1])->get();
        return response()->json(['success' => true, 'message' => 'Internet Data Plans Fetched successfully', 'data' => $lists->makeHidden(['ip_id', 'type', 'code', 'c_cent', 'api_cent', 'price', 'status', 'created_at', 'updated_at'])]);
    }

    // Order Internet Service
    public function internetData(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'provider' => 'required|numeric',
            'plan_id' => 'required|numeric',
            'number' => 'required|string',
            'reference' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        Log::info("Internet Order Incoming Request ".json_encode($request->all()));

        $reference = $input['reference'];

        $business = Business::where(["id" => Auth::user()->business_id])->first();

        if(!$business){
            return response()->json(['success' => false, 'message' => 'Business does not exist or does not belongs to you.', 'error' => $validator->errors()]);
        }

        Log::info("Business Authenticated on Internet Order Request [Business: ID - ".$business->id." & Name - ".$business->name."]");

        $wallet = wallet::where('user_id', Auth::id())->first();

        if(!$wallet){
            return response()->json(['success' => false, 'message' => 'Invalid wallet or user']);
        }

        //Check if reference already exist in user account
        $check_ref = BillsHistory::where(["business_id" => $business->id, 'api_req_id'=>$reference])->first();
        if ($check_ref) {
            return response()->json(['success' => false, 'message' => 'Reference order already existed']);
        }

        //check for data plan pricing by the provider
        $network = InternetProviders::where(['id' => $input['provider']])->first();
        if (!$network) {
            return response()->json(['success' => false, 'message' => 'Invalid Provider ID provided']);
        }
        $plan = InternetData::where(['status' => 1, 'ip_id' => $network->id, 'id' => $input['plan_id']])->first();
        if (!$plan) {
            return response()->json(['success' => false, 'message' => 'Invalid Plan ID provided']);
        }

        // for api order
        $discount = ($plan->api_cent / 100) * $plan->amount;
        $total = $plan->amount - $discount;
        // for dashboard order
        // $discount = ($plan->c_cent / 100) * $plan->amount;
        // $total = $plan->amount - $discount;

        if ($total > $wallet->balance) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance. Kindly topup your wallet']);
        }

        // charge user
        $current_bal = $wallet->balance;
        $wallet->balance -= $total;
        $wallet->save();

        $url = env('VTPASS_URL');

        $trx = Carbon::now()->format('YmdHi') . rand();

        Log::info("Attempting Internet Order [Business: ID - ".$business->id." & Name - ".$business->name."]".json_encode($request->all()));

        if(env('BILLS_DOMAIN') == "live") {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url . "pay",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"request_id": "' . $trx . '", "serviceID": "' . $plan->type . '","variation_code": "' . $plan->code . '","phone": "' . $input['number'] . '","billersCode": "' . $input['number'] . '"}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . env('VTPASS_AUTH'),
                    'Content-Type: application/json'
                ),
            ));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);

            curl_close($curl);
        }else{
            $response='{"code":"000","content":{"transactions":{"status":"delivered","product_name":"MTN Data","unique_element":"08064002132","unit_price":100,"quantity":1,"service_verification":null,"channel":"api","commission":3,"total_amount":97,"discount":null,"type":"Data Services","email":"pe@bud.africa","phone":"+2347040143618","name":null,"convinience_fee":0,"amount":100,"platform":"api","method":"api","transactionId":"16587478685562605376441262"}},"response_description":"TRANSACTION SUCCESSFUL","requestId":"2022072511171701540998","amount":"100.00","transaction_date":{"date":"2022-07-25 12:17:48.000000","timezone_type":3,"timezone":"Africa\/Lagos"},"purchased_code":""}';
        }


        $res = json_decode($response, true);

        Log::info("Internet Order Response [User: ID - ".Auth::id()." & Name - ".Auth::user()->name."]".json_encode($res));

        if ($res['code'] == '000'){

            //log transaction history

            //activity log

            //log bill history
            $bill['business_id'] = $business->id;
            $bill['user_id'] = Auth::id();
            $bill['service_type'] = "internet";
            $bill['provider'] = $network->provider;
            $bill['recipient'] = $input['number'];
            $bill['amount'] = $plan->amount;
            $bill['discount'] = $discount;
            $bill['fee'] = 0;
            $bill['voucher'] = 0;
            $bill['paid'] = $total;
            $bill['init_bal'] = $current_bal;
            $bill['new_bal'] = $wallet->balance;
            $bill['currency'] = "NGN";
            $bill['trx'] = $trx;
            $bill['ref'] = $res['content']['transactions']['transactionId'];
            $bill['api_req_id'] = $reference;
            $bill['channel'] = "API";
            $bill['domain'] = env('BILLS_DOMAIN');
            $bill['status'] = $res['content']['transactions']['status'];
            $bill['errorMsg'] = $res['response_description'];
            BillsHistory::create($bill);

            Transaction::create([
                'business_id' => Auth::user()->business_id,
                'user_id' => Auth::id(),
                'uuid' => Auth::user()->uuid,
                'reference' => $trx,
                'type' => 'debit',
                'remark' => "$plan->name Purchase Was Successful To ".$input['number'],
                'amount' => $total,
                'previous' => $current_bal,
                'balance' => $wallet->balance
            ]);

            Log::notice("Internet Order Successful [Business: ID - ".$business->id." & Name - ".$business->name."]");

            return response()->json(['success' => true, 'message' => 'Data successful', 'data' => $reference ]);
        }else{

            // balance auto reverse
            $wallet=Wallet::find($wallet->id);
            $wallet->balance = $current_bal;
            $wallet->save();

            Log::alert("Internet Order Failed [Business: ID - ".$business->id." & Name - ".$business->name."]");

            return response()->json(['success' => false, 'message' => 'Unable to Process this Transaction at the moment, Try again later']);
        }
    }

    // Fetch cabletv provider List
    public function cabletvProviders(){

        $lists = TvProviders::where(['status' => 1])->get();
        return response()->json(['success' => true, 'message' => 'Fetched successfully', 'data' => $lists->makeHidden(['id', 'c_cent', 'api_cent', 'status', 'created_at', 'updated_at'])]);
    }

    // Fetch cabletv plans
    public function tvPackages($provider){
        $network = TvProviders::where(['status' => 1, 'provider' => $provider])->first();
        $bouquet = TvBouquet::where(['status' => 1, 'tvp_id' => $network->id])->get();
        return response()->json(['success' => true, 'message' => 'CableTv Packages Fetched successfully', 'data' => $bouquet->makeHidden(['tvp_id', 'type', 'price', 'status', 'created_at', 'updated_at'])]);
    }


    // validate cabletv
    public function tvValidate(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'provider' => 'required|string',
            'number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $domain = "live";

        if($domain == "live"){
            $url = env('VTPASS_URL');
        }else{
            $url = env('VTPASS_URL');
        }

        $code = Str::lower($input['provider']);

        $tv = TvBouquet::where(['status' => 1, 'type' => $code])->first();

        if($input['provider'] != "SHOWMAX"){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url . "merchant-verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"serviceID": "' . $tv->type . '","billersCode": "' . $input['number'] . '"}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . env('VTPASS_AUTH'),
                    'Content-Type: application/json'
                ),
            ));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);

            curl_close($curl);

            $res = json_decode($response, true);

            if(isset($res['content']['error'])){
                return response()->json(['success' => false, 'message' => 'Incorrect SmartCard number. Please try with a correct one']);
            }

            if ($res['code'] == '000'){
                if(isset($res['content']['Customer_Name'])){
                    $Customer_Name = $res['content']['Customer_Name'];
                }else{
                    $Customer_Name =  "";
                }

                return response()->json(['success' => true, 'message' => 'Fetched successfully', 'data' => ['provider' => $input['provider'], 'number' => $input['number'], 'Customer_Name' => $Customer_Name]]);
            }
        }elseif($input['provider'] == "SHOWMAX"){
            $Customer_Name =  NULL;

            return response()->json(['success' => true, 'message' => 'Fetched successfully', 'data' => ['provider' => $input['provider'], 'number' => $input['number'], 'Customer_Name' => $Customer_Name]]);
        }

        return response()->json(['success' => true, 'message' => 'Unable to Verify Smartcard Number at the moment, Try again later']);
    }

    // pay cabletv
    public function payTv(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'provider' => 'required|string',
            'number' => 'required|numeric',
            'code' => 'required',
            'reference' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        Log::info("CableTv Order Incoming Request ".json_encode($request->all()));

        $business = Business::where(["id" => Auth::user()->business_id])->first();

        if(!$business){
            return response()->json(['success' => false, 'message' => 'Business does not exist or does not belongs to you.']);
        }

        Log::info("Business Authenticated on CableTv Order Request [Business: ID - ".$business->id." & Name - ".$business->name."]");

        $wallet = wallet::where('user_id', Auth::id())->first();

        if(!$wallet){
            return response()->json(['success' => false, 'message' => 'Invalid or business is not activated for live transactions'], 401);
        }

        //Check if reference already exist in user account
        $check_ref = BillsHistory::where(["business_id" => $business->id, 'api_req_id'=>$request->reference])->first();
        if ($check_ref) {
            return response()->json(['success' => false, 'message' => 'Reference order already existed']);
        }

        //check for tv plan pricing by the provider
        $network = TvProviders::where(['provider' => $input['provider']])->first();
        if (!$network) {
            return response()->json(['success' => false, 'message' => 'Invalid Provider ID provided']);
        }
        $plan = TvBouquet::where(['status' => 1, 'tvp_id' => $network->id, 'code' => $input['code']])->first();
        if (!$plan) {
            return response()->json(['success' => false, 'message' => 'Invalid Package code provided']);
        }

        // for api order
        $discount = ($network->api_cent / 100) * $plan->amount;
        $total = $plan->amount - $discount;
        // for dashboard order
        // $discount = ($network->c_cent / 100) * $plan->amount;
        // $total = $plan->amount - $discount;

        if ($total > $wallet->balance) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance. Kindly topup your wallet']);
        }

        // charge user
        $current_bal = $wallet->balance;
        $wallet->balance -= $total;
        $wallet->save();

        $url = env('VTPASS_URL');

        $trx = Carbon::now()->format('YmdHi') . rand();

        Log::info("Attempting CableTv Order [Business: ID - ".$business->id." & Name - ".$business->name."]".json_encode($request->all()));

        $phone = $input['number'];


        if(env('BILLS_DOMAIN') == "live") {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url . "pay",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"request_id": "' . $trx . '", "serviceID": "' . strtoupper($plan->type) . '","variation_code": "' . $plan->code . '","amount": "' . $plan->price . '","phone": "' . $phone . '","billersCode": "' . $phone . '"}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . env('VTPASS_AUTH'),
                    'Content-Type: application/json'
                ),
            ));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);

            curl_close($curl);
        }else{
            $response='{ "code":"000", "content":{ "transactions":{ "status":"initiated", "channel":"api", "transactionId":"1563857332996", "method":"api", "platform":"api", "is_api":1, "discount":null, "customer_id":100649, "email":"sandbox@vtpass.com", "phone":"07061933309", "type":"TV Subscription", "convinience_fee":"0.00", "commission":0.75, "amount":"50", "total_amount":49.25, "quantity":1, "unit_price":"50", "updated_at":"2019-07-23 05:48:52", "created_at":"2019-07-23 05:48:52", "id":7349787 } }, "response_description":"TRANSACTION SUCCESSFUL", "requestId":"SAND000001112A9320223291", "amount":"50.00", "transaction_date":{ "date":"2019-07-23 05:48:52.000000", "timezone_type":3, "timezone":"Africa/Lagos" }, "purchased_code":"" }';
        }

        $res = json_decode($response, true);

        Log::info("CableTv Order Response [Business: ID - ".$business->id." & Name - ".$business->name."]".json_encode($res));

        if ($res['code'] == '000'){

            //log transaction history

            //activity log

            //log bill history
            $bill['business_id'] = $business->id;
            $bill['user_id'] = Auth::id();
            $bill['service_type'] = "tv";
            $bill['provider'] = $input['provider'];
            $bill['recipient'] = $phone;
            $bill['amount'] = $plan->amount;
            $bill['discount'] = $discount;
            $bill['fee'] = 0;
            $bill['voucher'] = 0;
            $bill['paid'] = $total;
            $bill['init_bal'] = $current_bal;
            $bill['new_bal'] = $bill['init_bal'] - $bill['paid'];
            $bill['currency'] = "NGN";
            $bill['trx'] = $trx;
            $bill['ref'] = $res['content']['transactions']['transactionId'];
            $bill['api_req_id'] = $input['reference'];
            $bill['channel'] = "API";
            $bill['domain'] = env('BILLS_DOMAIN');
            $bill['status'] = $res['content']['transactions']['status'];
            $bill['errorMsg'] = $res['response_description'];
            BillsHistory::create($bill);


            Transaction::create([
                'business_id' => Auth::user()->business_id,
                'user_id' => Auth::id(),
                'uuid' => Auth::user()->uuid,
                'reference' => $trx,
                'type' => 'debit',
                'remark' => "$plan->name Purchase Was Successful To ".$input['number'],
                'amount' => $total,
                'previous' => $current_bal,
                'balance' => $wallet->balance
            ]);

            Log::notice("CableTv Order Successful [Business: ID - ".$business->id." & Name - ".$business->name."]");

            return response()->json(['success' => true, 'message' => 'SUCCESSFUL', 'data' => $trx]);
        }else{

            // balance auto reverse
            $wallet=Wallet::find($wallet->id);
            $wallet->balance = $current_bal;
            $wallet->save();

            Log::alert("CableTv Order Failed [Business: ID - ".$business->id." & Name - ".$business->name."]");

            return response()->json(['success' => false, 'message' => 'Unable to Process this Transaction at the moment, Try again later']);
        }
    }


    // Fetch electricity provider List
    public function electricityProviders(){

        $lists = ElectricityProviders::where(['status' => 1])->get();
        return response()->json(['success' => true, 'message' => 'Fetched successfully', 'data' => $lists->makeHidden(['id', 'c_cent', 'api_cent', 'status', 'created_at', 'updated_at'])]);
    }

    // electricity Validate
    public function electricityValidate(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'provider' => 'required|string',
            'type' => 'required|string',
            'number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $domain = "live";

        $elect = ElectricityProviders::where(['status' => 1, 'provider' => $input['provider']])->first();

        if($domain == "live"){
            $url = env('VTPASS_URL');
        }else{
            $url = env('VTPASS_SANDBOX_URL');
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url . "merchant-verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"serviceID": "' . $elect->code . '","billersCode": "' . $input['number'] . '","type": "' . $input['type'] . '"}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . env('VTPASS_AUTH'),
                'Content-Type: application/json'
            ),
        ));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response, true);

        if(isset($res['content']['error'])){
            return response()->json(['success' => false, 'message' => 'Incorrect or Invalid Meter number. Please try with a correct one']);
        }

        if ($res['code'] == '000'){
            $Customer_Name = $res['content']['Customer_Name'];

            return response()->json(['success' => true, 'message' => 'Fetched successfully', 'data' => ['provider' => $input['provider'], 'number' => $input['number'], 'type' => $input['type'], 'Customer_Name' => $Customer_Name]]);
        }

        return response()->json(['success' => true, 'message' => 'Unable to Verify Meter Number at the moment, Try again later']);
    }

    // Electricity Recharge
    public function electricityRecharge(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'provider' => 'required|string',
            'code' => 'required|string',
            'number' => 'required|numeric',
            'type' => 'required|string|max:10',
            'amount' => 'required|numeric',
            'reference' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        Log::info("Electricity Order Incoming Request " . json_encode($request->all()));

        $business = Business::where(["id" => Auth::user()->business_id])->first();

        if(!$business){
            return response()->json(['success' => false, 'message' => 'Business does not exist or does not belongs to you.']);
        }

        $business = Business::where("id", $business->id)->first();

        Log::info("Business Authenticated on Electricity Order Request [Business: ID - " . $business->id . " & Name - " . $business->name . "]");

        $wallet = wallet::where('user_id', Auth::id())->first();

        if (!$wallet) {
            return response()->json(['success' => false, 'message' => 'Invalid wallet or user'], 401);
        }

        //Check if reference already exist in user account
        $check_ref = BillsHistory::where(["business_id" => $business->id, 'api_req_id' => $input['reference']])->first();
        if ($check_ref) {
            return response()->json(['success' => false, 'message' => 'Reference order already existed']);
        }

        $network = ElectricityProviders::where(['status' => 1, 'provider' => $input['provider']])->first();

        // for api order
        $discount = ($network->api_cent / 100) * $input['amount'];
        $total = $input['amount'] - $discount;
        // for dashboard order
        // $discount = ($network->c_cent / 100) * $request->amount;
        // $total = $request->amount - $discount;

        if ($wallet->balance < 1) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance. Kindly topup and try again']);
        }


        if ($total > $wallet->balance) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance. Kindly topup your wallet']);
        }

        // charge user
        $current_bal = $wallet->balance;
        $wallet->balance -= $total;
        $wallet->save();

        $url = env('VTPASS_URL');

        Log::info("Attempting Electricity Order [Business: ID - " . $business->id . " & Name - " . $business->name . "]" . json_encode($request->all()));

        $trx = Carbon::now()->format('YmdHi') . rand();
        $phone = $input['number'];

        if(env('BILLS_DOMAIN')  =="live") {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url . "pay",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"request_id": "' . $trx . '", "serviceID": "' . $input['code'] . '","variation_code": "' . $input['type'] . '","phone": "' . $phone . '","billersCode": "' . $phone . '","amount": "' . $input['amount'] . '"}',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic ' . env('VTPASS_AUTH'),
                    'Content-Type: application/json'
                ),
            ));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);

            curl_close($curl);
        }else{
            $response='{"code":"000","content":{"transactions":{"status":"delivered","product_name":"KEDCO - Kano Electric","unique_element":"04193627736","unit_price":1000,"quantity":1,"service_verification":null,"channel":"api","commission":10,"total_amount":990,"discount":null,"type":"Electricity Bill","email":"odejinmisamuel@gmail.com","phone":"08166939205","name":null,"convinience_fee":0,"amount":1000,"platform":"api","method":"api","transactionId":"16586989121818581054913460"}},"response_description":"TRANSACTION SUCCESSFUL","requestId":"202207242241MCD_ID1658698896163592","amount":"1000.00","transaction_date":{"date":"2022-07-24 22:41:52.000000","timezone_type":3,"timezone":"Africa\/Lagos"},"purchased_code":"Token: 0495  3120  0029  9958  2637  ","customerName":"ZAKARIYA ALIYU ","customerAddress":"KATSINA NORTH REGION","token":"0495  3120  0029  9958  2637  ","tariffCode":"C2","businessUnit":"KATSINA NORTH REGION","undertaking":"GRA","customerBalance":null,"exchangeReference":"110-178398738","externalReference":null,"configure_token1":null,"configure_token2":null}';
        }

        $res = json_decode($response, true);

        Log::info("Electricity Order Response [Business: ID - " . $business->id . " & Name - " . $business->name . "]" . json_encode($res));

        if ($res['code'] == '000'){
            //log transaction history

            //activity log

            //log bill history
            $bill['business_id'] = $business->id;
            $bill['user_id'] = Auth::id();
            $bill['service_type'] = "electricity";
            $bill['provider'] = $input['provider'];
            $bill['recipient'] = $input['number'];
            $bill['amount'] = $input['amount'];
            $bill['discount'] = $discount;
            $bill['fee'] = 0;
            $bill['voucher'] = 0;
            $bill['paid'] = $total;
            $bill['init_bal'] = $current_bal;
            $bill['new_bal'] = $bill['init_bal'] - $bill['paid'];
            $bill['currency'] = "NGN";
            $bill['trx'] = $trx;
            $bill['ref'] = $res['content']['transactions']['transactionId'];
            $bill['api_req_id'] = $input['reference'];
            $bill['channel'] = "API";
            $bill['domain'] = env('BILLS_DOMAIN');
            if($request->provider == "PHED"){
                if (strtolower($input['type']) == "prepaid") {
                    $bill['purchased_code'] = $res['purchased_code'];
                    $bill['units'] = $res['units']." kwH";
                } else {
                    $bill['purchased_code'] = $input['number'];
                }
            }else{
                if (strtolower($input['type']) == "prepaid") {
                    $bill['purchased_code'] = $res['purchased_code'];
                    $bill['units']="0";
                } else {
                    $bill['purchased_code'] = $input['number'];
                }
            }

            $bill['status'] = $res['content']['transactions']['status'];
            $bill['errorMsg'] = $res['response_description'];
            BillsHistory::create($bill);

            if (strtolower($request->type) == "prepaid"){
                $purchased_code = $bill['purchased_code'];
                $units = $bill['units'];
            }else{
                $purchased_code = $bill['purchased_code'];
                $units = "";
            }


            Transaction::create([
                'business_id' => Auth::user()->business_id,
                'user_id' => Auth::id(),
                'uuid' => Auth::user()->uuid,
                'reference' => $trx,
                'type' => 'debit',
                'remark' => "NGN $request->amount ".$input['provider']." Electricity Purchase Was Successful To $phone. $purchased_code ",
                'amount' => $request->amount,
                'previous' => $current_bal,
                'balance' => $wallet->balance
            ]);

            Log::notice("Electricity Order Successful [Business: ID - " . $business->id . " & Name - " . $business->name . "]");

            return response()->json(['success' => true, 'message' => 'SUCCESSFUL', 'data' => $trx, 'purchased_code' => $purchased_code, 'units' => $units]);
        }else{

            // balance auto reverse
            $wallet = Wallet::find($wallet->id);
            $wallet->balance = $current_bal;
            $wallet->save();

            Log::alert("Electricity Order Failed [Business: ID - " . $business->id . " & Name - " . $business->name . "]");

            return response()->json(['success' => false, 'message' => 'Unable to Process this Transaction at the moment, Try again later']);
        }
    }



}
