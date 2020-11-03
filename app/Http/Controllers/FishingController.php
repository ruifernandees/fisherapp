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

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'id', 'friends']);

        $fishingId = $request->only('id')['id'];
        $fishing = Fishing::find($fishingId);

        $fishingUsers = $fishing->users;
        
        if (isset($request->only('friends')['friends'])) {
            $friendsFromRequest = $request->only('friends')['friends'];

            $friendsFromDB = [];
            foreach ($fishingUsers as $key => $user) {
                if ($user->id != Auth::user()->id) {
                    $friendsFromDB[$key] = strval($user->id);
                }
            }

            $missingInDB = array_diff($friendsFromRequest, $friendsFromDB);

            if ($missingInDB) {
                foreach ($missingInDB as $friendId) {
                    UserFishing::create([
                        'user_id' => $friendId,
                        'fishing_id' => $fishing->id
                    ]);
                }
            }
            
            $missingInRequest = array_diff($friendsFromDB, $friendsFromRequest);

            if ($missingInRequest) {
                foreach ($missingInRequest as $friendId) {
                    DB::table('users_fishings')
                        ->where('user_id', '=', $friendId)
                        ->where('fishing_id', '=', $fishing->id)
                        ->delete();
                }
            }
        }

        $toUpdate = array_filter($data, function($item) {
            return $item;
        });

        $wasUpdated = $fishing->update($toUpdate);

        if ($wasUpdated) {
            return redirect(route('fishings.show', ['id' => $fishingId]))->with('status', 'Pescaria atualizada com sucesso!');
        }

        return redirect(route('fishings.show', ['id' => $fishingId]))->with('error', 'Erro inesperado');
    }
}
