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
        $data = $this->fetchName();
        
        return view('pages.reports.countries', compact('data'));
    }

    public function fetchName()
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
        return $data;
    }

    public function show($selected)
    {
        $country = explode('-', $selected);

        $currentData = $this->fetchCurrent($country[1]);

        $historyData = $this->fetchHistory($country[0]);

        $data = $this->fetchname();   

        return view('pages.reports.countries', compact('currentData', 'historyData', 'data'));
    }

    public function fetchCurrent($name)
    {
        //fetching urrent data country
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://coronavirus-19-api.herokuapp.com/countries",
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

        foreach($data as $dataCountry){
            if($dataCountry['country'] == $name){
                $currentData = $dataCountry;
                break;
            }
        }
        if(isset($currentData)){
            return $currentData;
        } else{
            return 'failed to load';
        }
            
    }

    public function fetchHistory($slug)
    {
        //fetching All data in the contry
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.covid19api.com/country/" . $slug,
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
        $historyData = json_decode($response, TRUE);

        return $historyData;
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
