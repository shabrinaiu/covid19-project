<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.reports.index');
    }

    public function countries()
    {
        //Country name data
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.covid19api.com/summary",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $data = json_decode($response, TRUE);
        $data = $data['Countries'];
        //dd($data);
        return view('pages.reports.countries', compact('data'));
    }

    public function show($slug)
    {
        dd($slug);
        return view('pages.reports.countries', compact('slug'));
    }

    public function global()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.covid19api.com/summary",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
            $data = null;
        } else {
            $data = json_decode($response, TRUE);
            $data = $data['Countries'];
        }

        return view('pages.reports.global', compact('data'));
    }
}
