<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    use HasFactory;

    protected $table = "umkms";
    protected $fillable = [
        'nib',
        'business_name',
        'email',
        'phone_number',
        'kbli',
        'address',
        'capital',
        'personal_data_id',
        'kelurahan_id',
        'kecamatan_id',
        'jenis_perusahaan_id',
        'status_penanaman_modal_id',
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

    public function statusPenanamanModal()
    {
        return $this->belongsTo(StatusPenanamanModal::class, 'status_penanaman_modal_id');
    }
}