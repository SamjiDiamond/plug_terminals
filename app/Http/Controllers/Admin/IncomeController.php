<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Revenue;
use App\Models\Wallet;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    function income(){
        $datas['wallet'] = Wallet::where([["name","revenue"], ["user_id",0]])->first();
        $datas['cash_in'] = Revenue::where([["type", "credit"], ["business_id", 0]])->sum('amount');
        $datas['cash_out'] = Revenue::where([["type", "debit"], ["business_id", 0]])->sum('amount');

        $datas['revenues'] = Revenue::where([["business_id", 0]])->latest()->simplePaginate(10)->fragment('lists');

        return view('verdant.admin.income', $datas);
    }
}
