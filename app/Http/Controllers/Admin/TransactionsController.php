<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    function transactions(){
        $datas['trx_total'] = Transaction::sum('amount');
        $datas['trx_success'] = Transaction::where("status", 1)->sum('amount');
        $datas['trx_pending'] = Transaction::where("status", 0)->sum('amount');
        $datas['trx_reversed'] = Transaction::where("status", 2)->sum('amount');
        $datas['trx_failed'] = Transaction::where("status", 4)->sum('amount');

        $datas['trxs'] = Business::with('Transactions')->latest()->simplePaginate(10)->fragment('lists');

        return view('verdant.admin.transactions', $datas);
    }

    function client_transactions($id){
        $datas['trx_total'] = Transaction::where('business_id', $id)->sum('amount');
        $datas['trx_success'] = Transaction::where([['business_id', $id],["status", 1]])->where()->sum('amount');
        $datas['trx_pending'] = Transaction::where([['business_id', $id],["status", 0]])->sum('amount');
        $datas['trx_reversed'] = Transaction::where([['business_id', $id],["status", 2]])->sum('amount');
        $datas['trx_failed'] = Transaction::where([['business_id', $id],["status", 4]])->sum('amount');

        $datas['trxs'] = Transaction::where('business_id', $id)->latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.admin.transactions', $datas);
    }
}
