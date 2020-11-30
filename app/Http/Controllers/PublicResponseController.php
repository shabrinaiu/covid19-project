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
        //
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
            'news_url' => 'required|max:200',
            'news_text' => 'required|max:255',
            'response_value' => 'required|numeric|between:-1,1',
            'entried_by' => 'required|max:100',
        ]);
        /*
        $validator = Validator::make($request->all(), [
            'news_date' => 'required|date',
            'country' => 'required|max:100',
            'news_url' => 'required|max:200',
            'news_text' => 'required',
            'response_value' => 'required|numeric|between:-1,1',
            'entried_by' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        */

        $reponseData = PublicResponse::create([
            'news_date' => $request->news_date,
            'country' => $request->news_date,
            'news_url' => $request->news_url,
            'news_text' => $request->news_text,
            'response_value' => $request->response_value,
            'entried_by' => $request->entried_by,
        ]);

        if ($reponseData) {
            return redirect()->route('public-response.create')
                ->with('success', 'Data created successfully.');
        }
        /*
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
            ], 200);
            */
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
