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
        $historyData = $this->getFromFirstCase($historyData);
        // $historyData = $this->getLastData($historyData, 30);

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

    public function getFromFirstCase($historyData)
    {
        $index = 0;
        foreach($historyData as $i => $rowHistoryData){
            if($rowHistoryData['Confirmed'] > 0){
                $index = $i;
                break;
            }
        }
        $collection = collect($historyData);
        $slice = $collection->slice($index);
        $i = 0;
        foreach($slice->all() as $data){
            $historyDataArr[$i] = $data;
            $i++;
        }

        for($idx = 0; $idx<count($historyDataArr); $idx++){
            $dateParts = explode("-",$historyDataArr[$idx]['Date']);
            $historyDataArr[$idx]['Date'] = ($dateParts[2] . '-' . $dateParts[0] . '-' . $dateParts[1]);
        }

        return $historyDataArr;
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
        $mainHistoryData = $this->getFromFirstCase($mainHistoryData);
        $getMainHistoryData = array_slice($mainHistoryData, 0, $request->count);
        for($i = 0; $i < count($getMainHistoryData); $i++){
            $getMainHistoryData[$i] = array_merge($getMainHistoryData[$i], ["Label" => ('day ' . ($i+1))]);
            $getMainHistoryData[$i] = array_merge($getMainHistoryData[$i], ["Index" => $i]);
        }
        
        $comparedHistoryData = $this->fetchHistory($request->comparedCountry);
        $comparedHistoryData = $this->getFromFirstCase($comparedHistoryData);
        $getComparedHistoryData = array_slice($comparedHistoryData, 0, $request->count);
        for($i = 0; $i < count($getComparedHistoryData); $i++){
            $getComparedHistoryData[$i] = array_merge($getComparedHistoryData[$i], ["Label" => ('day ' . ($i+1))]);
            $getComparedHistoryData[$i] = array_merge($getComparedHistoryData[$i], ["Index" => $i]);
        }
        
        // $mainHistoryData = $this->getDataAroundDate($mainHistoryData, $request->start, $request->end);
        // $mainHistoryData = array_values($mainHistoryData); //returning index arr to 0
        // foreach ($mainHistoryData as $i => $mainData) {
        //     $dates[$i] = $mainData['Date'];
        // }
        // $mainCountryName = $mainHistoryData[0]['Country'];

        // foreach ($request->countries as $i => $countries) {
        //     $comparedHistoryDataArr[$i] = $this->fetchHistory($countries);
        //     $comparedHistoryDataArr[$i] = $this->getDataAroundDate($comparedHistoryDataArr[$i], $request->start, $request->end);
        //     $comparedHistoryDataArr[$i] = array_values($comparedHistoryDataArr[$i]); //returning index arr to 0
        // }
        // $results = $this->countDataCountries($mainHistoryData, $comparedHistoryDataArr);

        $data = $this->fetchCountryIdentity();

        return view('pages.reports.comparison', compact(['data', 'getComparedHistoryData', 'getMainHistoryData']));
    }

    public function countDataCountries($mainHistoryData, $comparedHistoryDataArr)
    {
        foreach ($comparedHistoryDataArr as $idx => $comparedHistoryData) { //tiap negara. $idx dari 0
            $confirmedDiff[$idx]['country'] = $comparedHistoryData[0]['Country'];
            $recoveredDiff[$idx]['country'] = $comparedHistoryData[0]['Country'];
            $deathsDiff[$idx]['country'] = $comparedHistoryData[0]['Country'];

            $totalDiffConfirmed = 0;
            $totalDiffRecovered = 0;
            $totalDiffDeaths = 0;
            foreach($comparedHistoryData as $i => $rowComparedData){ //tiap data pada tiap tanggal
                $confirmedDiff[$idx][$i] = abs($rowComparedData['Confirmed'] - $mainHistoryData[$i]['Confirmed']);
                $totalDiffConfirmed += $confirmedDiff[$idx][$i];
                $recoveredDiff[$idx][$i] = abs($rowComparedData['Recovered'] - $mainHistoryData[$i]['Recovered']);
                $totalDiffRecovered += $recoveredDiff[$idx][$i];
                $deathsDiff[$idx][$i] = abs($rowComparedData['Deaths'] - $mainHistoryData[$i]['Deaths']);
                $totalDiffDeaths += $deathsDiff[$idx][$i];
                $countData = $i+1;
            }
            // hitung persentase dari total selisih dibagi total main data
            $confirmedDiff[$idx]['persentase'] = ($totalDiffConfirmed / $countData);
            $recoveredDiff[$idx]['persentase'] = ($totalDiffRecovered / $countData);
            $deathsDiff[$idx]['persentase'] = ($totalDiffDeaths / $countData);
        }
        $results['confirmed'] = $confirmedDiff;
        $results['recovered'] = $recoveredDiff;
        $results['deaths'] = $deathsDiff;

        return $results;
    }

    public function getLastData($dataHistory, $limit)
    {
        $collection = collect($dataHistory);

        $limit *= -1;
        $chunk = $collection->take($limit);
        $i = 0;
        foreach($chunk->all() as $data){
            $historyData[$i] = $data;
            $i++;
        }

        return $historyData;
    }
}
