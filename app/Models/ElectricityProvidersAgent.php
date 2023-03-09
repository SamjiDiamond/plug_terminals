<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectricityProvidersAgent extends Model
{
    protected $table = 'bills_electricity_providers_agent';
    protected $guarded=[];


    function parentData(){
        return $this->belongsTo(ElectricityProviders::class, 'bills_id');
    }
}
