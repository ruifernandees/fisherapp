@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

<style>
    .fishingLocation { height: 200px; width: 200px; }
</style>
@endsection

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
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Amigos</th>
                                <th>Localização</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fishings as $fishing)
                                <tr>
                                    <th>{{ $fishing->address }}</th>
                                    <th>
                                        {{ date("d/m/y", strtotime($fishing->fishing_date)) }}
                                    </th>
                                    <th>
                                        {{ date("H:i", strtotime($fishing->fishing_time)) }}
                                    </th>
                                    <th>
                                        @foreach ($fishing->users as $friend)
                                            @if ($friend->id != Auth::user()->id)
                                                <span>{{ $friend->name }}</span><br>
                                            @endif
                                        @endforeach
                                    </th>
                                    <th><div class="fishingLocation" id="{{ $fishing->id }}"></div></th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('fishings.create') }}">Agendar pescaria</a>

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

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

    <script>
        let locations = @json($fishingsLocations);
    </script>

   <script>
        const fishingsLocations = document.getElementsByClassName('fishingLocation');
        console.log(fishingsLocations)
        Object.keys(fishingsLocations).forEach(key => {
            let mymap = L.map(fishingsLocations[key].id).setView(locations[key], 13);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicnVpZmVybmFuZGVlcyIsImEiOiJja2gwcGYxaWgwNzhhMnlyeGNsMHhrbGdxIn0.v8K1FNTZ7-hvxBAXwPIbLg', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoicnVpZmVybmFuZGVlcyIsImEiOiJja2gwcGYxaWgwNzhhMnlyeGNsMHhrbGdxIn0.v8K1FNTZ7-hvxBAXwPIbLg'
            }).addTo(mymap);    

            let marker = L.marker(locations[key]).addTo(mymap);
        });

        
   </script>
@endsection