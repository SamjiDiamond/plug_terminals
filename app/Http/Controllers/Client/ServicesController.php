<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\FeesSetting;
use App\Models\FeesSettingsAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    function listServices(){
        $data['list']=FeesSettingsAgent::where('business_id', Auth::user()->business_id)->with('parentData')->get();
        return view('verdant.client.services', $data);
    }

    function updateFee(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'type' => 'required',
            'fee' => 'required',
            'capfee' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $fs=FeesSettingsAgent::find($input['id']);

        if(!$fs){
            return back()->with("danger", "Invalid service");
        }

        $fs->fee_type=$input['type'];
        $fs->fee=$input['fee'];
        $fs->capped_fee=$input['capfee'];
        $fs->save();

        return redirect()->route('services')->with("success", "Settings changed successfully");
    }
}
