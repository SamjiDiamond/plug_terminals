<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\AssignTerminalMail;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Terminal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TerminalController extends Controller
{
    function terminals(){

        $datas['terminal_total'] = Terminal::where('business_id', Auth::user()->business_id)->count();
        $datas['terminal_mapped'] = Terminal::where('business_id', Auth::user()->business_id)->where("agent_id", '!=', 'NULL')->count();
        $datas['terminal_unmapped'] = $datas['terminal_total']  - $datas['terminal_mapped'];
        $datas['terminals'] = Terminal::where('business_id', Auth::user()->business_id)->with('agent')->latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.client.terminals', $datas);
    }

    function map_terminal(){
        $datas['terminals'] = Terminal::where('business_id', Auth::user()->business_id)->where("agent_id", NULL)->get();
        $datas['business'] = User::where(["business_id" => Auth::user()->business_id, "agent" => 1])->get();
        return view('verdant.client.map_terminal', $datas);
    }

    function map_terminal_post(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'terminal_id' => 'required|max:200',
            'user_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user=User::find($input['user_id']);

        $terminal=Terminal::find($input['terminal_id']);
        $terminal->agent_id=$input['user_id'];
        $terminal->status=1;
        $terminal->save();

        Mail::to($user->email)->send(new AssignTerminalMail($user,$terminal));

        return back()->with(['success' => 'Terminal Mapped successfully']);
    }

    function terminalTransactions($id){
        $datas['terminal'] = Terminal::where(['business_id'=> Auth::user()->business_id, 'id' => $id])->with('agent')->first();

        if(!$datas['terminal']){
            return redirect()->route('terminals')->with('error', 'Terminal not found');
        }

        $response='{"list":[{"reference":"WDL-9ea53114-fbdc-41a3-b892-9be7b450961e-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793876.9,"timeCreated":"2022-07-19T08:35:22.518+0100"},{"reference":"WDL-21e0786b-5bc1-4d1b-9546-e2e57b16f795-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793860,"timeCreated":"2022-07-18T01:09:06.368+0100"},{"reference":"WDL-f5944c2c-a6c0-4d79-9221-e21452b54e04-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793860,"timeCreated":"2022-07-18T00:44:12.162+0100"},{"reference":"WDL-df81cda7-a4cf-4a39-af79-d6a3e951ccd4-CREDIT","amount":5450,"transactionType":"CREDIT","balance":1788410,"timeCreated":"2022-07-17T20:57:42.703+0100"},{"reference":"TRF-1b25243a-f4e3-4bc9-a7a0-524d2df640e9-DEBIT","amount":527,"transactionType":"DEBIT","balance":1788410,"timeCreated":"2022-07-13T12:28:20.812+0100"}],"page":1,"size":0,"total":91}';
        $resp=json_decode($response);
        $datas['transactions'] =$resp->list;
        return view('verdant.client.terminal_transactions', $datas);
    }

    function revokeTerminal($id){
        $terminal = Terminal::where(['business_id'=> Auth::user()->business_id, 'id' => $id])->with('agent')->first();

        if(!$terminal){
            return redirect()->route('terminals')->with('error', 'Terminal not found');
        }

        $terminal->agent_id=NULL;
        $terminal->status=0;
        $terminal->save();

        return redirect()->route('terminals')->with('success', 'Terminal revoked successfully');

    }

}
