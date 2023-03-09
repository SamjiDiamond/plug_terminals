<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Jobs\AgencyBillsPaymentSetupJob;
use App\Jobs\AgencyFeeSettingsSetupJob;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Terminal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function dashboard()
    {
        $datas['trx_total'] = Transaction::sum('amount');
        $datas['trx_success'] = Transaction::where("status", 1)->sum('amount');
        $datas['trx_pending'] = Transaction::where("status", 0)->sum('amount');
        $datas['trx_reversed'] = Transaction::where("status", 2)->sum('amount');
        $datas['trx_failed'] = Transaction::where("status", 4)->sum('amount');

        $datas['terminal_total'] = Terminal::count();
        $datas['terminal_mapped'] = Terminal::where("status", 1)->count();
        $datas['terminal_unmapped'] = Terminal::where("status", 0)->count();

        $datas['clients'] = Business::latest()->limit(4)->get();
        $datas['client_total'] = Business::count();
        $datas['client_active'] = Business::where("status", 1)->count();
        $datas['client_inactive'] = Business::where("status", 0)->count();

        $datas['customers_total'] = Customer::count();
        $datas['customers_active'] = Customer::where("status", 1)->count();
        $datas['customers_inactive'] = Customer::where("status", 0)->count();

        return view('verdant.admin.dashboard', $datas);
    }

    public function dashboard_home()
    {
        $datas['trx_total'] = Transaction::where('business_id', Auth::user()->business_id)->sum('amount');
        $datas['trx_success'] = Transaction::where('business_id', Auth::user()->business_id)->where("status", 1)->sum('amount');
        $datas['trx_pending'] = Transaction::where('business_id', Auth::user()->business_id)->where("status", 0)->sum('amount');
        $datas['trx_reversed'] = Transaction::where('business_id', Auth::user()->business_id)->where("status", 2)->sum('amount');
        $datas['trx_failed'] = Transaction::where('business_id', Auth::user()->business_id)->where("status", 4)->sum('amount');

        $datas['terminal_total'] = Terminal::where('business_id', Auth::user()->business_id)->count();
        $datas['terminal_mapped'] = Terminal::where('business_id', Auth::user()->business_id)->where("status", 1)->count();
        $datas['terminal_unmapped'] = Terminal::where('business_id', Auth::user()->business_id)->where("status", 0)->count();

        $datas['customers_total'] = Customer::where('business_id', Auth::user()->business_id)->count();
        $datas['customers_active'] = Customer::where('business_id', Auth::user()->business_id)->where("status", 1)->count();
        $datas['customers_inactive'] = Customer::where('business_id', Auth::user()->business_id)->where("status", 0)->count();
        $datas['new_customers'] = Customer::where('business_id', Auth::user()->business_id)->latest()->limit(5)->get();

        $datas['trxs'] = Transaction::where('business_id', Auth::user()->business_id)->latest()->limit(10)->get();

        AgencyFeeSettingsSetupJob::dispatch(Auth::user()->business_id);
        AgencyBillsPaymentSetupJob::dispatch(Auth::user()->business_id);

        return view('verdant.client.dashboard', $datas);
    }
}
