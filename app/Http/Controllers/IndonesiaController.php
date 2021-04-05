<?php

namespace App\Http\Controllers;

use App\Country;
use App\PublicResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndonesiaController extends Controller
{
    public function index($date = null){
        $date = (is_null($date)) ? Carbon::today()->format('Y-m-d') : $date;
        $data = $this->getCounterData($date);

        $gamma = ($data->details->sum('confirmed') > 0) ? 0.7470 * $data->details->sum('deaths') / $data->details->sum('confirmed') / 100 : 0;
        $betha = PublicResponse::where([
            ['news_date', '<=', $date],
            ['country', 'Indonesia']
        ])->avg('response_value');
        $betha = (is_null($betha)) ? 0.4 : $betha; // Wuhan default

        return response()->view('pages.indonesia.index', compact('data', 'gamma', 'betha'));
    }

    public function dateFilter(Request $request) {
        $data = $request->validate([
            'date' => 'required|date'
        ]);

        return $this->index($data['date']);
    }

    private function getCounterData($date) {
        return Country::where('slug', 'indonesia')
            ->with(['details' => function($query) use ($date){
                return $query->where('date', $date.'T00:00:00Z');
            }])->first();
    }
}
