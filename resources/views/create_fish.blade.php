@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Adicionar novo peixe pescado</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form 
                            method="POST" 
                            action="{{ route('fishes.store') }}"
                            enctype="multipart/form-data"
                        >
                            @csrf

                            <div class="form-group row">
                                <label 
                                    for="name" 
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('Nome') }}
                                </label>

                                <div class="col-md-6">
                                    <input 
                                        id="name" 
                                        type="text" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        required 
                                        autocomplete="name" 
                                        autofocus
                                    />

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label 
                                    for="weight" 
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('Peso (kg)') }}
                                </label>
                                <div class="col-md-6">
                                    <input 
                                        id="weight" 
                                        type="number" 
                                        step=".1"
                                        class="form-control @error('weight') is-invalid @enderror" 
                                        name="weight" 
                                        value="{{ old('weight') }}" 
                                        required 
                                        autocomplete="weight" 
                                        autofocus
                                    />

                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label 
                                    for="size" 
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('Tamanho (cm)') }}
                                </label>
                                <div class="col-md-6">
                                    <input 
                                        id="size" 
                                        type="number" 
                                        step=".01"
                                        class="form-control @error('size') is-invalid @enderror" 
                                        name="size" 
                                        value="{{ old('size') }}" 
                                        required 
                                        autocomplete="size" 
                                        autofocus
                                    />

                                    @error('size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label 
                                    for="image" 
                                    class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __('Imagem do peixe') }}
                                </label>
                                <div class="col-md-6">
                                    <input 
                                        id="image" 
                                        type="file" 
                                        class="form-control @error('image') is-invalid @enderror" 
                                        name="image" 
                                        value="{{ old('image') }}" 
                                        required 
                                        autocomplete="image" 
                                        autofocus
                                    />

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Adicionar peixe') }}
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection