<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AgentTransferController extends Controller
{
    public function fectchagent()
    {
        $agent=User::where(['business_id' => Auth::user()->business_id, 'agent'=>1])->get();

        return view('verdant.client.agent-transfer',compact('agent'));
    }

    public function agenttrans(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'amount'=>'required',
            'reference'=>'required',
            'narration'=>'nullable',
        ]);

        if($request->amount < 1){
            Alert::warning('Alert', "Invalid Amount supplied" );

            return redirect('transfer');
        }

        $my=Business::find(Auth::user()->business_id);
        $wallet=Wallet::where('user_id', Auth::user()->id)->first();
        $agent=User::where('id', $request->id)->first();
        $walletagent=Wallet::where('user_id', $agent->id)->first();

        if ($my->wallet < $request->amount){
            $mg = "You can't make transfer of " . "₦" . $request->amount . " from your business wallet. Your business wallet balance is ₦ $my->wallet.";
            Alert::warning('Alert', $mg );

            return back();
        }


        $ref=Transaction::where('reference', $request->reference)->first();
        if (isset($ref)){
            $mg = "Duplicate Transaction";
            Alert::warning('Alert', $mg );
            return back();
        }

        $debit=$my->wallet-$request->amount;

        $iwallet=$my->wallet;
        $fwallet=$iwallet-$request->amount;

        Transaction::create([
            'business_id'=>Auth::user()->business_id,
            'user_id'=>Auth::id(),
            'uuid'=>Auth::user()->uuid,
            'reference'=>$request->reference,
            'type'=>'debit',
            'remark'=>$request->narration.' Debited from '.$my->name. ' wallet.  Transferred by '.Auth::user()->firstname,
            'amount'=>$request->amount,
            'previous'=>$iwallet,
            'balance'=>$fwallet,
        ]);
        $my->wallet=$fwallet;
        $my->save();

        $iagent=$walletagent->balance;
        $fagent=$iagent+$request->amount;
        Transaction::create([
            'business_id'=>Auth::user()->business_id,
            'user_id'=>$request->id,
            'uuid'=>$agent->uuid,
            'reference'=>$request->reference,
            'type'=>'credit',
            'remark'=>$request->narration.' Transferred by '.Auth::user()->firstname,
            'amount'=>$request->amount,
            'previous'=>$iagent,
            'balance'=>$fagent,
        ]);
        WalletTransaction::create([
            'user_id'=>$request->id,
            'uuid'=>$agent->uuid,
            'amount'=>$request->amount,
            'description'=>$request->narration.' Transferred by '.Auth::user()->firstname,
            'type'=>'credit',
            'prev_bal'=>$iagent,
            'cur_bal'=>$fagent,
        ]);

        $walletagent->balance=$fagent;
        $walletagent->save();
        $mg="You have successfully transfer NGN".$request->amount." to ".$agent->firstname;
        Alert::Success('Success', $mg);
        return back();
    }
}
