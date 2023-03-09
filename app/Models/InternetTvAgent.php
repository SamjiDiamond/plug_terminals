<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternetTvAgent extends Model
{
    protected $table = 'bills_internet_tv_plans_agent';
    protected $guarded=[];

    function parentData(){
        return $this->belongsTo(Cabletvbundle::class, 'bills_id');
    }
}
