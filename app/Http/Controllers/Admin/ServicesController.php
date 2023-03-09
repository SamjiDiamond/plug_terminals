<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeesSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    function listServices(){
        $data['list']=FeesSetting::get();
        return view('verdant.admin.services', $data);
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

        $fs=FeesSetting::find($input['id']);

        if(!$fs){
            return back()->with("danger", "Invalid service");
        }

        $fs->fee_type=$input['type'];
        $fs->fee=$input['fee'];
        $fs->capped_fee=$input['capfee'];
        $fs->save();

        return redirect()->route('admin.services')->with("success", "Settings changed successfully");
    }
}
