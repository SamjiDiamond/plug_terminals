<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WemaController;
use App\Jobs\SendEmailVerificationNotificationJob;
use App\Mail\ClientWelcomeMail;
use App\Mail\EmailVerificationMail;
use App\Mail\UserWelcomeMail;
use App\Models\AvailableWallet;
use App\Models\Business;
use App\Models\BusinessCredentials;
use App\Models\CodeRequest;
use App\Models\Terminal;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{

    public function register(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
            'phone' => ['required', 'string'],
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['success' => false, 'message' => implode(",",$validator->errors()->all()), 'error' => $validator->errors()->all()]);
        }

        $user= User::create([
            'business_id' => 0,
            'firstname' => $input['first_name'],
            'lastname' => $input['last_name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'dob' => "",
            'gender' => "",
            'uuid' => hexdec(uniqid() . rand(0, 100)),
        ]);


        Wallet::create([
            'user_id' => $user->id,
            'name' => 'deposit'
        ]);

//        Mail::to($user->email)->send(new ClientWelcomeMail($user));

        return response()->json(['success' => true, 'message' => 'Registration successful', 'data' => $user]);
    }

    public function setPin(Request $request)
    {
        $input = $request->myPayload;

        if(!isset($input)){
            return response()->json(['success' => false, 'message' => 'Encryption issue']);
        }

        $rules = array(
            'pin' => ['required', 'string', 'max:255']
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['success' => false, 'message' => 'Required field(s) is missing', 'error' => $validator->errors()->all()]);
        }

        $u=User::where('id', Auth::id())->first();

        if(!$u){
            return response()->json(['success' => false, 'message' => 'User not found']);
        }

        $u->pin=$input['pin'];
        $u->save();

        return response()->json(['success' => true, 'message' => 'Pin set successfully']);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['success' => false, 'message' => implode(", ", $validator->errors()->all()), 'error' => $validator->errors()->all()]);
        }

        $user = User::where([['email', $input['email']]])->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid credentials']);
        }

        if (!Hash::check($input['password'], $user->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password attempt']);
        }


        if($user->account_details == 0){
            $wema=new WemaController();
            $user->account_details=$wema->generateVirtual();
            $user->save();
        }

        // Revoke all tokens...
        $user->tokens()->delete();

        $token = $user->createToken($_SERVER['HTTP_USER_AGENT']??'app')->plainTextToken;

        $terminals=Terminal::where(["business_id" => $user->business_id, "agent_id"=>$user->id])->get();

        return response()->json(['success' => true, 'message' => 'Login successfully', 'token' => $token, 'data' => $user, 'terminals' => $terminals]);
    }

    public function resetPassword(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'email' => 'required|email'
        );

        $validator = Validator::make($input, $rules);

        if (!$validator->passes()) {
            return response()->json(['success' => false, 'message' => 'Required field(s) is missing', 'error' => $validator->errors()->all()]);
        }

        $user = User::where('email', $input['email'])->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Email does not exist']);
        }
        $status = Password::sendResetLink(
            $input
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['success' => true, 'message' => __($status)])
            : response()->json(['success' => false, 'message' => __($status)]);

    }

    //Password Reset
    public function forget_password_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'code' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => implode(",", $validator->errors()->all())]);
        }

        $type = "recover";

        $reg = CodeRequest::where([['mobile', $request->email], ['status', 0], ['type', $type]])->latest()->first();

        if ($reg == null) {
            return response()->json(['success' => false, 'message' => 'Kindly request for OTP']);
        }

        if ($reg->code != $request->code) {
            return response()->json(['success' => false, 'message' => 'Verification code did not match']);
        }

        User::where(['phone' => $request->email])->orWhere(['email' => $request->email])->update([
            'password' => Hash::make($request->password)
        ]);

        $reg->status = 1;
        $reg->save();

        return response()->json(['success' => true, 'message' => 'Password reset successfully.']);
    }

    //Verify Code
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => implode(",", $validator->errors()->all()), 'errors' => $validator->errors()]);
        }

        $type = "recover";

        $reg = CodeRequest::where([['mobile', $request->email], ['status', 0], ['type', $type]])->latest()->first();

        if ($reg == null) {
            return response()->json(['success' => false, 'message' => 'Kindly request for OTP']);
        }

        if ($reg->code != $request->code) {
            return response()->json(['success' => false, 'message' => 'Verification code did not match']);
        }

