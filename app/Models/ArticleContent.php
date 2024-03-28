<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleContent extends Model
{
    use HasFactory;
    protected $fillable = ['body','is_default_formatting'];

    public function article_contentable()
    {
        return $this->morphTo();
    }
}
