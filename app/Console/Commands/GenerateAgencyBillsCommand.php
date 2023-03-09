<?php

namespace App\Console\Commands;

use App\Models\AirtimeProviders;
use App\Models\AirtimeProvidersAgent;
use App\Models\Cabletvbundle;
use App\Models\DataProvider;
use App\Models\ElectricityProviders;
use App\Models\ElectricityProvidersAgent;
use App\Models\InternetData;
use App\Models\InternetDataAgent;
use App\Models\InternetTvAgent;
use App\Models\TvProviders;
use Illuminate\Console\Command;

class GenerateAgencyBillsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'samji:generateAgencyBills {business=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $business=$this->argument('business');

        $this->airtime($business);
        $this->data($business);
        $this->tv($business);
        $this->electricity($business);


        return 0;
    }

    public function airtime($business){
        $airtimes=AirtimeProviders::get();

        foreach ($airtimes as $airtime){
            $airCheck=AirtimeProvidersAgent::where(['bills_id' => $airtime->id, 'business_id' => $business])->exists();

            if(!$airCheck){
                AirtimeProvidersAgent::create([
                    "bills_id" => $airtime->id,
                    "business_id" => $business,
                    "c_cent" => $airtime->c_cent,
                    "api_cent" => $airtime->api_cent,
                    "status" => $airtime->status
                ]);
                echo $airtime->provider . " created successfully";
            }
        }
    }

    public function data($business){
        $airtimes=InternetData::get();

        foreach ($airtimes as $airtime){
            $airCheck=InternetDataAgent::where(['bills_id' => $airtime->id, 'business_id' => $business])->exists();

            if(!$airCheck){
                InternetDataAgent::create([
                    "bills_id" => $airtime->id,
                    "business_id" => $business,
                    "price" => $airtime->price,
                    "c_cent" => $airtime->c_cent,
                    "api_cent" => $airtime->api_cent,
                    "status" => $airtime->status
                ]);
                echo $airtime->provider . " created successfully";
            }
        }
    }

    public function tv($business){
        $airtimes=Cabletvbundle::get();

        foreach ($airtimes as $airtime){
            $airCheck=InternetTvAgent::where(['bills_id' => $airtime->id, 'business_id' => $business])->exists();

            if(!$airCheck){
                InternetTvAgent::create([
                    "bills_id" => $airtime->id,
                    "business_id" => $business,
                    "price" => $airtime->price,
                    "c_cent" => $airtime->c_cent,
                    "api_cent" => $airtime->api_cent ?? '1',
                    "status" => $airtime->status
                ]);
                echo $airtime->provider . " created successfully";
            }
        }
    }

    public function electricity($business){
        $airtimes=ElectricityProviders::get();

        foreach ($airtimes as $airtime){
            $airCheck=ElectricityProvidersAgent::where(['bills_id' => $airtime->id, 'business_id' => $business])->exists();

            if(!$airCheck){
                ElectricityProvidersAgent::create([
                    "bills_id" => $airtime->id,
                    "business_id" => $business,
                    "c_cent" => $airtime->c_cent,
                    "api_cent" => $airtime->api_cent ?? '1',
                    "status" => $airtime->status
                ]);
                echo $airtime->provider . " created successfully";
            }
        }
    }
}
