<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SppInformation extends Model
{
    protected $table = 'spp_information';

    protected $fillable = [
        'jurusan',
        'amount',
        'description',
    ];
}
