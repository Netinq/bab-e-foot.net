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
            <input type="email" name="email" id="email" placeholder="Adresse e-mail">
            <input type="username" name="username" id="username" placeholder="Pseudo">
            <input type="password" name="password" id="password" placeholder="Mot de passe">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmation du mot de passe">
            <button type="submit">Je m'inscris !</button>
        </form>
        <a href="">
            J'ai déjà un compte
        </a>
    </div>
</section>
@endsection
