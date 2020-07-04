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
        $data = $this->fetchCountry();
        
        return view('pages.reports.countries', compact('data'));
    }

    public function fetchCountry()
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

        if ($err) {
            echo "cURL Error #:" . $err;
            $data = null;
        } else {
            $data = json_decode($response, TRUE);
            $data = $data['Countries'];
        }

        return $data;
    }

    public function show($selectedSlug)
    {
        // $country = explode('#', $selected);

        $currentData = $this->fetchCurrent($selectedSlug);

        $historyData = $this->fetchHistory($selectedSlug);

        $data = $this->fetchCountry();

        return view('pages.reports.countries', compact('currentData', 'historyData', 'data'));
    }

    public function fetchCurrent($slug)
    {        
        //fetching urrent data country
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
        foreach($data as $dataCountry){            
            if($dataCountry['Slug'] == $slug){
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
        $data = $this->fetchCountry();

        return view('pages.reports.global', compact('data'));
    }
}
