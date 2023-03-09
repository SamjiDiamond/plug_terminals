<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WemaController extends Controller
{
    public function accountLookup(Request $request)
    {

        $input = $request->all();
        $rules = array(
            'accountnumber' => 'required'
        );

        $validator = Validator::make($input, $rules);


        if (!$validator->passes()) {
            return response()->json(['status' => '07', 'status_desc' => 'Required field is missing', 'error'=>$validator->errors()]);
        }

        $nb=Business::where('account_details', 'LIKE', '%'. $input['accountnumber']. '%')->first();


        if(!$nb){
            $nb=User::where('account_details', 'LIKE', '%'. $input['accountnumber']. '%')->first();

            if(!$nb) {
                return response()->json(['status' => '07', 'status_desc'=>'Invalid Account']);
            }

            return response()->json(['accountname'=>$nb->firstname . " " . $nb->lastname, 'status' => '00', 'status_desc'=>'Account resolved successfully' ]);
        }

        return response()->json(['accountname'=>$nb->name, 'status' => '00', 'status_desc'=>'Account resolved successfully' ]);
    }

    public function generateVirtual(){
        $bankName="Wema Bank";

        $acctNo=$this->genNumber();

        $fb=Business::where('account_details', 'LIKE', '%'. $acctNo. '%')->first();

        if($fb){
            $acctNo=$this->genNumber();
        }

        return $acctNo."|".$bankName;
    }

    public function genNumber(){
        $uq = rand();
        $sf = str_shuffle($uq . hexdec(uniqid()));
        return substr(env('WEMA_PREFIX') . $sf, 0, 10);
    }

}
