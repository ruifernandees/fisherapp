<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fishing extends Model
{
    use HasFactory;

    protected $table = 'fishings';

    protected $fillable = [
        'address',
        'latitude',
        'longitude',
        'fishing_date',
        'fishing_time'
    ];
}
