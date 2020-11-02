<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;

        $currentUser = User::find($currentUserId);

        $fishes = $currentUser->fishes;
        $fishings = $currentUser->fishings;
        
        $fishingsLocations = [];
        foreach ($fishings as $fishing) {
            $fishingsLocations[] = [$fishing->latitude, $fishing->longitude];
        }
        return view('home', [
            'fishes' => $fishes,
            'fishings' => $fishings,
            'fishingsLocations' => $fishingsLocations,
        ]);
    }
}
