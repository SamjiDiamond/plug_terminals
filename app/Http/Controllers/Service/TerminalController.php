<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TerminalController extends Controller
{
    function terminals(Request $request){
        $terminals = Terminal::where('business_id', $request->get('biz')->id)->latest()->simplePaginate(20);

        return response()->json(['success' => true, 'message' => 'Fetched successfully', 'data' => $terminals]);
    }

    function terminalwserial(Request $request, $serial){
        $terminals = Terminal::where([['business_id', $request->get('biz')->id],['serial_number', $serial]])->first();

        if(!$terminals){
            return response()->json(['success' => false, 'message' => 'Terminal not found']);
        }

        return response()->json(['success' => true, 'message' => 'Fetched successfully', 'data' => $terminals]);
    }

    function terminalTransactions(Request $request, $id){
        $datas['terminal'] = Terminal::where(['business_id'=> $request->get('biz')->id, 'id' => $id])->select("id", "terminal_id" ,"serial_number","status")->first();

        if(!$datas['terminal']){
            return response()->json(['success' => false, 'message' => 'Terminal not found']);
        }

        $response='{"list":[{"reference":"WDL-9ea53114-fbdc-41a3-b892-9be7b450961e-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793876.9,"timeCreated":"2022-07-19T08:35:22.518+0100"},{"reference":"WDL-21e0786b-5bc1-4d1b-9546-e2e57b16f795-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793860,"timeCreated":"2022-07-18T01:09:06.368+0100"},{"reference":"WDL-f5944c2c-a6c0-4d79-9221-e21452b54e04-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793860,"timeCreated":"2022-07-18T00:44:12.162+0100"},{"reference":"WDL-df81cda7-a4cf-4a39-af79-d6a3e951ccd4-CREDIT","amount":5450,"transactionType":"CREDIT","balance":1788410,"timeCreated":"2022-07-17T20:57:42.703+0100"},{"reference":"TRF-1b25243a-f4e3-4bc9-a7a0-524d2df640e9-DEBIT","amount":527,"transactionType":"DEBIT","balance":1788410,"timeCreated":"2022-07-13T12:28:20.812+0100"}],"page":1,"size":0,"total":91}';
        $resp=json_decode($response);
        $datas['transactions'] =$resp->list;

        return response()->json(['success' => true, 'message' => 'Fetched successfully', 'data' => $datas]);

    }

}
