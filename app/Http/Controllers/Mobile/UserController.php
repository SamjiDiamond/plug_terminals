<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Jobs\ReferralLinkSenderJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {

        $input = $request->myPayload;

        if (!isset($input)) {
            return response()->json(['success' => false, 'message' => 'Encryption issue']);
        }

        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Error in request', 'error' => $validator->errors()], 400);
        }

        if(Auth::user()->email != $input['email']){
            $fu=User::where('email', $input['email'])->exists();

            if($fu){
                return response()->json(['status' => false, 'message' => 'Request Rejected. Email already exist for another user.']);
            }
        }

        $user=User::find(Auth::id());

        $user->firstname=$input['first_name'];
        $user->lastname=$input['last_name'];
        $user->email=$input['email'];
        $user->phone=$input['phone'];
        $user->save();

        return response()->json(['status' => true, 'message' => 'Profile Saved Successfully']);
    }

    public function updatePassword(Request $request)
    {

        $input = $request->myPayload;

        if (!isset($input)) {
            return response()->json(['success' => false, 'message' => 'Encryption issue']);
        }

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

    public function validatePhones(Request $request)
    {

        $input = $request->myPayload;

        if (!isset($input)) {
            return response()->json(['success' => false, 'message' => 'Encryption issue']);
        }

        $validator = Validator::make($input, [
            'phones' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Required field(s) is missing', 'error' => $validator->errors()->all()]);
        }

        foreach ($input['phones'] as $phone){
            $user=User::where("phone", $phone)->first();

            if($user) {
                $datam["phone"] = $phone;
                $datam["name"] = $user->lastname . " " . $user->firstname;
                $data[] = $datam;
            }
        }


        return response()->json(['status' => true, 'message' => 'Validated Successfully', 'data' => !empty($data) ? $data : []]);
    }

    public function sendReferralLink(Request $request)
    {

        $input = $request->myPayload;

        if (!isset($input)) {
            return response()->json(['success' => false, 'message' => 'Encryption issue']);
        }

        $validator = Validator::make($input, [
            'phones' => 'required|array',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Required field(s) is missing', 'error' => $validator->errors()->all()]);
        }

        $message=$input['message'] ." https://budpay.com/refer/?ref=".Auth::id();

        ReferralLinkSenderJob::dispatch($input['phones'], $message);

        return response()->json(['status' => true, 'message' => 'Referral Link sent Successfully']);
    }
}
