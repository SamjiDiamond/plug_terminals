<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminOnboardingMail;
use App\Mail\PasswordResetMail;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function admins(){
        $data['account_total']=User::where(['business_id' => Auth::user()->business_id, 'admin' => 1])->count();
        $data['account_active']=User::where(['business_id' => Auth::user()->business_id, 'admin' => 1, 'status' =>1])->count();
        $data['account_inactive']=$data['account_total'] - $data['account_active'];
        $data['accounts']=User::where(['business_id' => Auth::user()->business_id, 'admin' => 1])->latest()->simplePaginate(20)->fragment('lists');
        $data['i']=1;
        return view('verdant.admin.admins', $data);
    }

    function createAdmin(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|max:200',
            'lastName' => 'required|max:200',
            'email' => 'required|max:200|email|unique:users',
            'phone' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $password = substr(uniqid(),0,8);

        $u = User::create([
            'firstname' => $input['firstName'],
            'lastname' => $input['lastName'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($password),
            'uuid' => Auth::user()->uuid,
            'dob' => '',
            'gender' => '',
            'superadmin' => 1,
            'admin' => 1,
            'agent' => 0,
            'business_id' => Auth::user()->business_id,
        ]);


        Wallet::create([
            'user_id' => $u->id,
            'name' => 'deposit'
        ]);

        $datas['password'] = $password;

        Mail::to($input['email'])->send(new AdminOnboardingMail($u, $datas));

        return redirect()->route('admin.admins')->with("success", "Admin created successfully. Login credentials has been sent to the email provided.");

    }

    function resetPassword($id){

        $user=User::find($id);

        if(!$user){
            return back()->with("error", "Admin not found");
        }

        if($user->admin == 0 && $user->superadmin == 0 ){
            return back()->with("error", "Admin account not found");
        }

        $password = substr(uniqid(),0,8);

        $user->password = Hash::make($password);
        $user->save();

        $datas['password'] = $password;
        $datas['reset_by'] = Auth::user()->firstname . " " . Auth::user()->lastname;

        Mail::to($user->email)->send(new PasswordResetMail($user, $datas));

        return redirect()->route('admin.admins')->with("success", "Admin password reset successfully. New password has been sent to the admin email.");

    }

    function edAdmin($id){

        $user=User::find($id);

        if(!$user){
            return back()->with("error", "Admin not found");
        }

        if($user->admin == 0 && $user->superadmin == 0 ){
            return back()->with("error", "Admin account not found");
        }

        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return redirect()->route('admin.admins')->with("success", "Admin status changed successfully.");
    }

    function deleteAdmin($id){

        $user=User::find($id);

        if(!$user){
            return back()->with("error", "Admin not found");
        }

        if($user->admin == 0 && $user->superadmin == 0 ){
            return back()->with("error", "Admin account not found");
        }

        $user->delete();

        return redirect()->route('admin.admins')->with("success", "Admin deleted successfully.");
    }
}
