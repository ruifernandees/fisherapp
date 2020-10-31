@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <h2 style="margin-top: 20px;">Suas pescarias:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Endereço</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Lago dos peixes</th>
                                <th><a href="#">Ver mais</a></th>
                            </tr>
                        </tbody>
                    </table>
                    <a href="#">Criar nova pescaria</a>

                    <h2 style="margin-top: 20px;">Peixes pescados:</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Tamanho</th>
                                <th>Massa</th>
                                <th>Imagem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fishes as $fish)
                                <tr>
                                    <th>{{ $fish->name }}</th>
                                    <th>{{ $fish->size }}</th>
                                    <th>{{ $fish->weight }}</th>
                                    <th>
                                        <a href="{{ asset('storage/fishesImages/'. $fish->image) }}">
                                            <img width="100" src="{{ asset('storage/fishesImages/'. $fish->image) }}" alt="">
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('fishes.create') }}">Adicionar peixe</a>

                    <h2 style="margin-top: 20px;">Classificações</h2>
                    <h3>Por quantidade de peixes</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Posição</th>
                                <th>Nome</th>
                                <th>Pescou</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>🥇</th>
                                <th>1º lugar</th>
                                <th><a href="#">Rui</a></th>
                                <th>20 peixes</th>
                            </tr>
                            <tr>
                                <th>🥈</th>
                                <th>2º lugar</th>
                                <th><a href="#">José</a></th>
                                <th>15 peixes</th>
                            </tr>
                            <tr>
                                <th>🥉</th>
                                <th>3º lugar</th>
                                <th><a href="#">João</a></th>
                                <th>10 peixes</th>
                            </tr>
                        </tbody>
                    </table>

                    <h3>Pelo mais pesado peixe pescado</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Posição</th>
                                <th>Nome</th>
                                <th>Peixe</th>
                                <th>Peso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>🥇</th>
                                <th>1º lugar</th>
                                <th><a href="#">Rui</a></th>
                                <th><a href="#">Dourado-do-mar</a></th>
                                <th>22kg</th>
                            </tr>
                            <tr>
                                <th>🥈</th>
                                <th>2º lugar</th>
                                <th><a href="#">João</a></th>
                                <th><a href="#">Truta-arco-íris</a></th>
                                <th>12kg</th>
                            </tr>
                            <tr>
                                <th>🥉</th>
                                <th>3º lugar</th>
                                <th><a href="#">José</a></th>
                                <th><a href="#">Carpa-comum</a></th>
                                <th>10kg</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
