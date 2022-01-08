<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomData extends Model
{
    use HasFactory;

    protected $fillable = [
        'seq',
        'first_name',
        'last_name',
        'age',
        'street',
        'city',
        'state',
        'zip',
        'dollar',
        'pick',
        'date',
    ];
}
