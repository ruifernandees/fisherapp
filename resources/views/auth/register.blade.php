@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label 
                                for="cpf" 
                                class="col-md-4 col-form-label text-md-right"
                            >
                                {{ __('CPF') }}
                            </label>

                            <div class="col-md-6">
                                <input 
                                    id="cpf" 
                                    type="text" 
                                    size="11"
                                    class="form-control @error('cpf') is-invalid @enderror" 
                                    name="cpf" 
                                    value="{{ old('cpf') }}" 
                                    required 
                                    autocomplete="cpf"
                                />

                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <!-- 'cpf',
        'phone',
        'profile_photo',
        'address' -->

                        <div class="form-group row">
                            <label 
                                for="phone" 
                                class="col-md-4 col-form-label text-md-right"
                            >
                                {{ __('Telefone') }}
                            </label>

                            <div class="col-md-6">
                                <input 
                                    id="phone" 
                                    type="tel" 
                                    size="11"
                                    pattern="[0-9]{2}[0-9]{9}"
                                    class="form-control @error('cpf') is-invalid @enderror" 
                                    name="phone" 
                                    value="{{ old('phone') }}" 
                                    required 
                                    autocomplete="phone"
                                />
                                <small>Exemplo: 11912345678</small>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label 
                                for="address" 
                                class="col-md-4 col-form-label text-md-right"
                            >
                                {{ __('Endereço') }}
                            </label>

                            <div class="col-md-6">
                                <input 
                                    id="address" 
                                    type="text" 
                                    class="form-control @error('address') is-invalid @enderror" 
                                    name="address" 
                                    value="{{ old('address') }}" 
                                    required 
                                    autocomplete="address"
                                />

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
