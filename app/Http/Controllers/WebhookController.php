<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\FeesSetting;
use App\Models\FeesSettingsAgent;
use App\Models\Revenue;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WemaWebhook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebhookController extends Controller
{
    public function wemaWebhook(Request $request)
    {

//        {
//"originatoraccountnumber": "string",
//"amount": "string", *
//"originatorname": "string",
//"narration": "string", *
//"craccountname": "string",
//"paymentreference": "string", *
//"bankname": "string",
//"sessionid": "string", *
//"craccount": "string", *
//"bankcode": "string"
//}

        $input = $request->all();


        $data2= json_encode($input);

        $dwl=WemaWebhook::create([
            'paymentReference' => $input['paymentreference'] ,
            'sessionid'=> $input['sessionid'],
            'craccount'=> $input['craccount'],
            'narration' => $input['narration'],
            'amount' => $input['amount'],
            'originatoraccountnumber' => $input['originatoraccountnumber'],
            'originatorname' => $input['originatorname'],
            'bankname' => $input['bankname'],
            'bankcode' => $input['bankcode'],
            'craccountname' => $input['craccountname'],
            'allData' => $data2
        ]);


        $fdwl=WemaWebhook::where([['sessionid', $input['sessionid']], ['status', 1]])->first();

        if($fdwl){
            return response()->json(['status' => '07', 'status_desc'=>'SessionID already exist']);
        }

        $nb=Business::where('account_details', 'LIKE', '%'. $input['craccount']. '%')->first();

        if(!$nb){
            $nb=User::where('account_details', 'LIKE', '%'. $input['craccount']. '%')->first();

            if(!$nb) {
                return response()->json(['status' => '07', 'status_desc'=>'Invalid Account']);
            }

            return $this->tryDedicatedUser($input['amount'], $input['paymentreference'], $nb, $dwl, "wema");
        }

        return $this->tryDedicatedBusiness($input['amount'], $input['paymentreference'], $nb, $dwl, "wema");
    }

    public function tryDedicatedUser($amount, $reference, $nb, $dwl, $gateway){

        $trans=Transaction::where("reference", $reference)->first();
        $totalFee=0;

        if($trans){
            return response()->json(['status' => '07', 'status_desc'=>'Account credited earlier']);
        }

        //adding transaction fee
        $transaction_fee="0";

        $wallet=Wallet::where('user_id', $nb->id)->first();
        $currentBal=$wallet->balance;

        Transaction::create([
            'business_id' => $nb->business_id,
            'user_id' => $nb->id,
            'uuid' => $nb->uuid,
            'reference' => $reference,
            'type' => 'credit',
            'remark' => "NGN $amount deposited from ".$dwl->originatorname . "(".$dwl->originatoraccountnumber.")",
            'amount' => $amount,
            'previous' => $currentBal,
            'balance' => $wallet->balance
        ]);

        $varstFee=FeesSetting::where("type","Wallet Top Up")->first();

        if($varstFee){
            $varstDeductFee=$this->calCulateFeee($varstFee, $amount);
            $totalFee+=$varstDeductFee;
            $this->insertRevenue("0", "varst_".$reference,$varstDeductFee,0);

            $bizFee=FeesSettingsAgent::where([["fees_settings_id", $varstFee->id], ["business_id", $nb->business_id]])->first();

            if($bizFee){
                $bizDeductFee=$this->calCulateFeee($bizFee, $amount);
                $totalFee+=$bizDeductFee;
                $this->insertRevenue($nb->business_id, "biz_".$reference,$bizDeductFee,"0");
            }
        }

        $amn=$amount - $totalFee;

        $wallet->balance += $amn;
        $wallet->save();


        return response()->json(['status' => '00', 'status_desc'=>'Account credited successfully', 'transactionreference'=>$reference]);
    }

    public function tryDedicatedBusiness($amount, $reference, $nb, $dwl, $gateway){

        $trans=Transaction::where("reference", $reference)->first();

        if($trans){
            return response()->json(['status' => '07', 'status_desc'=>'Account credited earlier']);
        }

        //adding transaction fee
        $transaction_fee="0";

        $currentBal=$nb->wallet;

        $nb->wallet += $amount;
        $nb->save();

        Transaction::create([
            'business_id' => $nb->id,
            'user_id' => $nb->user_id,
            'uuid' => $nb->User->uuid,
            'reference' => $reference,
            'type' => 'credit',
            'remark' => "NGN $amount deposited from ".$dwl->originatorname . "(".$dwl->originatoraccountnumber.")",
            'amount' => $amount,
            'previous' => $currentBal,
            'balance' => $nb->wallet
        ]);


        return response()->json(['status' => '00', 'status_desc'=>'Account credited successfully', 'transactionreference'=>$reference]);
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
