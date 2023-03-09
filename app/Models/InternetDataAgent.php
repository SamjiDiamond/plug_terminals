<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternetDataAgent extends Model
{
    protected $table = 'bills_internet_data_plans_agent';
    protected $guarded=[];

    function parentData(){
        return $this->belongsTo(InternetData::class, 'bills_id');
    }
}
