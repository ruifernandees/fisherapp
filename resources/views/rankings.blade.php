@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Classificações</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>Por quantidade de peixes</h2>
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
                            @foreach ($usersFishesByAmount as $key => $userFishByAmount)
                                <tr>
                                    @switch ($key)
                                        @case(0)
                                            <th>🥇</th>
                                            @break

                                        @case(1)
                                            <th>🥈</th>
                                            @break
                                        
                                        @case(2)
                                            <th>🥉</th>
                                            @break
                                    @endswitch
                                    <th>{{ $key + 1 }}º lugar</th>
                                    <th>{{ $userFishByAmount->user->name }}</th>
                                    <th>{{ $userFishByAmount->fishesAmount }} peixes</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h2>Pelo mais pesado peixe pescado</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Posição</th>
                                <th>Nome</th>
                                <th>Peso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usersFishesByWeight as $key => $userFishByWeight)
                                <tr>
                                    @switch ($key)
                                        @case(0)
                                            <th>🥇</th>
                                            @break

                                        @case(1)
                                            <th>🥈</th>
                                            @break
                                        
                                        @case(2)
                                            <th>🥉</th>
                                            @break
                                    @endswitch
                                    <th>{{ $key + 1 }}º lugar</th>
                                    <th>{{ $userFishByWeight->user->name }}</th>
                                    <th>{{ $userFishByWeight->fishesWeight }}kg</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection