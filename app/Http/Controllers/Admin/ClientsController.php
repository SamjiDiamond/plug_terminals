<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Kyc;
use App\Models\Revenue;
use App\Models\Terminal;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function clients()
    {
        $datas['client_total'] = Business::count();
        $datas['client_active'] = Business::where("status", 1)->count();
        $datas['client_inactive'] = Business::where("status", 0)->count();
        $datas['client_recent'] = Business::latest()->limit(4)->get();
        $datas['clients'] = Business::with('Customers', 'Terminals', 'Transactions', 'Income', 'Disbursement')->latest()->simplePaginate(10)->fragment('lists');

        return view('verdant.admin.clients', $datas);
    }

    public function details($id)
    {

        $datas['client'] = Business::find($id);

        if(!$datas['client']){
            return redirect()->route('admin.clients')->with('error', 'Client does not exist');
        }

        $datas['trx_total'] = Transaction::where("business_id", $id)->sum('amount');
        $datas['trx_success'] = Transaction::where("business_id", $id)->where("status", 1)->sum('amount');
        $datas['trx_pending'] = Transaction::where("business_id", $id)->where("status", 0)->sum('amount');
        $datas['trx_reversed'] = Transaction::where("business_id", $id)->where("status", 2)->sum('amount');
        $datas['trx_failed'] = Transaction::where("business_id", $id)->where("status", 4)->sum('amount');

        $datas['terminal_total'] = Terminal::where("business_id", $id)->count();
        $datas['terminal_mapped'] = Terminal::where("business_id", $id)->where("status", 1)->count();
        $datas['terminal_unmapped'] = Terminal::where("business_id", $id)->where("status", 0)->count();

        $datas['customers_total'] = Customer::where("business_id", $id)->count();
        $datas['customers_active'] = Customer::where("business_id", $id)->where("status", 1)->count();
        $datas['customers_inactive'] = Customer::where("business_id", $id)->where("status", 0)->count();

        $datas['transactions'] = Transaction::where("business_id", $id)->with('user')->latest()->limit(10)->get();


        return view('verdant.admin.client_details', $datas);
    }

    public function transactions($id)
    {
        $datas['client'] = Business::find($id);

        if(!$datas['client']){
            return redirect()->route('admin.clients')->with('error', 'Client does not exist');
        }

        $datas['trx_total'] = Transaction::where("business_id", $id)->sum('amount');
        $datas['trx_success'] = Transaction::where("business_id", $id)->where("status", 1)->sum('amount');
        $datas['trx_pending'] = Transaction::where("business_id", $id)->where("status", 0)->sum('amount');
        $datas['trx_reversed'] = Transaction::where("business_id", $id)->where("status", 2)->sum('amount');
        $datas['trx_failed'] = Transaction::where("business_id", $id)->where("status", 4)->sum('amount');

        $datas['transactions'] = Transaction::where("business_id", $id)->with('user')->latest()->simplePaginate(50)->fragment('lists');


        return view('verdant.admin.client_details_transactions', $datas);
    }

    public function terminal($id)
    {
        $datas['client'] = Business::find($id);

        if(!$datas['client']){
            return redirect()->route('admin.clients')->with('error', 'Client does not exist');
        }

        $datas['terminal_total'] = Terminal::where("business_id", $id)->count();
        $datas['terminal_mapped'] = Terminal::where("business_id", $id)->where("status", 1)->count();
        $datas['terminal_unmapped'] = Terminal::where("business_id", $id)->where("status", 0)->count();

        $datas['terminals'] = Terminal::where("business_id", $id)->with('agent')->latest()->simplePaginate(50)->fragment('lists');

        return view('verdant.admin.client_details_terminals', $datas);
    }

    public function customers($id)
    {

        $datas['client'] = Business::find($id);

        if(!$datas['client']){
            return redirect()->route('admin.clients')->with('error', 'Client does not exist');
        }

        $datas['customers_total'] = Customer::where("business_id", $id)->count();
        $datas['customers_active'] = Customer::where("business_id", $id)->where("status", 1)->count();
        $datas['customers_inactive'] = Customer::where("business_id", $id)->where("status", 0)->count();

        $datas['customers'] = Customer::where("business_id", $id)->with('user')->latest()->simplePaginate(50)->fragment('lists');

        return view('verdant.admin.client_details_customers', $datas);
    }

    public function income($id)
    {
        $datas['client'] = Business::find($id);

        if(!$datas['client']){
            return redirect()->route('admin.clients')->with('error', 'Client does not exist');
        }

        $datas['book'] = 0;
        $datas['cash_in'] = Revenue::where("business_id", $id)->where("type", "credit")->sum('amount');
        $datas['cash_out'] = Revenue::where("business_id", $id)->where("type", "debit")->sum('amount');
        $datas['revenues'] = Revenue::where("business_id", $id)->latest()->simplePaginate(50)->fragment('lists');

        return view('verdant.admin.client_details_income', $datas);
    }

    public function kyc($id)
    {
        $datas['client'] = Business::find($id);

        if(!$datas['client']){
            return redirect()->route('admin.clients')->with('error', 'Client does not exist');
        }

        $datas['kyc'] = Kyc::where("business_id",$id)->first();

        return view('verdant.admin.client_details_kyc', $datas);
    }

    public function kyc_update($id)
    {
        $datas['client'] = Business::find($id);

        if(!$datas['client']){
            return redirect()->route('admin.clients')->with('error', 'Client does not exist');
        }

        $datas['client']->status=$datas['client']->status == 1 ? 0 : 1;
        $datas['client']->save();

        return back()->with(['success' => 'Client status updated successfully']);
    }

}
