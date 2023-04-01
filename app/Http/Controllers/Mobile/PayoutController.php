<?php

namespace App\Http\Controllers\Mobile;

use App\Events\InitiateTransferEvent;
use App\Http\Controllers\Api\CentralServiceController;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessCredentials;
use App\Models\FeesSetting;
use App\Models\FeesSettingsAgent;
use App\Models\Payout;
use App\Models\Revenue;
use App\Models\SourceFt;
use App\Models\Transaction;
use App\Models\transfer;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PayoutController extends Controller
{

    // bank list
    public function bankList(){

        $auth=$this->login();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPTERMINAL_SAMJI_BASEURL').'grupp-bank-list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "terminal": "'.$auth['data']['terminalId'].'",
    "session": "'.$auth['data']['sessionId'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cmVzdGRldmljZTo1TkRNMU5qY2tKVjRLSw==',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp=json_decode($response,true);

        return response()->json(['success' => true, 'message' => 'Bank list retrieved', 'data' => $resp]);
    }

    // bank account name
    public function verify(Request $request){
        $input=$request->all();

        $validator = Validator::make($input, [
            'bank_code' => 'required',
            'account_number' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Error in request', 'error' => $validator->errors()]);
        }

        $input['bank_code']="058";
        $input['account_number']="0112169539";

        $auth=$this->login();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPTERMINAL_SAMJI_BASEURL').'grupp-validate-bank',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "terminal": "'.$auth['data']['terminalId'].'",
    "session": "'.$auth['data']['sessionId'].'",
    "bankCode": "'.$input['bank_code'].'",
    "accountNumber": "'.$input['account_number'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cmVzdGRldmljZTo1TkRNMU5qY2tKVjRLSw==',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resp=json_decode($response,true);

        return response()->json(['success' => true, 'message' => 'Account name validated', 'data' => $resp['accountName']]);
    }

    // transfer fee
    public function transferFee(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Error in request', 'error' => $validator->errors()]);
        }

        $amount=$input['amount'];

        $totalFee=$this->totalFee($amount);


        $totalDebit=$amount + $totalFee;

        return response()->json(['success' => true, 'message' => 'Fee', 'data' => $totalDebit, 'fee' =>$totalFee]);
    }

    // Initiate Bank Transfer
    public function transfer(Request $request){

        $input = $request->all();

        $validator = Validator::make($input, [
            'amount' => 'required',
            'bank_code' => 'required',
            'account_number' => 'required',
            'narration' => 'required',
            'reference' => 'required',
            'pin' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => implode(',', $validator->errors()->all()), 'error' => $validator->errors()], 400);
        }

        $domain = "test";
        $amount=$input['amount'];

        $wallet = wallet::where('user_id', Auth::id())->first();

        if ($amount < 100) {
            $mg = "Minimum amount is 100. Kindly increase amount and try again";
            return response()->json(['success' => false, 'message' => $mg]);
        }

        if ($wallet->balance < 1) {
            $mg = "Insufficient balance. Kindly topup and try again";
            return response()->json(['success' => false, 'message' => $mg]);
        }

        if ($amount < 1) {
            $mg = "Error transaction";
            return response()->json(['success' => false, 'message' => $mg]);
        }

        if ($wallet->balance < $amount) {
            $mg = "You Cant Make Transfer Above NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet.";
            return response()->json(['success' => false, 'message' => $mg]);
        }

        $bo = transfer::where('refid', $request->refe)->first();

        if ($bo) {
            $mg = "Suspected duplicate transaction";
            return response()->json(['success' => false, 'message' => $mg]);
        }

        $gt = $wallet->balance - $request->amount;
        $wallet->balance = $gt;
        $wallet->save();



        $auth=$this->login();

        $amnt=$input['amount'] * 100;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPTERMINAL_SAMJI_BASEURL').'grupp-bank-transfer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "terminal": "'.$auth['data']['terminalId'].'",
    "session": "'.$auth['data']['sessionId'].'",
    "bankCode": "'.$input['bank_code'].'",
    "accountNumber": "'.$input['account_number'].'",
    "amount": "'.$amnt.'",
    "stan": "'.$input['reference'].'",
    "pin": "'.$input['pin'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cmVzdGRldmljZTo1TkRNMU5qY2tKVjRLSw==',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp=json_decode($response, true);


        if ($resp['responseCode'] != "00") {

            $gt = $wallet->balance + $request->amount;
            $wallet->balance = $gt;
            $wallet->save();

            return response()->json(['success' => false, 'message' => $resp['description']]);
        }

        $reference=$input['reference'];
        $accountNumber=$input['account_number'];


        transfer::create([
            'user_id' => Auth::id(),
            'business_id' => Auth::user()->business_id,
            'bankcode' => $request->bank_code,
            'amount' => $request->amount,
            'account_no' => $accountNumber,
            'narration' => $request->narration,
            'refid' => $reference,
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'business_id' => Auth::user()->business_id,
            'uuid' => Auth::user()->uuid,
            'reference' => $reference,
            'type' => 'debit',
            'remark' => "Successful Transfer to $accountNumber Reference: $reference",
            'amount' => $request->amount,
            'previous' => $wallet->balance,
            'balance' => $gt,
        ]);

        $msg = "NGN $amount was successfully transferred to $accountNumber";

        return response()->json(['success' => true, 'message' => $msg]);

    }

    function login(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPTERMINAL_SAMJI_BASEURL').'grupp-login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "serialNumber": "63201125995137",
    "stan": "123456",
    "onlyAccountInfo": false
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cmVzdGRldmljZTo1TkRNMU5qY2tKVjRLSw==',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    function totalVarstFee($amount){

        $varstFee=FeesSetting::where("type","Transfer")->first();
        $totalFee=0;

        if($varstFee){
            $varstDeductFee=$this->calCulateFeee($varstFee, $amount);
            $totalFee+=$varstDeductFee;
        }

        return $totalFee;
    }

    function totalBizFee($varstFeeid,$amount){

        $totalFee=0;

        $bizFee=FeesSettingsAgent::where([["fees_settings_id", $varstFeeid], ["business_id", Auth::user()->business_id]])->first();

        if($bizFee){
            $bizDeductFee=$this->calCulateFeee($bizFee, $amount);
            $totalFee+=$bizDeductFee;
        }

        return $totalFee;
    }

    function totalFee($amount){

        $varstFee=FeesSetting::where("type","Transfer")->first();
        $totalFee=0;

        if($varstFee){
            $varstDeductFee=$this->calCulateFeee($varstFee, $amount);
            $totalFee+=$varstDeductFee;

            $bizFee=FeesSettingsAgent::where([["fees_settings_id", $varstFee->id], ["business_id", Auth::user()->business_id]])->first();

            if($bizFee){
                $bizDeductFee=$this->calCulateFeee($bizFee, $amount);
                $totalFee+=$bizDeductFee;
            }
        }

        return $totalFee;
    }

    function calCulateFeee($fee, $amount){
        if($fee->fee_type == 1) {
            $f_fee = ($fee->fee/100) * $amount;
            if($f_fee > $fee->capped_fee && $fee->capped_fee !=0 ){
                return $fee->capped_fee;
            }
        }else{
            $f_fee=$fee->fee;
        }

        return $f_fee;
    }

    function insertRevenue($business_id,$reference,$amount,$serviceFee){
        $rev['business_id']=$business_id;
        $rev['reference']=$reference;
        $rev['amount']=$amount;
        $rev['type']="credit";

        if($business_id == 0){
            $w=Wallet::where([["name","revenue"], ["user_id",0]])->first();
            if($w){
                $rev['balance']=$w->balance + $amount;
                Revenue::create($rev);

                if($serviceFee != 0){
                    $rev['amount']=$serviceFee;
                    $rev['type']="debit";
                    $rev['balance']=$w->balance + $amount - $serviceFee;
                    Revenue::create($rev);
                }

                $am=$amount-$serviceFee;

                $w->balance+=$am;
                $w->save();
            }
        }else{
            $b=Business::find($business_id);
            if($b){
                $rev['balance']=$b->revenue + $amount;
                Revenue::create($rev);

                $b->revenue+=$amount;
                $b->save();
            }
        }

    }


}
