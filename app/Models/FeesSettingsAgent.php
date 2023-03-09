<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesSettingsAgent extends Model
{
    use HasFactory;

    protected $table="fees_settings_agent";

    protected $guarded =[];

    function parentData(){
        return $this->belongsTo(FeesSetting::class, "fees_settings_id");
    }

    function business(){
        return $this->belongsTo(Business::class, "business_id");
    }
}
