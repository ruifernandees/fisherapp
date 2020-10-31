<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listUser()
    {
        $user = new User();
        echo "<h1>User List</h1>";
    }
}
