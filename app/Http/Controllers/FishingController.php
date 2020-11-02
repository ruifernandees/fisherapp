<?php

namespace App\Http\Controllers;

use App\Models\Fishing;
use App\Models\User;
use App\Models\UserFishing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FishingController extends Controller
{
    public function create()
    {
        $allUsers = User::all();

        foreach ($allUsers as $key => $user) {
            if ($user->id == Auth::user()->id) {
                unset($allUsers[$key]);
            }
        }
        
        return view('schedule_fishing', [
            'allUsers' => $allUsers
        ]);
    }

    public function store(Request $request)
    {
        // var_dump($request->except(['_token']));

        $fishingData = $request->except(['_token', 'friends']);
        $friends = $request->only(['friends'])['friends'];

        // var_dump('Fishing ', $fishingData);
        
        $fishing = Fishing::create($fishingData);

        if ($fishing) {
            $friendsObjects = User::find($friends);

            $userFishings = [];
            foreach ($friendsObjects as $friend) {
                $userFishings[] = UserFishing::create([
                    'user_id' => $friend->id,
                    'fishing_id' => $fishing->id
                ]);
            }

            $userFishings[] = UserFishing::create([
                'user_id' => Auth::user()->id,
                'fishing_id' => $fishing->id
            ]);

            if ($userFishings) {
                return redirect('pescarias/agendar')->with('status', 'Pescaria agendada com sucesso!');
            }
        } 
        
        return back()->withInput()->withErrors(['Erro inesperado']);
    }
}
