<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kemitraan extends Model
{
    use HasFactory;
    protected $fillable = [
        'umkm_id',
        'perusahaan_id',
        'partnership_form',
        'description',
        'start_of_partnership',
        'end_of_partnership',
        'partnership_status',
    ];

    public function umkm()
    {
        return $this->belongsTo(UMKM::class, 'umkm_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
}
