<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    function transactions(){
        $id=Auth::user()->business_id;
        $datas['trx_total'] = Transaction::where('business_id', $id)->sum('amount');
        $datas['trx_success'] = Transaction::where([['business_id', $id],["status", 1]])->sum('amount');
        $datas['trx_pending'] = Transaction::where([['business_id', $id],["status", 0]])->sum('amount');
        $datas['trx_reversed'] = Transaction::where([['business_id', $id],["status", 2]])->sum('amount');
        $datas['trx_failed'] = Transaction::where([['business_id', $id],["status", 4]])->sum('amount');

        $datas['trxs'] = Transaction::where('business_id', $id)->latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.client.transactions', $datas);
    }
}
