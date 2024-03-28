<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'address',
        'phone_number',
        'email',
    ];

    protected $dates = ['date_of_birth'];

}
