<?php

namespace App\Http\Controllers;

use App\PublicResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function getBetaStaticJson($country = 'Indonesia')
    {
        $publicResponseAvg = PublicResponse::where('country', $country)->avg('response_value');

        if ($publicResponseAvg == null) {
            return response()->json([
                'success' => false,
                'message' => 'No country data found'
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => 'Average of public response successfully get!',
            'data' => floatval($publicResponseAvg),
        ], 200);
    }
    public function getBetaStatic($country = 'Indonesia')
    {
        $publicResponseAvg = PublicResponse::where('country', $country)->avg('response_value');

        if ($publicResponseAvg == null)
            return null;
        else
            return floatval($publicResponseAvg);
    }

    public function getBetaDynamicJson($firstDate, $endDate, $country = 'Indonesia')
    {
        $firstResponse = PublicResponse::where('country', $country)
            ->orderBy('news_date')->first();

        if ($firstResponse == null) {
            return response()->json([
                'success' => false,
                'message' => 'No country data found'
            ], 200);
        }
        if ($firstDate < $firstResponse->news_date)
            $betha = 0.4; //default from Wuhan
        else {
            $betha = PublicResponse::where('country', $country)
                ->whereBetween('news_date', [$firstResponse->news_date, $firstDate])
                ->avg('response_value');
        }
        return response()->json([
            'success' => true,
            'message' => 'Average of public response successfully get!',
            'data' => $betha,
        ], 200);
    }
    public function getBetaDynamic($firstDate, $endDate, $country = 'Indonesia')
    {
        $firstResponse = PublicResponse::where('country', $country)
            ->orderBy('news_date')->first();

        if ($firstResponse == null) {
            return response()->json([
                'success' => false,
                'message' => 'No country data found'
            ], 200);
        }
        if ($firstDate < $firstResponse->news_date)
            $betha = 0.4; //default from Wuhan
        else {
            $betha = PublicResponse::where('country', $country)
                ->whereBetween('news_date', [$firstResponse->news_date, $firstDate])
                ->avg('response_value');
        }

        return $betha;
    }

    public function jsonLatestNews($count = 3)
    {
        $news = PublicResponse::orderBy('created_at', 'desc')->take($count)->get();

        return response()->json([
            'success' => true,
            'message' => 'Average of public response successfully get!',
            'data' => $news
        ], 200);
    }
    public function getLatestNews($count = 3)
    {
        $news = PublicResponse::orderBy('created_at', 'desc')->take($count)->get();

        return $news;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report = app('App\Http\Controllers\ReportsController');

        $data = (object) $report->fetchCountryIdentity();

        return view('pages.overview.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'news_date' => 'required|date',
            'country' => 'required|max:100',
            'news_url' => 'required|max:200|url',
            'news_text' => 'required|max:10000',
            'response_value' => 'required|numeric|between:-1,1',
            'entried_by' => 'required|max:100',
        ]);

        $reponseData = PublicResponse::create([
            'news_date' => $request->news_date,
            'country' => $request->country,
            'news_url' => $request->news_url,
            'news_text' => $request->news_text,
            'response_value' => $request->response_value,
            'entried_by' => $request->entried_by,
        ]);

        if ($reponseData) {
            return redirect()->route('public-response.create')
                ->with('success', 'Data respon masyarakat berhasil ditambahkan');
        }
    }

    public function storeAsJson(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_date' => 'required|date',
            'country' => 'required|max:100',
            'news_url' => 'required|max:200|url',
            'news_text' => 'required|max:10000',
            'response_value' => 'required|numeric|between:-1,1',
            'entried_by' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $reponseData = PublicResponse::create([
            'news_date' => $request->news_date,
            'country' => $request->country,
            'news_url' => $request->news_url,
            'news_text' => $request->news_text,
            'response_value' => $request->response_value,
            'entried_by' => $request->entried_by,
        ]);

        if ($reponseData)
            return response()->json([
                'success' => true,
                'message' => 'Add data successfully!',
                'data' => $reponseData,
            ], 200);
        else
            return response()->json([
                'success' => false,
                'message' => 'Add data failed!',
            ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PublicResponse  $publicResponse
     * @return \Illuminate\Http\Response
     */
    public function show(PublicResponse $publicResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PublicResponse  $publicResponse
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicResponse $publicResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PublicResponse  $publicResponse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PublicResponse $publicResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PublicResponse  $publicResponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicResponse $publicResponse)
    {
        //
    }
}
