<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiConsumerController extends Controller
{
    public function apiGetWithoutKey()
    {
        $client = new Client();
        $url = "https://api-hrptdata-5ykbslq47a-ew.a.run.app/api/ping";

        $params = [
            //If you have any Params Pass here
        ];

        $headers = [
            'Accept'      => 'application/json',
            'Content-Type'      => 'application/json',
            //'api-key' => ''
        ];


        //
        $response = $client->request('GET', $url, [
            // 'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return compact('responseBody');
    }

    public function apiPostWithoutKey()
    {
        $client = new Client();
        $url = "https://api-hrptdata-5ykbslq47a-ew.a.run.app/api/login";

        $params = [
            //If you have any Params Pass here
        ];

        // All data-raw that should be sent in the body of the request
        $body = '{
            "email": "example@example",
            "password": "example1234"
        }';

        $headers = [
            'Accept'      => 'application/json',
            'Content-Type'      => 'application/json',
            //'api-key' => ''
        ];


        //
        $response = $client->request('POST', $url, [
            // 'json' => $params,
            'headers'   => $headers,
            'body'      => $body,
            'verify'    => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return compact('responseBody');
    }

    public function apiGetWithoutKeyWithBearer()
    {
        $client = new Client();
        $url = "https://api-hrptdata-5ykbslq47a-ew.a.run.app/api/me";

        $params = [
            //If you have any Params Pass here
        ];


        $headers = [
            'Accept'            => 'application/json',
            'Content-Type'      => 'application/json',
            'Authorization'     => 'Bearer TOKEN-HERE'
            //'api-key' => ''
        ];


        //
        $response = $client->request('GET', $url, [
            // 'json' => $params,
            'headers'   => $headers,
            'verify'    => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return compact('responseBody');
    }

    public function apiPostWithoutKeyWithBearer()
    {
        $client = new Client();
        $url = "https://api-hrptdata-5ykbslq47a-ew.a.run.app/api/absences/dates";

        $params = [
            //If you have any Params Pass here
        ];


        $headers = [
            'Accept'            => 'application/json',
            'Content-Type'      => 'application/json',
            'Authorization'     => 'Bearer TOKEN-HERE'
            //'api-key' => ''
        ];


        // All data-raw that should be sent in the body of the request
        $body = '{
            "start": "2019-01-01",
            "end": "2021-12-31",
            "site_code": "278",
            "absence_code": "999"
        }';

        //
        $response = $client->request('POST', $url, [
            // 'json' => $params,
            'headers'   => $headers,
            'body'      => $body,
            'verify'    => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return compact('responseBody');
    }
}
