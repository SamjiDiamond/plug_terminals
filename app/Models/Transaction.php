<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded=[];

    function user(){
        return $this->belongsTo(User::class);
    }

    function bills(){
        return $this->hasOne(BillsHistory::class, 'trx','reference');
    }

    function transfer(){
        return $this->hasOne(transfer::class, 'refid','reference');
    }
}
