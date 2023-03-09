<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TerminalsController extends Controller
{
    function terminals(){
        $datas['terminal_total'] = Terminal::count();
        $datas['terminal_mapped'] = Terminal::where("status", 1)->count();
        $datas['terminal_unmapped'] = Terminal::where("status", 0)->count();

        $datas['terminals']=Business::with('Terminals')->latest()->simplePaginate(10)->fragment('lists');

        return view('verdant.admin.terminals', $datas);
    }

    function client_terminals($id){
        $datas['terminal_total'] = Terminal::where('business_id', $id)->count();
        $datas['terminal_mapped'] = Terminal::where([['business_id', $id],["status", 1]])->count();
        $datas['terminal_unmapped'] = Terminal::where([['business_id', $id],["status", 0]])->count();

        $datas['terminals']=Terminal::where('business_id', $id)->latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.admin.terminals', $datas);
    }


    function map_terminal(){
        $datas['business'] = Business::where("status", 1)->get();
        $datas['terminals'] = Terminal::where("status", 0)->latest()->simplePaginate(20);

        return view('verdant.admin.map_terminal', $datas);
    }

    function map_terminal_post(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'serial_number' => 'required|max:200',
            'terminal_id' => 'required|max:200',
            'business_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $term=Terminal::where("serial_number", $input['serial_number'])->first();
        if($term){
            return back()->with(['error' => 'Terminal Serial Number already exist']);
        }

        Terminal::create($input);

        return back()->with(['success' => 'Terminal Mapped successfully']);
    }

    function map_terminal_existing_post(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'business_id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $term=Terminal::find($input['id']);

        if(!$term){
            return back()->with(['success' => 'Invalid Terminal provided']);
        }

        if($term->status == 1){
            return back()->with(['success' => 'Terminal is active with a business']);
        }

        $term->business_id=$input['business_id'];
        $term->status=1;
        $term->save();

        return back()->with(['success' => 'Terminal Mapped successfully']);
    }

    function revokeTerminal($id){
        $terminal = Terminal::find($id);

        if(!$terminal){
            return redirect()->route('terminals')->with('error', 'Terminal not found');
        }

        $terminal->business_id=0;
        $terminal->agent_id=NULL;
        $terminal->status=0;
        $terminal->save();

        return back()->with(['success' => 'Terminal Revoked successfully']);
    }
}
