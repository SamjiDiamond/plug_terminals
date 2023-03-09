<?php


namespace App\Http\Controllers\Client;


use App\Models\AirtimeProvidersAgent;
use App\Models\ElectricityProvidersAgent;
use App\Models\InternetData;
use App\Models\InternetDataAgent;
use App\Models\InternetTvAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BillsproductController
{

public function airtime()
{
    $all=AirtimeProvidersAgent::where('business_id', Auth::user()->business_id)->with('parentData')->simplePaginate(20)->fragment('lists');
    return view('verdant.client.airtime', compact('all'));
}

public function electricity()
{
    $all=ElectricityProvidersAgent::where('business_id', Auth::user()->business_id)->with('parentData')->simplePaginate(20)->fragment('lists');
    return view('verdant.client.electricity', compact('all'));
}

public function index()
{
    $all=InternetDataAgent::where('business_id', Auth::user()->business_id)->with('parentData')->simplePaginate(20)->fragment('lists');

    return view('verdant.client.internetdata', compact('all'));
}

public function index1()
{

    $all=InternettvAgent::where('business_id', Auth::user()->business_id)->with('parentData')->simplePaginate(20)->fragment('lists');

    return view('verdant.client.tv', compact('all'));
}

    public function airtimeModify($request)
    {
        $net=AirtimeProvidersAgent::where('id', $request)->first();
        if ($net->status=='1'){
            $no=0;
            $mg='Airtime Successful Switch Off';
        }elseif ($net->status=='0'){
            $no=1;
            $mg='Airtime Successful Switch On';
        }

        $net->status=$no;
        $net->save();
        Alert::toast($mg, 'success' );
        return back();
    }

    public function electricityModify($request)
    {
        $net=ElectricityProvidersAgent::where('id', $request)->first();
        if ($net->status=='1'){
            $no=0;
            $mg='Electricity Successful Switch Off';
        }elseif ($net->status=='0'){
            $no=1;
            $mg='Airtime Successful Switch On';
        }

        $net->status=$no;
        $net->save();
        Alert::toast($mg, 'success' );
        return back();
    }

    public function dataModify($request)
{

    $net=InternetDataAgent::where('id', $request)->first();
    if ($net->status=='1'){
        $no=0;
        $mg='Data Successful Switch Off';
    }elseif ($net->status=='0'){
        $no=1;
        $mg='Data Successful Switch On';

    }

    $net->status=$no;
    $net->save();
Alert::toast($mg, 'success' );
return back();

}

    public function tvModify($request)
{


    $net=InternettvAgent::where('id', $request)->first();
    if ($net->status=='1'){
        $no=0;
        $mg='Tv Successful Switch Off';
    }elseif ($net->status=='0'){
        $no=1;
        $mg='Tv Successful Switch On';

    }

    $net->status=$no;
    $net->save();
Alert::toast($mg, 'success' );
return back();

}

    public function editAirtime($request)
    {
        $net=AirtimeProvidersAgent::where('id', $request)->with('parentData')->first();

        return view('verdant.client.editAirtime', compact('net'));
    }

    public function editElectricity($request)
    {
        $net=ElectricityProvidersAgent::where('id', $request)->with('parentData')->first();

        return view('verdant.client.editElectricity', compact('net'));
    }

    public function editData($request)
    {
        $net=InternetDataAgent::where('id', $request)->with('parentData')->first();

        return view('verdant.client.editData', compact('net'));
    }

public function editTV($request)
{
    $net=InternettvAgent::where('id', $request)->with('parentData')->first();

    return view('verdant.client.editTV', compact('net'));
}
public function done(Request $request)
{
    $request->validate([
        'id'   => 'required',
        'sprice'   => 'required',
        'ccent'   => 'required',
    ]);
    $net=InternetDataAgent::where('id', $request->id)->first();
    $net->price=$request->sprice;
    $net->c_cent=$request->ccent;
    $net->save();
    Alert::success('Success','Product Update Successfully');
    return redirect('internetdata');

}

public function airtimeUpdate(Request $request)
{
    $request->validate([
        'id'   => 'required',
        'ccent'   => 'required',
    ]);
    $net=AirtimeProvidersAgent::where('id', $request->id)->first();
    $net->c_cent=$request->ccent;
    $net->save();
    Alert::success('Success','Product Updated Successfully');
    return redirect()->route('airtime');

}

public function electricityUpdate(Request $request)
{
    $request->validate([
        'id'   => 'required',
        'ccent'   => 'required',
    ]);
    $net=ElectricityProvidersAgent::where('id', $request->id)->first();
    $net->c_cent=$request->ccent;
    $net->save();
    Alert::success('Success','Product Updated Successfully');
    return redirect()->route('electricity');
}

public  function  done1(Request $request)
{
    $request->validate([
        'id'   => 'required',
        'sprice'   => 'required',
        'ccent'   => 'required',
    ]);
    $net=InternettvAgent::where('id', $request->id)->first();
    $net->price=$request->sprice;
    $net->c_cent=$request->ccent;
    $net->save();
    Alert::success('Success','Product Update Successfully');
    return redirect('tv');

}
}
