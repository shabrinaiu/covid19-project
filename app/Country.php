<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'slug', 'iso2',
    ];

    public function details() {
        return $this->hasMany(CountryDetail::class, 'country_slug', 'slug');
    }
}
