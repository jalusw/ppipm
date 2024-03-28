<?php

namespace App\Models;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug','code', 'description'];

    public function sub_sectors()
    {
        return $this->hasMany(SubSector::class);
    }

    public function category()
    {
        return $this->morphOne(Category::class,'categorizable');
    }

}
