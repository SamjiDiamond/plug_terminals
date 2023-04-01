<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    function profile(){
        return response()->json(['success' => true, 'message' => 'Fetched', 'data' => Auth::user()]);
    }

    function transactions(){
        $datas=Transaction::where('user_id', Auth::id())->with('bills', 'transfer')->latest()->get();

        return response()->json(['success' => true, 'message' => 'Fetched', 'data' => $datas]);
    }

    function wallets(){
        $datas=Wallet::where(['user_id' => Auth::id()])->get();

        return response()->json(['success' => true, 'message' => 'Fetched', 'data' => $datas]);
    }

    public function updatePassword(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'current' => 'required',
            'new' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Error in request', 'error' => $validator->errors()]);
        }

        if(!Hash::check($input['current'], Auth::user()->password)){
            return response()->json(['status' => false, 'message' => 'Current password did not match']);
        }

        $user=User::find(Auth::id());

        $user->password=Hash::make($input['new']);
        $user->save();

        return response()->json(['status' => true, 'message' => 'Password Changed Successfully']);
    }
}
