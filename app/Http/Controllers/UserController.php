<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');

        $currentUserId = Auth::user()->id;

        $user = User::find($currentUserId);

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        }

        if (isset($data['profile_photo'])) {
            Storage::delete("usersPhotos/{$user->profile_photo}");

            $request->file('profile_photo')->store('usersPhotos');
            $data['profile_photo'] = $request->file('profile_photo')->hashName();
        }

        $toUpdate = array_filter($data, function($item) {
            return $item;
        });

        $wasUpdated = $user->update($toUpdate);

        if ($wasUpdated) {
            return redirect(route('user.index'))->with('status', 'Perfil atualizado com sucesso!');
        }

        return redirect(route('user.index'))->with('error', 'Erro inesperado');
    }
}
