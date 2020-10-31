<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;
    protected $table = 'fishes';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'weight',
        'size',
        'image',
        'user_id'
    ];
}
