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
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Mot de passe">
            <button type="submit">C'est parti !</button>
        </form>
        <a href="">
            Je n'ai pas de compte
        </a>
    </div>
</section>
@endsection
