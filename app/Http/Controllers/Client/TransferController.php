<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Mobile\PayoutController;
use App\Models\Business;
use App\Models\transfer;
use App\Models\TransferFee;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransferController
{
public function index()
{


    $pc=new PayoutController();
    $auth=$pc->login();


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

    $data = json_decode($response, true);

    $trans=transfer::where('user_id', Auth::user()->id)->limit(10)->latest()->get();
    return view('verdant.client.transfer', compact('data', 'trans'));
}

public function verify(Request $request)
{
    $input = $request->all();

    $validator = Validator::make($request->all(), [
        'amount' => ['required', 'min:1'],
        'bank' => 'required',
        'code' => 'required',
        'number' => ['required', 'min:10', 'max:10'],

    ]);

    if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }

    $pc=new PayoutController();
    $auth=$pc->login();

    $input['bank_code']="058";
    $input['account_number']="0112169539";
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

    $tran =  $resp['accountName'];

    return view('verdant.client.verify',compact('tran', 'request'));
}

public function transfer(Request $request)
{


    $my=Business::find(Auth::user()->business_id);

    if($request->amount < 1){
        $mg = "Invalid Amount Entry";
        Alert::warning('Alert', $mg );

        return redirect('transfer');
    }

    if ($request->amount<1000){
        $mg = "Your Amount must be more than ₦1,000 ";
        Alert::warning('Alert', $mg );
        return redirect('transfer');

    }


    if ($my->wallet < $request->amount){
        $mg = "You Can't Make Transfer Of " . "₦" . $request->amount . " from your wallet. Your wallet balance is ₦ $my->wallet.";
        Alert::warning('Alert', $mg );

        return redirect('transfer');
    }


    $ref=transfer::where('refid', $request->refid)->first();
    if (isset($ref)){
        $mg = "Duplicate Transaction";
        Alert::warning('Alert', $mg );
        return redirect('transfer');
    }
    $fee=TransferFee::all();
        $charge = "0";
        foreach ($fee as $fees){
            $min=$fees['range_min'];
            $max=$fees['range_max'];
            if ($request->amount >= $min && $request->amount <= $max){
                $charge= $fees['fee'];
            }

        }

    transfer::create([
        'user_id'=>Auth::id(),
        'business_id'=>Auth::user()->business_id,
        'amount'=>$request['amount'],
        'bankcode'=>$request['bank'],
        'account_no'=>$request['number'],
        'narration'=>$request['narration'],
        'refid'=>$request['refid'],
        'fee'=>$charge,
    ]);

    $myfee=$request->amount+$charge;
    $debit=$my->wallet-$myfee;

    $my->wallet=$debit;
    $my->save();
    $mg="Success Transaction";
    Alert::info('Pending', $mg);
    return redirect("transfer");
}
}
