<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirtimeProvidersAgent extends Model
{
    protected $table = 'bills_airtime_providers_agent';
    protected $guarded=[];

    function parentData(){
        return $this->belongsTo(AirtimeProviders::class, 'bills_id');
    }
}
