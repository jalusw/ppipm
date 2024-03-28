<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'email',
        'phone_number',
        'address',
        'personal_data_id',
        'kelurahan_id',
        'kecamatan_id',
        'jenis_perusahaan_id'
    ];

    public function personalData()
    {
        return $this->belongsTo(PersonalData::class, 'personal_data_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

    public function jenisPerusahaan()
    {
        return $this->belongsTo(JenisPerusahaan::class, 'jenis_perusahaan_id');
    }


}
