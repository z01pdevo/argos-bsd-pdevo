<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Site;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function getAll()
    {
        return Site::all();
    }

    public static function getAllActive()
    {
        return Site::where('active',TRUE)->with(['store_location_type','store_estate_type'])->get();
    }

    public function getAllInactive()
    {
        return Site::where('active', FALSE)->with(['store_location_type','store_estate_type'])->get();
    }

    public static  function getById($id)
    {
        return Site::where('id', $id)->with(['store_location_type','store_estate_type'])->get()->first();
    }

    public function getByType($type)
    {
        return Site::where('type', '=', $type)->with(['store_location_type','store_estate_type'])->get();
    }

    public function getActionPlansById($id)
    {
        return Site::where('id',$id)->first()->actionplans;
    }

    public function getReportsById($id)
    {
        return Site::where('id', $id)->first()->reports;
    }

    public function getUsersById($id)
    {
        return Site::where('id', $id)->first()->users;
    }

    public function create($new_site_info)
    {
        $site = Site::create(
            [
                'site'                  => $new_site_info->site,
                'type'                  => $new_site_info->type,
                'name'                  => $new_site_info->name,
                'email'                 => $new_site_info->email,
                'manager_email'         => $new_site_info->manager_email,
                'exploitation_email'    => $new_site_info->exploitation_email,
                'active'                => $new_site_info->active,
            ]
        );
        return $site;
    }

    public function update($new_site_info)
    {
        $site = Site::where('id', $new_site_info->id)
            ->update([
                'site'                  => $new_site_info->site,
                'type'                  => $new_site_info->type,
                'name'                  => $new_site_info->name,
                'email'                 => $new_site_info->email,
                'manager_email'         => $new_site_info->manager_email,
                'exploitation_email'    => $new_site_info->exploitation_email,
                'active'                => $new_site_info->active,
                'updated_at'            => now(),
            ]);

        return $site;
    }

    public function deactivate($id)
    {
        Site::where('id', $id)->update([
                                    'active' => FALSE,
                                    'updated_at' => now(),
                                ]);

        $site = Site::find($id);


        return $site;
    }

    public function activate($id)
    {
        Site::where('id', $id)->update([
                                    'active'=>TRUE,
                                    'updated_at' => now(),
                                ]);

        $site = Site::find($id);

        return $site;
    }

    private function ApiPerfeco($site_code,$start_date,$yesterday_date, $bearer)
    {

        $client = new Client();
        $url = config('env.PERFECO_API_BASE_URL') . '/v2/period/economic_performances?from='.$start_date.'&to='.$yesterday_date.'&agg_level=stores&stores='.$site_code.'&lastYear=true';


        $headers = [
            'Authorization'     => 'Bearer ' . $bearer,
            'X-Api-Key'         => config('env.PERFECO_API_KEY'),
            'Content-Type'      => 'application/json'
        ];

        $response = $client->request('GET', $url, [
            'headers'   => $headers,
            'verify'    => false,
        ]);

        $response = json_decode($response->getBody());



        $to_current_year =
            $response->date_list['0']->agg_level_list['0']->turnover->amount_other +
            $response->date_list['0']->agg_level_list['0']->turnover->amount_physical_store +
            $response->date_list['0']->agg_level_list['0']->turnover->amount_digital_store +
            $response->date_list['0']->agg_level_list['0']->turnover->amount_click_and_collect +
            $response->date_list['0']->agg_level_list['0']->turnover->amount_loyalty_card +
            $response->date_list['0']->agg_level_list['0']->turnover->amount_ecommerce +
            $response->date_list['0']->agg_level_list['0']->turnover->amount_zip_code +
            $response->date_list['0']->agg_level_list['0']->turnover->amount_decapro;

        $to_last_year =
            $response->date_list['0']->agg_level_list['0']->turnover->last_year->amount_other +
            $response->date_list['0']->agg_level_list['0']->turnover->last_year->amount_physical_store +
            $response->date_list['0']->agg_level_list['0']->turnover->last_year->amount_digital_store +
            $response->date_list['0']->agg_level_list['0']->turnover->last_year->amount_click_and_collect +
            $response->date_list['0']->agg_level_list['0']->turnover->last_year->amount_loyalty_card +
            $response->date_list['0']->agg_level_list['0']->turnover->last_year->amount_ecommerce +
            $response->date_list['0']->agg_level_list['0']->turnover->last_year->amount_zip_code +
            $response->date_list['0']->agg_level_list['0']->turnover->last_year->amount_decapro;


        return [
            'to_dda' => number_format($to_current_year/1000,0,'.',''),
            'to_progression' => number_format((($to_current_year * 100) / $to_last_year) - 100, 2,'.','')
            ];

    }

    public function getDDAPerformances($id)
    {
        $site = Site::where('id',$id)->first();



        $site_code = $site->site;
        $start_date = Carbon::create( Carbon::now()->year , 1, 1, 0);
        $start_date = $start_date->format('Ymd');

        $yesterday_date =  Carbon::now()->subDay();
        $yesterday_date = $yesterday_date->format('Ymd');


        $bearer = auth()->user()->token;

        if($site_code == 'PTHQ1'){
            return [
                'to_dda' => 0,
                'to_progression' => 0
            ];
        }else{
            return $this->ApiPerfeco($site_code, $start_date, $yesterday_date, $bearer);
        }

    }


}
