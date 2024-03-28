<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JsonData extends Model
{
    use HasFactory;
    protected $fillable = ['data'];

    public function dataable()
    {
        return $this->morphTo();
    }

}
