<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Api\S2SController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\CybersourceController;
use App\Http\Controllers\Payment\FlutterwaveController;
use App\Http\Controllers\Payment\InterswitchController;
use App\Http\Controllers\Payment\MastercardController;
use App\Http\Controllers\Payment\UBAMastercardController;
use App\Http\Controllers\Payment\WemaMastercardController;
use App\Http\Controllers\WebhookController;
use App\Models\Business;
use App\Models\BusinessCredentials;
use App\Models\Customer;
use App\Models\ProviderVirtualAccount;
use App\Models\Transaction;
use App\Models\VirtualAccount;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    public function bankTransfer(Request $request)
    {
        $input = $request->myPayload;

        if(!isset($input)){
            return response()->json(['status' => false, 'message' => 'Encryption issue']);
        }

        $validator = Validator::make($input, [
            'business_id' => 'required',
            'amount' => 'required',
            'currency' => 'string',
            'reference' => 'required|string|min:16',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Error in request', 'error' => $validator->errors()]);
        }

        $domain = "live";

        $business = Business::where(["id" => $input['business_id'], "user_id" => Auth::id()])->first();

        if(!$business){
            return response()->json(['status' => false, 'message' => 'Business does not exist or does not belongs to you.']);
        }

        $check_customer = Customer::where(['business_id' => $business->id, 'email' => Auth::user()->email])->first();
        if (!$check_customer) {
            // create new customer
            $cus['business_id'] = $business->id;
            $cus['email'] = Auth::user()->email;
            $cus['customer_code'] = generateCustomerCode();
            $cus['domain'] = $domain;
            $data = Customer::create($cus);
            $customer = $data->id;
        } else {
            $customer = $check_customer->id;
        }

        // check if currency is submited on payload or not
        if ($input['currency'] == NULL) {
            $r_cur = "NGN";
        } else {
            $r_cur = $input['currency'];
        }

        // check if currency is valid
        if ($r_cur != "NGN"){
            return response()->json(['status' => false, 'message' => 'Only NGN is allowed']);
        }

        // check if currency is valid
        if ($input['amount'] < 100){
            return response()->json(['status' => false, 'message' => 'Minimum amount is NGN 100']);
        }


        // check if currency code is valid or not
        $wallet = Wallet::where(['business_id' => $business->id, 'currency' => $r_cur, 'domain' =>$domain])->first();
        if (!$wallet) {
            return response()->json(['status' => false, 'message' => 'Unauthorized Merchant Currency provided']);
        }

        // transaction reference check
        if ($input['reference'] == NULL) {
            $trx = Carbon::now()->timestamp . rand();
        } else {
            $trans = Transaction::where(['reference' => $input['reference'], 'business_id' => $business->id, 'domain' => $domain])->first();
            if (!$trans) {
                $trx = $input['reference'];
            } else {
                return response()->json(['status' => false, 'message' => 'Reference Already Exist']);
            }
        }

        //adding transaction fee
//        $transaction_fee=getTransactionFee($business->id, $wallet->currency, $input['amount']);
        $transaction_fee=100;

        if($business->feeBearer == 1){
            $total_amount= $input['amount'];
        }else{
            $total_amount=$input['amount']+$transaction_fee;
        }

        //log transaction history
        $trans=Transaction::create([
            'business_id' => $business->id,
            'currency' => $wallet->currency,
            'amount' => $total_amount,
            'reference' => $trx,
            'domain' => $domain,
            'customer_id' => $customer,
            'plan' => NULL,
            'requested_amount' => $input['amount'],
            'fees' => $transaction_fee,
        ]);

        $pva = ProviderVirtualAccount::where(['status' => 'active', 'default_provider' => 'yes'])->inRandomOrder()->first();

        $vaccount=createVirtualAccountHelper($trans->domain, $pva->bank_code,1, $trans->amount, $trans->business->payment_descriptor);

        $acctNo=explode('|',$vaccount)[0];
        $bankName=explode('|',$vaccount)[1];
        $pid=explode('|',$vaccount)[2];
        $name=explode('|',$vaccount)[3];

        VirtualAccount::create([
            'businesses_id' =>$trans->business_id,
            'customer_id' =>$trans->customer->id,
            'account_name' =>$name,
            'account_number' =>$acctNo,
            'currency' =>$trans->currency,
            'provider_id' =>$pid,
            'reference'=>$trx,
            'domain'=>$trans->domain,
            'assignment' =>'checkout',
        ]);

        if($trans->domain != "live") {
            $webhook = new WebhookController();
            $webhook->mockWemaWebhook($acctNo);
        }

        return response()->json(['status' => true, 'message' => 'Account generated successfully', 'data'=> ['account_name' =>$name, 'account_number'=>$acctNo, 'bank_name'=>$bankName] ]);

    }

    public function card(Request $request)
    {
        $input = $request->myPayload;

        if(!isset($input)){
            return response()->json(['status' => false, 'message' => 'Encryption issue']);
        }

        $validator = Validator::make($input, [
            'business_id' => 'required',
            'amount' => 'required',
            'currency' => 'string',
            'reference' => 'required|string|min:16',
            'card.number' => 'required|string|min:14',
            'card.expiryMonth' => 'required|string|min:2|max:2',
            'card.expiryYear' => 'required|string|min:2|max:2',
            'card.cvv' => 'required|string|min:3|max:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()], 400);
        }

        $domain = "live";

        $business = Business::where(["id" => $input['business_id'], "user_id" => Auth::id()])->first();

        if(!$business){
            return response()->json(['status' => false, 'message' => 'Business does not exist or does not belongs to you.']);
        }

        $check_customer = Customer::where(['business_id' => $business->id, 'email' => Auth::user()->email])->first();
        if (!$check_customer) {
            // create new customer
            $cus['business_id'] = $business->id;
            $cus['email'] = Auth::user()->email;
            $cus['customer_code'] = generateCustomerCode();
            $cus['domain'] = $domain;
            $data = Customer::create($cus);
            $customer = $data->id;
        } else {
            $customer = $check_customer->id;
        }

        // check if currency is submited on payload or not
        if ($input['currency'] == NULL) {
            $r_cur = "NGN";
        } else {
            $r_cur = $input['currency'];
        }

        // check if currency is valid


        // check if currency code is valid or not
        $wallet = Wallet::where(['business_id' => $business->id, 'currency' => $r_cur, 'domain' =>$domain])->first();
        if (!$wallet) {
            return response()->json(['status' => false, 'message' => 'Unauthorized Merchant Currency provided']);
        }

        // transaction reference check
        if ($input['reference'] == NULL) {
            $trx = Carbon::now()->timestamp . rand();
        } else {
            $trans = Transaction::where(['reference' => $input['reference'], 'business_id' => $business->id, 'domain' => $domain])->first();
            if (!$trans) {
                $trx = $input['reference'];
            } else {
                return response()->json(['status' => false, 'message' => 'Reference Already Exist']);
            }
        }

        //adding transaction fee
//        $transaction_fee=getTransactionFee($business->id, $wallet->currency, $input['amount']);
        $transaction_fee=50;

        if($business->feeBearer == 1){
            $total_amount= $input['amount'];
        }else{
            $total_amount=$input['amount']+$transaction_fee;
        }

        //log transaction history
        $trans=Transaction::create([
            'business_id' => $business->id,
            'currency' => $wallet->currency,
            'amount' => $total_amount,
            'reference' => $trx,
            'domain' => $domain,
            'customer_id' => $customer,
            'plan' => NULL,
            'requested_amount' => $input['amount'],
            'fees' => $transaction_fee,
        ]);

        $card_datas=$input['card'];

        $reqs['cardnumber'] = $card_datas['number'];
        $reqs['expiryMonth'] = $card_datas['expiryMonth'];
        $reqs['expiryYear'] = $card_datas['expiryYear'];
        $reqs['cvv'] = $card_datas['cvv'];
        $reqs['ref'] = $trx;
        $reqs['ip'] = $request->ip();
        $reqs['pin'] = $input['pin'] ?? "";
        $req = new Request($reqs);

        $card_local=$trans->merchant->card_local;
        $card_foreign_mastercard=$trans->merchant->card_foreign_mastercard;
        $card_foreign_others=$trans->merchant->card_foreign_others;

        $card_type=detectCardType($card_datas['number']);
        $type=decide($r_cur, $card_type);
        $ans=findPayment($type);

        $gw=new S2SController();

        if($type == "card_local"){
            if($card_local == "default"){
                return $gw->decideGateway($ans,$req);
            }else{
                return $gw->decideGateway($card_local,$req);
            }
        }

        if($type == "card_foreign_mastercard"){
            if($card_foreign_mastercard == "default"){
                return $gw->decideGateway($ans,$req);
            }else{
                return $gw->decideGateway($card_foreign_mastercard,$req);
            }
        }

        if($type == "card_foreign_others"){
            if($card_foreign_others == "default"){
                return $gw->decideGateway($ans,$req);
            }else{
                return $gw->decideGateway($card_foreign_others,$req);
            }
        }

        return response()->json(['status' => false, 'message' => 'There is issue with your card type'], 404);

    }

    // Verify Transaction
    public function verifyTransaction($business, $reference){

        // fetch transaction with provided reference
        $trans = Transaction::where(['reference' => $reference, 'business_id' => $business])->first();

        if (!$trans) {
            return response()->json(['status' => false, 'message' => 'Reference code does not exist']);
        }

        if($trans->status == "success"){
            $success = true;
        }else{
            $success = false;
        }

        return response()->json(['status' => true, 'message' => 'Verification successful', 'data' => ['amount'=>$trans->amount, 'currency' =>$trans->currency, 'status' =>$trans->status, 'transaction_date' =>$trans->paid_at, 'reference' =>$trans->reference, 'domain' =>$trans->domain, 'gateway_response'=>null, 'channel' =>$trans->channel, 'ip_address' =>$trans->ip_address, 'plan' => $trans->plan, 'requested_amount' => $trans->requested_amount]]);
    }
}
