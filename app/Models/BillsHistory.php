<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillsHistory extends Model
{
    protected $table = 'bills_history';
    protected $guarded=['id'];

    public function biz(){
        return $this->belongsTo('App\Models\Business','business_id','id');
    }

    function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function business(){
        return $this->belongsTo('App\Models\Business','business_id','id');
    }
}
