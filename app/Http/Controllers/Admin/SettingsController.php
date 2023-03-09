<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function settings(){
        $data['business']=Business::find(Auth::user()->business_id);
        return view('verdant.admin.settings', $data);
    }
}
