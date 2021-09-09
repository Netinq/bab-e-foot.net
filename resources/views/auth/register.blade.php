@extends('layouts.app',
[
    'styles' => ['auth/login']
])

@section('content')
<section id="part-log">
    <div>
        <img src="{{ asset('img/logo-txt.png')}}" alt="Logo Bab-E-Foot">
        <form action="{{route('register')}}" method="POST">
            @csrf
            <input type="email" name="email" id="email" placeholder="Adresse e-mail" value="{{old('email')}}" class="@error('email')is-invalid @enderror">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="username" name="username" id="username" placeholder="Pseudo" value="{{old('username')}}" class="@error('username')is-invalid @enderror">
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="password" name="password" id="password" placeholder="Mot de passe" class="@error('password')is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmation du mot de passe" class="@error('password')is-invalid @enderror">
            <button type="submit">Je m'inscris !</button>
        </form>
        <a href="{{route('login')}}">
            J'ai déjà un compte
        </a>
    </div>
</section>
@endsection
