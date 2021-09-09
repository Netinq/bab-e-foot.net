@extends('layouts.app',
[
    'styles' => ['auth/login']
])

@section('content')
<section id="part-log">
    <div>
        <img src="{{ asset('img/logo-txt.png')}}" alt="Logo Bab-E-Foot">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <input type="email" name="email" id="email" placeholder="Email"value="{{old('email')}}" class="@error('email')is-invalid @enderror">
            @error('email')
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
            <button type="submit">C'est parti !</button>
        </form>
        <a href="{{route('register')}}">
            Je n'ai pas de compte
        </a>
    </div>
</section>
@endsection
