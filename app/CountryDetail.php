<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryDetail extends Model
{
    protected $fillable = [
        'country_name', 'province', 'date', 'confirmed', 'recovered', 'deaths'
    ];
}
