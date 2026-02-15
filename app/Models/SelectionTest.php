<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectionTest extends Model
{
    use HasFactory;

    protected $table = 'selection_tests';

    protected $fillable = [
        'title',
        'type',
        'description',
    ];
}
