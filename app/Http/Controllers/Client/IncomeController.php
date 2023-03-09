<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    function income(){
        $datas['biz'] = Business::find(Auth::user()->business_id);
        $datas['cash_in'] = Revenue::where([["type", "credit"], ["business_id", Auth::user()->business_id]])->sum('amount');
        $datas['cash_out'] = Revenue::where([["type", "debit"], ["business_id", Auth::user()->business_id]])->sum('amount');

        $datas['revenues'] = Revenue::where([["business_id", Auth::user()->business_id]])->latest()->simplePaginate(10)->fragment('lists');

        return view('verdant.client.income', $datas);
    }
}
