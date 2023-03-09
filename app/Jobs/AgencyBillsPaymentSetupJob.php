<?php

namespace App\Jobs;

use App\Models\AirtimeProviders;
use App\Models\AirtimeProvidersAgent;
use App\Models\Business;
use App\Models\Cabletvbundle;
use App\Models\ElectricityProviders;
use App\Models\ElectricityProvidersAgent;
use App\Models\InternetData;
use App\Models\InternetDataAgent;
use App\Models\InternetTvAgent;
use App\Models\TvProviders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AgencyBillsPaymentSetupJob implements ShouldQueue
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
        $biz=Business::find($this->biz);
        echo $biz;

        if($biz){
            $input['business_id']=$biz->id;

            $datas=AirtimeProviders::get();
            echo $datas;
            foreach ($datas as $data){
                $acheck=AirtimeProvidersAgent::where([["business_id", $input['business_id']], ["bills_id", $data->id]])->first();

                echo "\n\n";
                echo "Airtime agent exist : $acheck";
                echo "\n\n";
                if(!$acheck) {
                    $input['bills_id'] = $data->id;
                    $input['c_cent'] = $data->c_cent ?? 0;
                    $input['api_cent'] = $data->api_cent ?? 0;
                    $input['status'] = 1;
                    AirtimeProvidersAgent::create($input);

                    echo "\n\n";
                    echo "Created Airtime Agent";
                    echo "\n\n";
                }
            }

            $datas=InternetData::get();
            foreach ($datas as $data){
                $dcheck=AirtimeProvidersAgent::where([["business_id", $input['business_id']], ["bills_id", $data->id]])->first();

                if(!$dcheck) {
                    $input['bills_id'] = $data->id;
                    $input['price'] = $data->price;
                    $input['c_cent'] = $data->c_cent ?? 0;
                    $input['api_cent'] = $data->api_cent ?? 0;
                    $input['status'] = 1;
                    InternetDataAgent::create($input);
                }
            }

            $datas=Cabletvbundle::get();
            foreach ($datas as $data){
                $ccheck=AirtimeProvidersAgent::where([["business_id", $input['business_id']], ["bills_id", $data->id]])->first();

                if(!$ccheck) {
                    $input['bills_id'] = $data->id;
                    $input['price'] = $data->price;
                    $input['c_cent'] = $data->c_cent ?? 0;
                    $input['api_cent'] = $data->api_cent ?? 0;
                    $input['status'] = 1;
                    InternetTvAgent::create($input);
                }
            }

            $datas=ElectricityProviders::get();
            foreach ($datas as $data){
                $acheck=AirtimeProvidersAgent::where([["business_id", $input['business_id']], ["bills_id", $data->id]])->first();

                if(!$acheck) {
                    $inpute['business_id'] = $biz->id;
                    $inpute['bills_id'] = $data->id;
                    $inpute['c_cent'] = $data->c_cent ?? 0;
                    $inpute['api_cent'] = $data->api_cent ?? 0;
                    $inpute['status'] = 1;
                    ElectricityProvidersAgent::create($inpute);
                }
            }
        }
    }
}
