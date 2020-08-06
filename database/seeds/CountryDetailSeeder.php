<?php

use App\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $queryCountries = Country::all();
        foreach ($queryCountries as $i => $country) {
            //fetching All data in the contry
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api-corona.azurewebsites.net/timeline/" . $country->slug,
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
            $fetchedArr = json_decode($response, TRUE);
        
            if (isset($fetchedArr)) {
                foreach ($fetchedArr as $i => $fetched) {
                    if($fetched['Confirmed'] > 0){
                        DB::table('country_details')->insert([
                            'country_slug' => $country->slug,
                            'province' => ( isset($fetched['Province']) ? $fetched['Province'] : null),
                            'date' => $fetched['Date'],
                            'confirmed' => $fetched['Confirmed'],
                            'recovered' => $fetched['Recovered'],
                            'deaths' => $fetched['Deaths'],
                        ]);
                    }
                }
            }
        }
    }
}
