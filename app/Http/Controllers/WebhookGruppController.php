<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\FeesSetting;
use App\Models\FeesSettingsAgent;
use App\Models\GruppWebhook;
use App\Models\Revenue;
use App\Models\Terminal;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WemaWebhook;
use Illuminate\Http\Request;

class WebhookGruppController extends Controller
{


//{
//"agentAccountNumber": "0223318808", (optional)
//"pan": "468219*********4190",
//"rrn": "000401141520",
//"stan": "141520",
//"amount": 5500,
//"serviceFee": 10,
//"reference": "1415-303363-5843AZZJ-004881109041525",
//"cardExpiry": "2405",
//"status": "success",
//"statusCode": "00",
//"transactionType": "card",
//"terminalId": "2033HQOQ",
//"serialNumber": "63201125995137",
//"statusDescription": "Successful Code",
//"transactionDate": "1648818956835",
//"hash": "c65595618330f13675d05a8d964903c439863db2aead12ef3cf11eb9f08396c9047f41e2ece56ddfa02baab6c5dbc0e8a0f8bf99c7cffb7796bcd069dfb4a3ce"
//}

    public function index(Request $request){

        $input = $request->all();


        $data2= json_encode($input);

        $dwl=GruppWebhook::create([
            'terminalId' => $input['terminalId'] ,
            'serialNumber'=> $input['serialNumber'],
            'reference'=> $input['reference'],
            'amount' => $input['amount'],
            'serviceFee' => $input['serviceFee'],
            'transactionType' => $input['transactionType'],
            'statusDescription' => $input['statusDescription'],
            'status' => $input['status'],
            'transactionDate' => $input['transactionDate'],
            'allData' => $data2
        ]);

        $secretKey=env('GRUPP_SECRET_KEY', 'MzI0MzU0MzI0MzU0NjQzNTQ2Cg');
        $reference=$input['reference'];
        $transactionAmount=$input['amount'];
        $transactionDate=$input['transactionDate'];
        $totalFee=0;

        $hash = $secretKey . '|' . $reference . '|' . $transactionAmount . '|' . $transactionDate;

        $h512=hash("sha512",$hash);

        if(env('APP_ENV') != "local") {
            if ($input['hash'] != $h512) {
                return response()->json(['status' => '07', 'status_desc' => 'Suspect fraud']);
            }
        }

        if($input['status'] != "success"){
            return response()->json(['status' => '07', 'status_desc'=>'Logged successfully']);
        }

        $tr=Transaction::where(['reference'=> $input['reference']])->first();

        if($tr){
            return response()->json(['status' => '07', 'status_desc'=>'Transaction reference already exist']);
        }

        $te=Terminal::where(['terminal_id' => $input['terminalId'], 'serial_number'=> $input['serialNumber']])->first();

        if(!$te){
            return response()->json(['status' => '07', 'status_desc'=>'Terminal not found']);
        }

        if($te->agent_id == NULL){
            return response()->json(['status' => '07', 'status_desc'=>'Terminal not assigned to agent']);
        }

        $user=User::find($te->agent_id);

        if(!$user){
            return response()->json(['status' => '07', 'status_desc'=>'An error occurred while finding agent']);
        }

        $wallet=Wallet::where('user_id', $user->id)->first();

        //Want to charge fee

        $varstFee=FeesSetting::where("type","Withdrawal")->first();

        if($varstFee){

            $varstDeductFee=$this->calCulateFeee($varstFee, $transactionAmount);
            $totalFee+=$varstDeductFee;
            $this->insertRevenue("0", "varst_".$reference,$varstDeductFee,$input['serviceFee']);

            $bizFee=FeesSettingsAgent::where([["fees_settings_id", $varstFee->id], ["business_id", $te->business_id]])->first();

            if($bizFee){
                $bizDeductFee=$this->calCulateFeee($bizFee, $transactionAmount);
                $totalFee+=$bizDeductFee;
                $this->insertRevenue($te->business_id, "biz_".$reference,$bizDeductFee,"0");
            }
        }


        $tf = $wallet->balance + $transactionAmount - $totalFee;

        $t=Transaction::create([
            'user_id' => $user->id,
            'uuid' => $user->uuid,
            'business_id' => $user->business_id,
            'reference' => $reference,
            'type' => 'credit',
            'remark' => "Card Withdrawal on ".$input['pan']." with terminal ID " . $input['terminalId'],
            'amount' => $transactionAmount,
            'previous' => $wallet->balance,
            'balance' => $tf
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'uuid' => $user->uuid,
            'business_id' => $user->business_id,
            'reference' => "fee_".$reference,
            'type' => 'debit',
            'remark' => "Fee on Card Withdrawal on ".$input['pan']." with terminal ID " . $input['terminalId'],
            'amount' => $totalFee,
            'previous' => $tf,
            'balance' => $tf - $totalFee
        ]);

        $wallet->balance = $tf - $totalFee;
        $wallet->save();


        return response()->json(['handshakeId' => $t->id]);

    }

    function calCulateFeee($fee, $amount){
        if($fee->fee_type == 1) {
            $f_fee = ($fee->fee/100) * $amount;
            if($f_fee > $fee->capped_fee  && $fee->capped_fee !=0 ){
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
