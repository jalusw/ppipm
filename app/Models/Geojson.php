<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geojson extends Model
{
    
    use HasFactory;

    public function json_data()
    {
        return $this->morphOne(JsonData::class,'dataable');
    }
    
    public function geographicable()
    {
        return $this->morphTo();
    }
}
