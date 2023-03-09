<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Transaction;
use App\Models\transfer;
use App\Models\TransferFee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FTController extends Controller
{
    public function banks()
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
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        return response()->json(['success' => true, 'message' => 'Bank list retrieved', 'data' => $resp['data']]);
    }

    public function balanceenquiry(Request $request)
    {
        $auth=$this->login();

        $date=Carbon::now()->format('ymdHis');

        $reff=env('NIBSS_CLIENT_CODE').$date.str_shuffle(rand().Carbon::now()->format('issi'));

        $ref=substr($reff,0,30);


        $reff=env('NIBSS_CLIENT_CODE').$date.str_shuffle(rand().Carbon::now()->format('issi'));

        $ref=substr($reff,0,30);

        if(env('NIBBS_MODE') == "test") {
            $payload = '{
    "channelCode": "1",
    "targetAccountName": "vee Test",
    "targetAccountNumber": "0112345678",
    "targetBankVerificationNumber": "33333333333",
    "authorizationCode": "MA-0112345678-2022315-53097",
    "destinationInstitutionCode": "999998",
    "billerId": "ADC19BDC-7D3A-4C00-4F7B-08DA06684F59",
    "transactionId": "' . $ref . '"
}';
        }else{

            $payload='{
  "channelCode": "1",
  "targetAccountName": "vee Test",
  "targetAccountNumber": "0112345678",
  "targetBankVerificationNumber": "33333333333",
  "authorizationCode": "MA-0112345678-2022315-53097",
  "destinationInstitutionCode": "'.env('NIBSS_CLIENT_CODE').'",
  "billerId": "ADC19BDC-7D3A-4C00-4F7B-08DA06684F59",
  "transactionId": "'.$ref.'"
}';

        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('NIBSS_BASEURL').'/nipservice/v1/nip/balanceenquiry',
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


        Log::info("==== Nibbs balanceenquiry ====");
        Log::info($payload);
        Log::info($response);


        dd($response);
    }

    public function tsq(Request $request)
    {
        $input=$request->all();

        $validator = Validator::make($request->all(), [
            'transactionId' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => implode(",",$validator->errors()->all())]);
        }

        $auth=$this->login();

        $payload='{
  "transactionId": "'.$input['transactionId'].'"
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
            return response()->json(['success' => false, 'message' => $resp['message']]);
        }

        if($resp['responseCode'] != "00"){
            return response()->json(['success' => false, 'message' => "Error in verifying transaction. Kindly try again."]);
        }

        return response()->json(['success' => false, 'message' => "Transaction Verified Successfully", 'data'=>$resp]);
    }

    public function verify(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'bank' => 'required',
            'number' => ['required', 'min:10', 'max:10'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => implode(",",$validator->errors()->all())]);
        }


        $auth=$this->login();

        if(env('NIBBS_MODE') == "test") {
            $input['bank'] = "999998";
            $input['number'] = "0112345678";
        }

        $curl = curl_init();

        $date=Carbon::now()->format('ymdHis');

        $reff=env('NIBSS_CLIENT_CODE').$date.str_shuffle(rand().Carbon::now()->format('issi'));

        $ref=substr($reff,0,30);

        $payload='{
  "accountNumber": "'.$input['number'].'",
  "channelCode": "1",
  "destinationInstitutionCode": "'.str_pad($input['bank'], 6, '0', STR_PAD_LEFT).'",
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

        return response()->json(['success' => true, 'message' => "Validated successfully", 'data' =>$data]);

    }

    public function transfer(Request $request)
    {
        $input=$request->all();

        $validator = Validator::make($request->all(), [
            'bank' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'sessionID' => 'required',
            'narration' => 'required',
            'refid' => ['required', 'min:10'],
            'bankVerificationNumber' => 'required',
            'number' => ['required', 'min:10', 'max:10'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => implode(",",$validator->errors()->all())]);
        }

        $date=Carbon::now()->format('ymdHis');

        $reff=env('NIBSS_CLIENT_CODE').$date.str_shuffle(rand().Carbon::now()->format('issi'));

        $ref=substr($reff,0,30);


        $t=transfer::create([
            'user_id'=>0,
            'business_id'=>0,
            'amount'=>$request['amount'],
            'bankcode'=>$request['bank'],
            'account_no'=>$request['number'],
            'narration'=>$request['narration']." IP: ".$request->ip(),
            'refid'=>$ref,
            'fee'=>0,
        ]);

        $auth=$this->login();

        if(env('NIBBS_MODE') == "test") {
            $request['bank']="999998";
            $request['number']="0112345678";
            $request['amount'] = 100;

            $payload = '
        {
    "sourceInstitutionCode": "999998",
    "amount": '.$request['amount'].',
    "beneficiaryAccountName": "'.$request['name'].'",
    "beneficiaryAccountNumber": "'.$request['number'].'",
    "beneficiaryBankVerificationNumber": 22222222226,
    "beneficiaryKYCLevel": 1,
    "channelCode": 1,
    "originatorAccountName": "vee Test",
    "originatorAccountNumber": "0112345678",
    "originatorBankVerificationNumber": 33333333333,
    "originatorKYCLevel": 1,
    "destinationInstitutionCode": 999998,
    "mandateReferenceNumber": "MA-0112345678-2022315-53097",
    "nameEnquiryRef": "'.$request['sessionID'].'",
    "originatorNarration": "'.$request['narration'].'",
    "paymentReference": "'.$request['refid'].'",
    "transactionId": "' . $ref . '",
    "transactionLocation": "1.38716,3.05117",
    "beneficiaryNarration": "'.$request['narration'].'",
    "billerId": "ADC19BDC-7D3A-4C00-4F7B-08DA06684F59"
}';
        }else{


            $payload='{
    "sourceInstitutionCode": "'.env('NIBSS_ORIGINATOR_BANKCODE').'",
    "amount": "'.$request['amount'].'",
    "beneficiaryAccountName": "'.$request['name'].'",
    "beneficiaryAccountNumber": "'.$request['number'].'",
    "beneficiaryBankVerificationNumber": "'.$request['bankVerificationNumber'].'",
    "beneficiaryKYCLevel": "1",
    "channelCode": "1",
    "originatorAccountName": "'.env('NIBSS_ORIGINATOR_ACCOUNT_NAME').'",
    "originatorAccountNumber": "'.env('NIBSS_ORIGINATOR_ACCOUNT_NUMBER').'",
    "originatorBankVerificationNumber": "'.env('NIBSS_ORIGINATOR_BVN').'",
    "originatorKYCLevel": "1",
    "destinationInstitutionCode": "'.str_pad($input['bank'], 6, '0', STR_PAD_LEFT).'",
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
        Log::info($request->ip());
        Log::info($payload);
        Log::info($response);

        try {

            if ($resp['responseCode'] == "00") {
                $t->status=1;
                $t->sessionid=$resp['sessionID'];
                $t->save();

                $mg = "Transferred NGN " . $request['amount'] . " to " . $request['number'] . "(" . $request['name'] . ") ";

                return response()->json(['success' => true, 'message' => $mg, 'data' => $resp]);

            } else {
                return response()->json(['success' => false, 'message' => "Failed Transaction"]);
            }
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $resp['message']]);
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
