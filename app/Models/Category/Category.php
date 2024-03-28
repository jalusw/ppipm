<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['master_category_id'];

    public function categorizable()
    {
        return $this->morphTo();
    }

    public function master_category()
    {
        return $this->belongsTo(MasterCategory::class,'master_category_id');
    }

}
