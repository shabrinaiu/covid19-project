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
        $data = $this->fetchCountryIdentity();

        return view('pages.reports.countries', compact('data'));
    }

    public function fetchCountryIdentity()
    {
        //Country name data
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-corona.azurewebsites.net/country",
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
        }

        return $data;
    }

    public function fetchGlobal()
    {
        //Country name data
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-corona.azurewebsites.net/summary",
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
            $data = $data['countries'];
        }

        return $data;
    }

    public function show($selectedSlug)
    {
        $currentData = $this->fetchCurrent($selectedSlug);

        $historyData = $this->fetchHistory($selectedSlug);

        $data = $this->fetchCountryIdentity();

        return view('pages.reports.countries', compact('currentData', 'historyData', 'data'));
    }

    public function fetchCurrent($slug)
    {
        //fetching urrent data country
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-corona.azurewebsites.net/summary",
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
        if(count($data) <= 1){
            return 'failed to load';
        }

        $data = $data['countries'];
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
            CURLOPT_URL => "https://api-corona.azurewebsites.net/timeline/" . $slug,
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

    public function getDataAroundDate($historyData, $startDate, $endDate)
    {
        $startDate = explode("/",$startDate);
        $startDate = $startDate[0] . '-' . $startDate[1] . '-' . $startDate[2];

        $endDate = explode("/",$endDate);
        $endDate = $endDate[0] . '-' . $endDate[1] . '-' . $endDate[2];
        
        foreach($historyData as $i => $rowHistoryData){
            if($rowHistoryData['Date'] >= $startDate && $rowHistoryData['Date'] <= $endDate){
                $historyDataArr[$i] = $rowHistoryData;
            }
        }

        return $historyDataArr;
    }

    public function global()
    {
        $data = $this->fetchGlobal();

        return view('pages.reports.global', compact('data'));
    }

    public function compareCountryData()
    {
        $data = $this->fetchCountryIdentity();

        return view('pages.reports.comparison', compact('data'));
    }

    public function processComparedData(Request $request)
    {
        $mainHistoryData = $this->fetchHistory($request->mainCountry);
        $getMainHistoryData = array_slice($mainHistoryData, 0, $request->periode);
        
        $comparedHistoryData = $this->fetchHistory($request->comparedCountry);
        $getComparedHistoryData = array_slice($comparedHistoryData, 0, $request->periode);

        $data = $this->fetchCountryIdentity();

        return view('pages.reports.comparison', compact(['data', 'getComparedHistoryData', 'getMainHistoryData']));
    }

    public function countDataCountries($mainHistoryData, $comparedHistoryDataArr)
    {
        $result = array();
        $results['Confirmed'] = abs(
            array_sum(array_column($main, 'Confirmed')) - array_sum(array_column($compared, 'Confirmed'))
        ) / count($main);
        $results['Recovered'] = abs(
            array_sum(array_column($main, 'Recovered')) - array_sum(array_column($compared, 'Recovered'))
        ) / count($main);
        $results['Deaths'] = abs(
            array_sum(array_column($main, 'Deaths')) - array_sum(array_column($compared, 'Deaths'))
        ) / count($main);

        return $results;
    }
}
