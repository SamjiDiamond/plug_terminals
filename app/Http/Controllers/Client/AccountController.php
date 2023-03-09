<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    function account(){
        $data['account_total']=User::where(['business_id' => Auth::user()->business_id, 'uuid' => Auth::user()->uuid, 'sub_agent' => 1])->count();
        $data['account_active']=User::where(['business_id' => Auth::user()->business_id, 'uuid' => Auth::user()->uuid, 'sub_agent' => 1, 'status' =>1])->count();
        $data['account_inactive']=$data['account_total'] - $data['account_active'];
        $data['amount_processed']=Transaction::where('business_id', Auth::user()->business_id)->sum('amount');
        $data['amount_inflow']=Transaction::where(['business_id' => Auth::user()->business_id, 'type' => 'credit'])->sum('amount');
        $data['amount_outflow']=$data['amount_processed'] - $data['amount_inflow'];

        $data['accounts']=User::where(['business_id' => Auth::user()->business_id, 'uuid' => Auth::user()->uuid, 'sub_agent' => 1])->latest()->simplePaginate(20)->fragment('lists');
        $data['i']=1;

        return view('verdant.client.account', $data);
    }
}
