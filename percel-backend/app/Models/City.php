<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
