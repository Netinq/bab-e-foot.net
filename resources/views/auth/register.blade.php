@extends('layouts.app',
[
    'styles' => ['auth/login']
])

@section('content')
<section>
    <div>
        @if (count($errors) > 0)
    <div class="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <img src="{{ asset('img/logo-txt.png')}}" alt="Logo Bab-E-Foot">
        <form action="{{route('register')}}" method="POST">
            @csrf
            <input type="email" name="email" id="email" placeholder="Adresse e-mail">
            <input type="username" name="username" id="username" placeholder="Pseudo">
            <input type="password" name="password" id="password" placeholder="Mot de passe">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmation du mot de passe">
            <button type="submit">Je m'inscris !</button>
        </form>
        <a href="">
            <img src="{{ asset('svg/arrow-left.svg')}}" alt="Arrow left">
            Retour
        </a>
    </div>
</section>
@endsection
