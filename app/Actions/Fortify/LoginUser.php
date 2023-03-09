<?php

namespace App\Actions\Fortify;

use App\Models\BankAccounts;
use App\Models\Business;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginUser
{

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user &&
            Hash::check($request->password, $user->password)) {
            return $user;
        }
    }
}
