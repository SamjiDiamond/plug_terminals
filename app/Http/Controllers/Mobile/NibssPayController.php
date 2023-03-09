<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Mobile\PayoutController;
use App\Models\Business;
use App\Models\Transaction;
use App\Models\transfer;
use App\Models\TransferFee;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class NibssPayController extends Controller
{
    public function bankList()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://live-api.mfb.verdantbank.ng/api/v1/utilities/bank_lists',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        return response()->json(['success' => true, 'message' => 'Bank list retrieved', 'data' => $resp['data']]);
    }

    public function tsq($ref)
    {
        $auth=$this->login();

        $payload='{
  "transactionId": "'.$ref.'"
}';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('NIBSS_BASEURL').'/nipservice/v1/nip/tsq',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$auth['access_token'],
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        Log::info("==== Nibbs tsq ====");
        Log::info($payload);
        Log::info($response);

        $resp=json_decode($response,true);


        if(isset($resp['code'])){
            return redirect()->route('transfer')->with("error", $resp['message']);
        }

        if($resp['responseCode'] != "00"){
            return redirect()->route('transfer')->with("error", "Error in verifying transaction. Kindly try again.");
        }

        Alert::success($ref, 'Transaction Verified Successfully with sessionID => '.$resp['sessionID']);

        return redirect()->route('transfer')->with("success", "Transaction Verified Successfully with sessionID => ".$resp['sessionID']);
    }

    public function verify(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'bank_code' => 'required',
            'account_number' => ['required', 'min:10', 'max:10']
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Error in request', 'error' => $validator->errors()]);
        }

        $auth=$this->login();

        if(env('NIBBS_MODE') == "test") {
            $input['bank_code'] = "999998";
            $input['account_number'] = "0112345678";
        }

        $curl = curl_init();

        $date=Carbon::now()->format('ymdHis');

        $reff=env('NIBSS_CLIENT_CODE').$date.str_shuffle(rand().Carbon::now()->format('issi'));

        $ref=substr($reff,0,30);

        $payload='{
  "accountNumber": "'.$input['account_number'].'",
  "channelCode": "1",
  "destinationInstitutionCode": "'.str_pad($input['bank_code'], 6, '0', STR_PAD_LEFT).'",
  "transactionId": "'.$ref.'"
}';

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('NIBSS_BASEURL').'/nipservice/v1/nip/nameenquiry',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS =>$payload,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$auth['access_token'],
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resp=json_decode($response,true);

        Log::info("==== Nibbs Validation ====");
        Log::info($payload);
        Log::info($response);

        if(isset($resp['code'])){
            return response()->json(['success' => false, 'message' => $resp['message']]);
        }

        if($resp['responseCode'] != "00"){
            return response()->json(['success' => false, 'message' => "Error in verifying name. Kindly try again."]);
        }

        $data['accountName'] =  $resp['accountName'];
        $data['sessionID'] =  $resp['sessionID'];
        $data['transactionId'] =  $resp['transactionId'];
        $data['bankVerificationNumber'] =  $resp['bankVerificationNumber'];
        $data['request'] =  $request;

        return response()->json(['success' => true, 'message' => 'Account name validated', 'data' => $resp['accountName'], 'more' =>$resp]);
    }

    public function transfer(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'amount' => 'required',
            'bank_code' => 'required',
            'accountName' => 'required',
            'account_number' => 'required',
            'narration' => 'required',
            'reference' => 'required',
            'pin' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => implode(',', $validator->errors()->all()), 'error' => $validator->errors()], 400);
        }

        $input=$request->all();

        if(Auth::user()->transaction_pin != $input['pin']){
            return response()->json(['success' => false, 'message' => 'Incorrect Pin']);
        }


        $my=Business::find(Auth::user()->business_id);

        if($request->amount < 1){
            $mg = "Invalid Amount Entry";
            return response()->json(['success' => false, 'message' => $mg]);
        }

        $wallet=Wallet::where(['user_id' => Auth::id(), 'name' => 'deposit'])->first();

        if(!$wallet){
            return response()->json(['success' => false, 'message' => 'Invalid wallet or user']);
        }

        if ($wallet->balance < 1) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance. Kindly topup and try again']);
        }


        if ($wallet->balance < $request->amount){
            $mg = "You Can't Make Transfer Of " . "₦" . $request->amount . " from your wallet. Your wallet balance is ₦ $my->wallet.";
            return response()->json(['success' => false, 'message' => $mg]);
        }


        $checkref=Transaction::where('reference', $input['reference'])->first();
        if ($checkref){
            $mg = "Duplicate Transaction Detected";

            return response()->json(['success' => false, 'message' => $mg]);
        }

        $payout=new PayoutController();
        $chargeVarst = $payout->totalVarstFee($request->amount);
        $chargeBiz = $payout->totalBizFee(3,$request->amount);
        $charge = $chargeVarst + $chargeBiz;


        $myDebit=$request->amount+$charge;

        $current_bal = $wallet->balance;
        $next_bal = $current_bal - $myDebit;


        if ($current_bal < $myDebit){
            $mg = "Your balance is not enough to cover for charges";
            return response()->json(['success' => false, 'message' => $mg]);
        }


        $date=Carbon::now()->format('ymdHis');

        $reff=env('NIBSS_CLIENT_CODE').$date.str_shuffle(rand().Carbon::now()->format('issi'));

        $ref=substr($reff,0,30);

        $request['bank']=$input['bank_code'];
        $request['number']=$input['account_number'];
        $request['refid']=$input['reference'];


        $t=transfer::create([
            'user_id'=>Auth::id(),
            'business_id'=>Auth::user()->business_id,
            'amount'=>$request['amount'],
            'bankcode'=>$request['bank'],
            'account_no'=>$request['number'],
            'narration'=>$request['narration'],
            'refid'=>$ref,
            'fee'=>$charge,
        ]);

        $auth=$this->login();

        if(env('NIBBS_MODE') == "test") {
            $request['bank']="999998";
            $request['number']="0112345678";
            $request['amount'] = 100;

            $payload = '
        {
    "sourceInstitutionCode": "999998",
    "amount": 100,
    "beneficiaryAccountName": "Ake Mobolaji Temabo",
    "beneficiaryAccountNumber": "1780004070",
    "beneficiaryBankVerificationNumber": 22222222226,
    "beneficiaryKYCLevel": 1,
    "channelCode": 1,
    "originatorAccountName": "vee Test",
    "originatorAccountNumber": "0112345678",
    "originatorBankVerificationNumber": 33333333333,
    "originatorKYCLevel": 1,
    "destinationInstitutionCode": 999998,
    "mandateReferenceNumber": "MA-0112345678-2022315-53097",
    "nameEnquiryRef": "999999191106195503191106195503",
    "originatorNarration": "Payment from 0112345678 to 1780004070",
    "paymentReference": "EBILLSPAY1234567890",
    "transactionId": "' . $ref . '",
    "transactionLocation": "1.38716,3.05117",
    "beneficiaryNarration": "Payment to 0112345678 from 1780004070",
    "billerId": "ADC19BDC-7D3A-4C00-4F7B-08DA06684F59"
}';
        }else{


            $payload='{
    "sourceInstitutionCode": "'.env('NIBSS_ORIGINATOR_BANKCODE').'",
    "amount": "'.$request['amount'].'",
    "beneficiaryAccountName": "'.$request['accountName'].'",
    "beneficiaryAccountNumber": "'.$request['number'].'",
    "beneficiaryBankVerificationNumber": "'.$request['bankVerificationNumber'].'",
    "beneficiaryKYCLevel": "1",
    "channelCode": "1",
    "originatorAccountName": "'.env('NIBSS_ORIGINATOR_ACCOUNT_NAME').'",
    "originatorAccountNumber": "'.env('NIBSS_ORIGINATOR_ACCOUNT_NUMBER').'",
    "originatorBankVerificationNumber": "'.env('NIBSS_ORIGINATOR_BVN').'",
    "originatorKYCLevel": "1",
    "destinationInstitutionCode": "'.str_pad($request['bank'], 6, '0', STR_PAD_LEFT).'",
    "mandateReferenceNumber": "'.env('NIBSS_MANDATE_REFERENCE_NUMBER').'",
    "nameEnquiryRef": "'.$request['sessionID'].'",
    "originatorNarration": "'.$request['narration'].'",
    "paymentReference": "'.$request['refid'].'",
    "transactionId": "'.$ref.'",
    "transactionLocation": "1.38716,3.05117",
    "beneficiaryNarration": "'.$request['narration'].'",
    "billerId": "362"
}';
        }


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('NIBSS_BASEURL').'/nipservice/v1/nip/fundstransfer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$auth['access_token'],
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resp=json_decode($response,true);

        Log::info("=====Nibss Transfer====");
        Log::info($payload);
        Log::info($response);


        if($resp['responseCode'] == "00"){
            $t->status=1;
            $t->sessionid=$resp['sessionID'];
            $t->save();

            Transaction::create([
                'business_id' => Auth::user()->business_id,
                'user_id' => Auth::id(),
                'uuid' => Auth::user()->uuid,
                'reference' => $request['refid'],
                'type' => 'debit',
                'remark' => "Transfer NGN ".$request['amount']." to ".$request['number']."(".$request['accountName'].") ".$request['narration'],
                'amount' => $myDebit,
                'previous' => $current_bal,
                'balance' => $next_bal
            ]);

            $payout->insertRevenue(0, "varst_".$request['refid'],$chargeVarst,"0");
            $payout->insertRevenue(Auth::user()->business_id, "biz_".$request['refid'],$chargeBiz,"0");

            // charge user
            $wallet->balance = $next_bal;
            $wallet->save();

            $mg = "Transferred NGN " . $request['amount'] . " to " . $request['number'] . "(" . $request['accountName'] . ") ";

            return response()->json(['success' => true, 'message' => $mg]);
        }else{

            $mg="Failed Transaction";
            return response()->json(['success' => false, 'message' => $mg]);
        }

    }

    function login(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('NIBSS_BASEURL').'/reset',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => 'client_id='.env("NIBSS_CLIENTID").'&client_secret='.env("NIBSS_CLIENT_SECRET").'&grant_type=client_credentials&scope='.env("NIBSS_SCOPE"),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: citrix_ns_id=AAE7UmsaYzuFhZUKAAAAADvJuZrU7zG2U_SdOwuAYXaQIYmgGDoA9We3zHVGxi8POw==OnEaYw==GrfSn2mBbMisQ_6TBlABp9XnHsc=; citrix_ns_id_.nibss-plc.com.ng_%2F_wat=AgAAAAVfVCZ5wYuajackq5qIf6p_3oxdAgLW5AhqihmEDw8r4nTV4oQNCz-IRczQpr_p8ewGhaJSAPBf7hyynlUfuWy079Oj7Kw39inaOlyzHaVzvw==&AgAAAAWtATtu-BUGQIeEqpwjK_TID_IZjl12Qnpr9GQu-l3j7dC-en0Qr05151fQq2aN43Kmt-uJ2HtAyRI75RxX_-zb37gBwP2BpL92mRqs4B7GUA==&; citrix_ns_id_.nibss-plc.com.ng_%2F_wlf=AgAAAAUIlFMhPdQ680WbG8jySB28IgbiLs7gB45kPJPPGsmNr2wLWf7_Itnk21f2FLaODobdvpjqxh0BbD2-vynMKUXC&; fpc=AnpLxVj96qFGrQW69YOIC4Vwhw_JAQAAAPxqrNoOAAAA; stsservicecookie=estsfd; x-ms-gateway-slice=estsfd'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        Log::info("=====Nibss Login====");
        Log::info('client_id='.env("NIBSS_CLIENTID").'&client_secret='.env("NIBSS_CLIENT_SECRET").'&grant_type=client_credentials&scope='.env("NIBSS_SCOPE"));
        Log::info($response);


        return json_decode($response, true);
    }

}
