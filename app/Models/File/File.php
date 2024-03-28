<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['file_name', 'file_path', 'fileable_id', 'fileable_type', 'file_type_id'];

    public function fileable()
    {
        return $this->morphTo();
    }

    public function fileType()
    {
        return $this->belongsTo(FileType::class);
    }
}
