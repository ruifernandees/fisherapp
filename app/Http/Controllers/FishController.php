<?php

namespace App\Http\Controllers;

use App\Models\Fish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FishController extends Controller
{
    public function create()
    {
        return view('create_fish');
    }

    public function store(Request $request)
    {
        $request->file('image')->store('fishesImages');
        $data = $request->except('image', '_token');
        
        $fishData = [
            'name' => $data['name'],
            'weight' => $data['weight'],
            'size' => $data['size'],
            'image' => $request->file('image')->hashName(),
            'user_id' => Auth::user()->id,
        ];

        if(Fish::create($fishData)) {
            return redirect('peixes/criar')->with('status', 'Peixe pescado adicionado com sucesso!');
        } else {
            return back()->withInput()->withErrors(['Erro inesperado']);
        };
    }
}