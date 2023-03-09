<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WemaController;
use App\Models\Business;
use App\Models\Transaction;
use App\Models\transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisbursementController extends Controller
{
    function disbursement(){
        $business=Business::find(Auth::user()->business_id);

        if($business->account_details == 0){
            $wema=new WemaController();
            $business->account_details=$wema->generateVirtual();
            $business->save();
        }

        $data['account_details'] =$business->account_details;
        $data['account_name'] =$business->name;
        $data['balance'] =$business->wallet;
        $data['total'] =transfer::where(["business_id"=> Auth::user()->business_id])->sum('amount');
        $data['fee'] =transfer::where(["business_id"=> Auth::user()->business_id])->sum('fee');
        $data['success'] =transfer::where(["business_id"=> Auth::user()->business_id, 'status'=>1])->sum('amount');
        $data['failed'] =transfer::where(["business_id"=> Auth::user()->business_id, 'status'=>2])->sum('amount');
        $data['pending'] =transfer::where(["business_id"=> Auth::user()->business_id, 'status'=>0])->sum('amount');
        $data['reversed'] =transfer::where(["business_id"=> Auth::user()->business_id, 'status'=>4])->sum('amount');

        $data['trans'] = transfer::where('business_id', Auth::user()->business_id)->latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.client.disbursement', $data);
    }
}
