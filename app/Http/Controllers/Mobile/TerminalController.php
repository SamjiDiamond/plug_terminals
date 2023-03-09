<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TerminalController extends Controller
{
    function terminalList(){
        $datas=Terminal::where('agent_id', Auth::id())->get();
        return response()->json(['status' => true, 'message' => 'Fetched', 'datas' =>$datas]);
    }


    function terminalTransactions($id){
        $response='{"list":[{"reference":"WDL-9ea53114-fbdc-41a3-b892-9be7b450961e-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793876.9,"timeCreated":"2022-07-19T08:35:22.518+0100"},{"reference":"WDL-21e0786b-5bc1-4d1b-9546-e2e57b16f795-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793860,"timeCreated":"2022-07-18T01:09:06.368+0100"},{"reference":"WDL-f5944c2c-a6c0-4d79-9221-e21452b54e04-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793860,"timeCreated":"2022-07-18T00:44:12.162+0100"},{"reference":"WDL-df81cda7-a4cf-4a39-af79-d6a3e951ccd4-CREDIT","amount":5450,"transactionType":"CREDIT","balance":1788410,"timeCreated":"2022-07-17T20:57:42.703+0100"},{"reference":"TRF-1b25243a-f4e3-4bc9-a7a0-524d2df640e9-DEBIT","amount":527,"transactionType":"DEBIT","balance":1788410,"timeCreated":"2022-07-13T12:28:20.812+0100"}],"page":1,"size":0,"total":91}';
        $datas['transactions'] =json_decode($response);
        return response()->json(['status' => true, 'message' => 'Fetched', 'datas' =>$datas]);
    }
}
