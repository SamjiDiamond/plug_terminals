<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function settings(){
        $data['business']=Business::find(Auth::user()->business_id);
        return view('verdant.client.settings', $data);
    }

    public function apiKey(){
        $biz=Business::find(Auth::user()->business_id);
        $key="VTk_".str_shuffle(uniqid().rand());
        $biz->secret_key=$key;
        $biz->save();

        return redirect()->route('settings')->with('success', 'Api key generated successfully');
    }
}
