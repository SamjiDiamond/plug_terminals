<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    function customer(){
        $datas['customers_total'] = Customer::where('business_id', Auth::user()->business_id)->count();
        $datas['customers_active'] = Customer::where('business_id', Auth::user()->business_id)->where("status", 1)->count();
        $datas['customers_inactive'] = Customer::where('business_id', Auth::user()->business_id)->where("status", 0)->count();
        $datas['customers'] = Customer::where('business_id', Auth::user()->business_id)->latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.client.customers', $datas);
    }

    function createAgent(){
        return view('verdant.client.create_agent');
    }
}
