<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table='business';
    protected $guarded=[];

    function User(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function Customers(){
        return $this->hasMany(Customer::class, 'business_id');
    }

    function Terminals(){
        return $this->hasMany(Terminal::class, 'business_id');
    }

    function Transactions(){
        return $this->hasMany(Transaction::class, 'business_id');
    }

    function Income(){
        return $this->hasMany(Transaction::class, 'business_id')->where('type', 'credit');
    }

    function Disbursement(){
        return $this->hasMany(Transaction::class, 'business_id')->where('type', 'debit');
    }
}
