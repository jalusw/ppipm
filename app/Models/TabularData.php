<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabularData extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','description','source'];

    public function tabular_dataable()
    {
        return $this->morphTo();
    }

    public function json_data()
    {
        return $this->morphMany(JsonData::class,'dataable');
    }
}
