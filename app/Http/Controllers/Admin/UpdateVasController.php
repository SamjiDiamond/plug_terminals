<?php


namespace App\Http\Controllers\Admin;


use App\Models\AirtimeProviders;
use App\Models\AirtimeProvidersAgent;
use App\Models\Cabletvbundle;
use App\Models\ElectricityProviders;
use App\Models\ElectricityProvidersAgent;
use App\Models\InternetData;
use App\Models\InternetDataAgent;
use App\Models\InternetTvAgent;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateVasController extends Controller
{
    public function airtimeswitch($request)
    {
        $airtime = AirtimeProviders::where('id', $request)->first();
        if ($airtime->status == 1) {
            $on = 0;
            $mg = $airtime->provider . " Switch Off";
        } elseif ($airtime->status == 0) {
            $on = 1;
            $mg = $airtime->provider . " Switch On";
        }

        $airtime->status = $on;
        $airtime->save();

        AirtimeProvidersAgent::where("bills_id", $airtime->bills_id)->update(['status' => $on]);

        Alert::toast($mg, 'success');
        return back();
    }

    public function dataswitch($request)
    {
        $data = InternetData::where('id', $request)->first();
        if ($data->status == 1) {
            $on = 0;
            $mg = $data->name . " Switch Off";
        } elseif ($data->status == 0) {
            $on = 1;
            $mg = $data->name . " Switch On";
        }

        $data->status = $on;
        $data->save();

        InternetDataAgent::where("bills_id", $data->bills_id)->update(['status' => $on]);

        Alert::toast($mg, 'success');
        return back();
    }

    public function switchtv($request)
    {
        $tv = Cabletvbundle::where('id', $request)->first();
        if ($tv->status == 1) {
            $on = 0;
            $mg = $tv->name . " Switch Off";
        } elseif ($tv->status == 0) {
            $on = 1;
            $mg = $tv->name . " Switch On";

        }

        $tv->status = $on;
        $tv->save();

        InternetTvAgent::where("bills_id", $tv->bills_id)->update(['status' => $on]);
        Alert::toast($mg, 'success');
        return back();
    }

    public function switchelectric($request)
    {
        $electric = ElectricityProviders::where('id', $request)->first();
        if ($electric->status == 1) {
            $on = 0;
            $mg = $electric->provider . " Switch Off";
        } elseif ($electric->status == 0) {
            $on = 1;
            $mg = $electric->provider . " Switch On";

        }

        $electric->status = $on;
        $electric->save();

        ElectricityProvidersAgent::where("bills_id", $electric->bills_id)->update(['status' => $on]);
        Alert::toast($mg, 'success');
        return back();
    }

    public function editairtime($request)
    {
        $airtime = AirtimeProviders::where('id', $request)->first();

        return view('verdant.admin.editairtime', compact('airtime'));
    }

    public function edittv($request)
    {
        $tv = Cabletvbundle::where('id', $request)->first();

        return view('verdant.admin.editcabletv', compact('tv'));

    }

    public function editelect($request)
    {
        $electric = ElectricityProviders::where('id', $request)->first();

        return view('verdant.admin.editelectric', compact('electric'));
    }

    public function editdata($request)
    {
        $data = InternetData::where('id', $request)->first();

        return view('verdant.admin.editdata', compact('data'));
    }

    public function updateairtime(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'min' => 'required',
            'max' => 'required',
            'ccent' => 'required'
        ]);

        $airtime = AirtimeProviders::where('id', $request->id)->first();
        $airtime->minAmount = $request->min;
        $airtime->maxAmount = $request->max;
        $airtime->c_cent = $request->ccent;
        $airtime->save();
        $mg = $airtime->provider . " Updated Successfully";
        Alert::success('Success', $mg);

        return redirect('admin/vas/airtime');
    }

    public function updatedata(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'price' => 'required',
            'ccent' => 'required'
        ]);
        $data = InternetData::where('id', $request->id)->first();

        $data->price = $request->price;
        $data->c_cent = $request->ccent;
        $data->save();
        $mg = $data->name . " Updated Successfully";
        Alert::success('Success', $mg);
        return redirect('admin/vas/data');

    }

    public function updatecabletv(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'price' => 'required',
            'ccent' => 'required'
        ]);
        $tv = Cabletvbundle::where('id', $request->id)->first();

        $tv->price = $request->price;
        $tv->c_cent = $request->ccent;
        $tv->save();
        $mg = $tv->name . " Updated Successfully";
        Alert::success('Success', $mg);
        return redirect('admin/vas/cabletv');

    }

    public function updateelce(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'min' => 'required',
            'ccent' => 'required'
        ]);
        $elect = ElectricityProviders::where('id', $request->id)->first();

        $elect->minAmount = $request->min;
        $elect->c_cent = $request->ccent;
        $elect->save();
        $mg = $elect->provider . " Updated Successfully";
        Alert::success('Success', $mg);
        return redirect('admin/vas/electricity');
    }


}
