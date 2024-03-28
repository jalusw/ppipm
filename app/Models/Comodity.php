<?php

namespace App\Models;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comodity extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_sector_id',
        'name',
        'slug',
        'image',
        'archived',
        'description',
    ];

    public function sub_sector()
    {
        return $this->belongsTo(SubSector::class);
    }

    public function category()
    {
        return $this->morphOne(Category::class, 'categorizable');

    }

    public function geo_json()
    {
        return $this->morphOne(Geojson::class,'geographicable');;
    }

    public function article_content()
    {
        return $this->morphOne(ArticleContent::class,'article_contentable');
    }

    public function tabular_data()
    {
        return $this->morphMany(TabularData::class, 'tabular_dataable');
    }
}
