<?php

namespace App\Http\Controllers;

use App\Models\Fish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FishController extends Controller
{
    public function create()
    {
        return view('create_fish');
    }

    public function show(string $id)
    {
        return view('fishes.show', ['fish' => Fish::findOrFail($id)]);
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
        }
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', '_method', 'id');

        $fishId = $request->only('id')['id'];

        $fish = Fish::find(($fishId));

        if (isset($data['image'])) {
            Storage::delete("fishesImages/{$fish->image}");

            $request->file('image')->store('fishesImages');
            $data['image'] = $request->file('image')->hashName();
        }

        $toUpdate = array_filter($data, function($item) {
            return $item;
        });

        $wasUpdated = $fish->update($toUpdate);

        if ($wasUpdated) {
            return redirect(route('fishes.show', ['id' => $fishId]))->with('status', 'Peixe atualizado com sucesso!');
        }

        return redirect(route('fishes.show', ['id' => $fishId]))->with('error', 'Erro inesperado');
    }

    public function delete(Request $request)
    {
        $fishId = $request->only('id')['id'];
        var_dump($fishId);

        $fish = Fish::find($fishId);
        $fishName = $fish->name;

        $fish->delete();

        return redirect(route('home'))->with('status', "Peixe {$fishName} deletado com sucesso!");
    }
}