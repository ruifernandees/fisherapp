@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

<style>
    #mapid { height: 180px; }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Agendar pescaria</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form 
                        method="POST"
                        action="{{ route('fishings.store') }}"
                    >
                        @csrf

                        <div class="form-group row">
                            <label 
                                for="address" 
                                class="col-md-4 col-form-label text-md-right"
                            >
                                {{ __('Endereço') }}
                            </label>

                            <div class="col-md-8">
                                <input 
                                    id="address" 
                                    type="text" 
                                    class="form-control @error('address') is-invalid @enderror" 
                                    name="address" 
                                    value="{{ old('address') }}" 
                                    required 
                                    autocomplete="address" 
                                    autofocus
                                />

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="mapid"></div>
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">

                        <div class="form-group row">
                            <label 
                                for="fishing_date" 
                                class="col-md-4 col-form-label text-md-right"
                            >
                                {{ __('Data') }}
                            </label>

                            <div class="col-md-8">
                                <input 
                                    id="fishing_date" 
                                    type="date" 
                                    class="form-control @error('fishing_date') is-invalid @enderror" 
                                    name="fishing_date" 
                                    value="{{ old('fishing_date') }}" 
                                    required 
                                    autofocus
                                />

                                @error('fishing_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label 
                                for="fishing_time" 
                                class="col-md-4 col-form-label text-md-right"
                            >
                                {{ __('Hora') }}
                            </label>

                            <div class="col-md-8">
                                <input 
                                    id="fishing_time" 
                                    type="time" 
                                    class="form-control @error('fishing_time') is-invalid @enderror" 
                                    name="fishing_time" 
                                    value="{{ old('fishing_time') }}" 
                                    required
                                    autofocus
                                />

                                @error('fishing_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label 
                                for="friends" 
                                class="col-md-4 col-form-label text-md-right"
                            >
                                {{ __('Amigos') }}
                            </label>

                            <div class="col-md-6">
                                
                                

                                @foreach ($allUsers as $user)
                                    <label for="{{ $user->id }}" class="row align-items-center">
                                        <input  
                                            id="{{ $user->id }}"
                                            type="checkbox" 
                                            class="form-check @error('friends') is-invalid @enderror" 
                                            name="friends[]" 
                                            value="{{ $user->id }}"
                                            autocomplete="friends" 
                                            autofocus
                                        />
                                        <span style="margin-left: 5px;">{{ $user->name }}</span>
                                    </label>
                                @endforeach

                                @error('friends')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Agendar') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
        navigator.geolocation.getCurrentPosition(position => {
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');

            const { latitude, longitude } = position.coords;

            const initialPosition = [latitude, longitude];

            latitudeInput.value = latitude;
            longitudeInput.value = longitude;

            var mymap = L.map('mapid').setView(initialPosition, 13);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicnVpZmVybmFuZGVlcyIsImEiOiJja2gwcGYxaWgwNzhhMnlyeGNsMHhrbGdxIn0.v8K1FNTZ7-hvxBAXwPIbLg', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoicnVpZmVybmFuZGVlcyIsImEiOiJja2gwcGYxaWgwNzhhMnlyeGNsMHhrbGdxIn0.v8K1FNTZ7-hvxBAXwPIbLg'
            }).addTo(mymap);

            var marker = L.marker(initialPosition).addTo(mymap);

            mymap.on('click', onMapClick);

            function onMapClick(e) {
                marker.setLatLng(e.latlng);
                latitudeInput.value = e.latlng.lat;
                longitudeInput.value = e.latlng.lng;
            }
        });
   </script>
@endsection