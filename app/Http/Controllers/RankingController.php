<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function index()
    {
        $usersFishesByAmount = DB::table('users')
            ->join('fishes', 'users.id', '=', 'fishes.user_id')
            ->select(DB::raw('count(fishes.id) as fishesAmount'), 'users.id')
            ->groupBy('users.id')
            ->orderBy(DB::raw('count(fishes.id)'), 'desc')
            ->limit(3)
            ->get();

        foreach ($usersFishesByAmount as $userFish) {
            $userFish->user = User::find($userFish->id);
            unset($userFish->id);
        }

        $usersFishesByWeight = DB::table('users')
            ->join('fishes', 'users.id', '=', 'fishes.user_id')
            ->select(DB::raw('max(fishes.weight) as fishesWeight'), 'users.id')
            ->groupBy('users.id')
            ->orderBy(DB::raw('max(fishes.weight)'), 'desc')
            ->limit(3)
            ->get();

        foreach ($usersFishesByWeight as $userFish) {
            $userFish->user = User::find($userFish->id);
            unset($userFish->id);
        }

        return view('rankings', [
            'usersFishesByAmount' => $usersFishesByAmount,
            'usersFishesByWeight' => $usersFishesByWeight
        ]);
    }
}
