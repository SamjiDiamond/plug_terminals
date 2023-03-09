<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Kyc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KYCController extends Controller
{
    function addNIN(Request $request){
        $input = $request->myPayload;

        if(!isset($input)){
            return response()->json(['success' => false, 'message' => 'Encryption issue']);
        }

        $validator = Validator::make($input, [
            'number' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $user=User::find(Auth::id());
        $user->id_document="nin";
        $user->id_number=$input['number'];
        $user->save();

        return response()->json(['success' => true, 'message' => 'Updated successfully']);

    }

    function addBVN(Request $request){
        $input = $request->myPayload;

        if(!isset($input)){
            return response()->json(['success' => false, 'message' => 'Encryption issue']);
        }

        $validator = Validator::make($input, [
            'number' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $user=User::find(Auth::id());
        $user->bvn=$input['number'];
        $user->save();

        return response()->json(['success' => true, 'message' => 'Updated successfully']);

    }

    function addDocument(Request $request){
        $input = $request->myPayload;

        if(!isset($input)){
            return response()->json(['success' => false, 'message' => 'Encryption issue']);
        }

        $validator = Validator::make($input, [
            'document' => 'required',
            'document_type' => 'required',
            'business_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Incomplete request', 'error' => $validator->errors()]);
        }

        $decodedImage = base64_decode($input['document']);


        $folderPath = "kyc/";

//        $base64Image = explode(";base64,", $input['document']);
//        $explodeImage = explode("image/", $base64Image[0]);
//        $imageName = $explodeImage[1];
//        $image_base64 = base64_decode($base64Image[1]);
//        $file = $folderPath . uniqid() . '. '.$imageName;

//        try {
//            $s3Url = $folderPath . $imageName;
//            Storage::disk('s3.bucket')->put($s3Url, $base64String, 'public');
//        } catch (Exception $e) {
//            Log::error($e);
//        }

        $file = $folderPath . uniqid() . '.jpg';

        $idupload = Storage::put($file, $decodedImage);
//        Storage::put('kyc', $decodedImage);

        Kyc::create([
            'business_id' => $input['business_id'],
            'info' => $input['document_type'],
            'file' => Storage::url($idupload),
        ]);

        return response()->json(['success' => true, 'message' => 'Uploaded successfully']);
    }

    function listKycs($business_id){
        $biz=Business::where(["id"=>$business_id, "user_id" => Auth::id()])->first();

        if(!$biz){
            return response()->json(['success' => false, 'message' => 'Invalid']);
        }

        $datas['nin']=Auth::user()->id_number;
        $datas['bvn']=Auth::user()->bvn;
        $datas['expected_doc']=$biz->biztype->documents;
        $datas['document']=Kyc::where('business_id', $business_id)->get();

        return response()->json(['success' => true, 'message' => 'Fetched successfully', 'data'=>[$datas]]);
    }
}
