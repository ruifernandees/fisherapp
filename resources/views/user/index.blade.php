@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Configurações</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form 
                    method="POST" 
                    action="{{ route('user.update') }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">

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
                                value="{{ $user->name }}"  
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
                            for="email" 
                            class="col-md-4 col-form-label text-md-right"
                        >
                            {{ __('E-mail') }}
                        </label>
                        <div class="col-md-6">
                            <input 
                                id="email" 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{ $user->email }}"  
                                required
                                autocomplete="email" 
                                autofocus
                            />

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
                                    required
                                    value="{{ $user->cpf }}" 
                                    autocomplete="cpf"
                                />

                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                                    required
                                    value="{{ $user->phone }}" 
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
                                    required
                                    value="{{ $user->address }}" 
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
                        <label 
                            for="profile_photo" 
                            class="col-md-4 col-form-label text-md-right"
                        >
                            {{ __('Imagem de perfil') }}
                        </label>
                        <div class="col-md-6">
                            <input 
                                id="profile_photo" 
                                type="file" 
                                class="form-control @error('profile_photo') is-invalid @enderror" 
                                name="profile_photo" 
                                value="{{ old('profile_photo') }}"  
                                autocomplete="profile_photo" 
                                autofocus
                            />

                            @error('profile_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label 
                            for="password" 
                            class="col-md-4 col-form-label text-md-right"
                        >
                            {{ __('Senha') }}
                        </label>
                        <div class="col-md-6">
                            <input 
                                id="password" 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" 
                                value="{{ old('password') }}"  
                                autocomplete="password" 
                                autofocus
                            />

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Atualizar perfil') }}
                            </button>
                        </div>
                    </div>
                    
                </form>

                <div class="form-group row mb-0" style="margin-top: 10px;">
                        <div class="col-md-6 offset-md-4">
                            <form action="{{ route('user.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="javascript:return deleteAccountConfirmation()">
                                    Deletar esta conta
                                </button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        const deleteAccountConfirmation = () => confirm('Você realmente deseja deletar sua conta?');
    </script>
@endsection