//        $reg->status = 1;
//        $reg->save();

        return response()->json(['success' => true, 'message' => 'Code confirmed successfully.']);
    }

    public function sendcode(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => implode(",", $validator->errors()->all()), 'errors' => $validator->errors()]);
        }

        $em = User::where("email", $input['email'])->first();

        if (!$em) {
            return response()->json(['success' => false, 'message' => 'Email does not exist']);
        }

        $code = substr(rand(), 0, 6);

        CodeRequest::create([
            'mobile' => $input['email'],
            'code' => $code,
            'status' => 0,
            'type' => "recover"
        ]);

        Mail::to($input['email'])->send(new EmailVerificationMail($code));

        return response()->json(['success' => true, 'message' => 'Code sent successfully', 'data' => $code]);
    }


    public function decryption(Request $request){
        $validator = Validator::make($request->all(), [
            'data' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()], 400);
        }

        return $this->decrypt($request->data, env('APP_ENC_SECRET'), env('APP_ENC_IVKEY'));

    }

    function decrypt($ciphertext, $sk, $ref){
        $ciphertext = hex2bin($ciphertext);
        $iv = substr($ref, 0, 16);
        return openssl_decrypt($ciphertext, "aes-256-cbc", $sk, OPENSSL_RAW_DATA, $iv);
    }

    function compute_hash($secret, $payload)
    {
        $hexHash = hash_hmac('sha256', $payload, utf8_encode($secret));
        $base64Hash = base64_encode(hex2bin($hexHash));
        return $base64Hash;
    }

    function hash_is_valid($secret, $payload, $verify)
    {
        $computed_hash = $this->compute_hash($secret, $payload);
        return hash_equals($verify, $computed_hash);
    }

    function generateKey(){
        // Create a new pair of private and public key
        $private_key_rsa = openssl_pkey_new(array(
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ));

        $details = openssl_pkey_get_details($private_key_rsa);

        dd($details);

        echo "<br/><br/>";

        $public_key_rsa = openssl_pkey_get_public($details['key']);

        dd($public_key_rsa);

        echo "<br/><br/>";

    }

    function testKey(){
        $key='-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAggreAKo/FbckJC8bSNbr
RmnsxmrS/kqt4U68XIkWBBLaG9N1ABRCXFaNoPOgCzpWxJVcYLpCzI5SQs3w1nLc
8N+cSlnzWHvHXk/mgqzlPv4QPfw36+RW33DprgFYfQ54TxmbnmO2ko1YsznGmBKy
chJNdteiG9VqgZvtdkdJgp7DWQEnlRncOhCCYz/PFMXPMqlyEr5jxaYT1Zx+nhlV
qBZ+rlT7+2Ih3o3zCJxrlkAFnYVJc43NBRn4RBlEcp8RfmqJdin+UWxBzWfpVNCG
yj887QkPp3cB4IUIxnEuSoRqrXb1SH0AVkjBpSsnw3PA7CbMjxnR2x6OaAp5txFt
lQIDAQAB
-----END PUBLIC KEY-----';

        $public_key_rsa = openssl_pkey_get_public($key);

        dd($public_key_rsa);

        echo "<br/><br/>";

    }

    function createSignature($data){
        $private_key_res='-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAvadK6s7vD0bGmuAisypn7K18QyeQXtwdx9q/bZVsRHWGWY+q
1zgSGDtxav68zipiRgUb/eQpAQ9IeIGcMZoF3YR0/NVKd0EpxbjBv+KaAa3ivi60
IYy5yr85IDOx+t/g60g3yBBr66u0of7TrGYEndc1NpwFM9I2mkiKwXdJbwl6Uj2S
24Bjgq/cJzPd76ro23J0cByWup48hV4vh8csqylWOtczQBB8TrkQz7DetZrpeMkV
UpdZdmhxthwmKAVdnZBbafx4xP/oFBcBVu1OSKKh4c5Jj3BjcxsbYAiqEgxXh5XD
NbIqugz0xpqjpG0IXRqzVmIE8Je0EiCW0sHwuQIDAQABAoIBAEm+YhAZdLVA9PrF
ylhWVeCeuKG4IZfxCRdsBGFM57Na62mpxmk3IToQ6xIKiUm1C09krzSy4grKcYiC
BUT4Oe2fkom5OeJTETYTmCrPpsieX3tJ17rv6FJgtorB7yO4p9F03FPLptsVggA3
gQEZDhR92PAqDI/Q3nBxYprFkmU849rd6v8Ylwtno6qktYG+415hIR8OJ2uPCmnd
yqH3kYGwCIsWGnAFVUDG6+dPiMcg1eL8nT2EZUNU6A2rkvdwPrEKDFNXM8WOe4Bs
ywGOnP8b2G3JYogAS27ZpgLef2k/zobPcePaMykLH3CcWCSk6Nh5nvjm4H5BhNiy
VlFC/XECgYEA3O50m6+dCxTzVSvAqZ8ZxjqFXakc1fVg1e/jcIbzh7WI7pKysBvn
akbLHR3cqazrcPzvkZ6pJwwonHprobCy8IWilVNd7CEEeu3JCSfr4qtEah9bhzAL
Qvh+03UBrPK6Nz2CfJ+VvukwurVGm8NWDbgkE3aAIM4IsJS2ga6/820CgYEA28Hb
c4y8HV5o2BcP/UnnC/ju8UOYgaKBqbi/pWDnYTzGv3Jj94/lJbMj5tVjFtwBTfOA
YoUXC7sglha7/lfOSnuBqoIn0MthMN1y2o4A5wgTytNMEbtBsMl66OifB+TkPwYO
AS+sBG5RKpwVpevy6Mn3w+drGCGdPNRuJBfPFv0CgYA8IVZxbRmUA4661p6oS9oq
/pB/zmA/x3okoBbJ8KDlhb4QGLMzhVS1szDi6ta9A4hNBzp46rLlIsUG2bbjmgEJ
v4VhmQAOHWpnvsIhkND9r1l+fKxfne7iulliWg0rsiCGmmIiYxjRjgwqNN5T1JVe
RIjlFzKGOy1YShFmOFab/QKBgQCyBgpkQhdGZ2vh2lT+qLa+USwoUM0j/2Sw/FRs
geMPN6/9+YoYS/6jGsszvZvnMdTwtBlGNnDj9PTCAarLsZARcJoragMdNxUGA+9+
M9lxT27ROXj/SEZAFAg40/G48Gki0SHZPihI8qFYNlenMUx33t2TW067nseFNsX/
ATandQKBgF52ChYyv1sBtML8LXxbgNPhOJA9xLW6yZkW03P1zRV47SAIP03O2X7L
/y3z/YgMRi13Scy4HkNBs4AyDZzPem8pn1PZ6aRP5JHxfGSBDRjRG9Vb5NtFGqH4
9lfTbChQWSEstUE3vbY64hX+OZwJVjjhENnbz+sKFr7R10jl4wBl
-----END RSA PRIVATE KEY-----';

        openssl_sign($data, $signature, $private_key_res, "sha256WithRSAEncryption");
        return base64_encode($signature);
    }

    function verifySignature($data, $signature){
        $public_key_res='-----BEGIN PUBLIC KEY-----
MFswDQYJKoZIhvcNAQEBBQADSgAwRwJASQdwSchKaYEv701AKF1uOSI5RUg5Pt9m
Sd9uDfHswNNzWAkLJOj2rDHjFjsxXVzHwNdfCB4mVPbrYHkjESG5BQIDAQAB
-----END PUBLIC KEY-----';

        $ok = openssl_verify($data, base64_decode($signature), $public_key_res, OPENSSL_ALGO_SHA512);
        if ($ok == 1) {
            echo "valid";
            return true;
        } elseif ($ok == 0) {
            echo "invalid";
            return false;
        } else {
            echo "error: ".openssl_error_string();
            return false;
        }
    }

}
