<?php

namespace App\Http\Controllers;

use App\Models\Fishing;
use App\Models\User;
use App\Models\UserFishing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function show(string $id)
    {
        $currentUserId = Auth::user()->id;

        $currentUser = User::find($currentUserId);
        
        $fishing = Fishing::findOrFail($id);

        $fishingLocation = [$fishing->latitude, $fishing->longitude];

        $allUsers = User::all();

        foreach ($allUsers as $key => $user) {
            if ($user->id == Auth::user()->id) {
                unset($allUsers[$key]);
            }
        }

        $selectedFriends = $fishing->users;

        $selectedFriendsId = [];
        foreach ($selectedFriends as $selectedFriend) {
            $selectedFriendsId[] = $selectedFriend->id;
        }

        return view('fishings.show', [
            'fishing' => $fishing,
            'fishingLocation' => $fishingLocation,
            'allUsers' => $allUsers,
            'selectedFriendsId' => $selectedFriendsId
        ]);
    }

    public function store(Request $request)
    {
        $fishingData = $request->except(['_token', 'friends']);

        if (isset($request->only(['friends'])['friends'])) {
            $friends = $request->only(['friends'])['friends'];
        }
        
        $fishing = Fishing::create($fishingData);

        if ($fishing) {
            $userFishings = [];

            if (isset($friends)) {
                $friendsObjects = User::find($friends);

                foreach ($friendsObjects as $friend) {
                    $userFishings[] = UserFishing::create([
                        'user_id' => $friend->id,
                        'fishing_id' => $fishing->id
                    ]);
                }
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
