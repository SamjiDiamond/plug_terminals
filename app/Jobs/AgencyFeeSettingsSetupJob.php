<?php

namespace App\Jobs;

use App\Models\Business;
use App\Models\FeesSetting;
use App\Models\FeesSettingsAgent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AgencyFeeSettingsSetupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $biz;
    public function __construct($biz)
    {
        $this->biz=$biz;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $biz = Business::find($this->biz);
        echo $biz;

        if ($biz) {

            $fees=FeesSetting::get();

            foreach ($fees as $fee){

                $input['business_id'] = $biz->id;
                $input['fees_settings_id'] = $fee->id;
                $input['fee'] = $fee->fee;
                $input['capped_fee'] = $fee->capped_fee;
                $input['fee_type'] = $fee->fee_type;

                $cfee=FeesSettingsAgent::where([["business_id", $input['business_id']], ["fees_settings_id", $input['fees_settings_id']]])->exists();

                if(!$cfee){
                    echo "Inserting $fee->name";
                    FeesSettingsAgent::create($input);
                }
            }
        }
    }
}
