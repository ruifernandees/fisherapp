<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFishing extends Model
{
    use HasFactory;

    protected $table = 'users_fishings';

    protected $fillable = [
        'user_id',
        'fishing_id'
    ];
}
