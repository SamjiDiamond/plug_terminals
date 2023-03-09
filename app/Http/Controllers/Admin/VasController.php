<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AirtimeProviders;
use App\Models\Cabletvbundle;
use App\Models\DataProvider;
use App\Models\ElectricityProviders;
use App\Models\InternetData;
use App\Models\TvProviders;
use Illuminate\Http\Request;

class VasController extends Controller
{
    function airtime(){

        $datas['i']=1;
        $datas['airtimes']=AirtimeProviders::latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.admin.vas_airtime', $datas);
    }

    function data(){
        $datas['i']=1;
        $datas['data']=InternetData::latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.admin.vas_data', $datas);
    }

    function cabletv(){
        $datas['i']=1;
        $datas['data']=Cabletvbundle::latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.admin.vas_cabletv', $datas);
    }

    function electricity(){
        $datas['i']=1;
        $datas['data']=ElectricityProviders::latest()->simplePaginate(20)->fragment('lists');

        return view('verdant.admin.vas_electricity', $datas);
    }
}
