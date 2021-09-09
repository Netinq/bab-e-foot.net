@extends('layouts.app',
[
    'styles' => ['profil']
])

@section('content')
<section id="part-profil">
    <img src="{{ asset('img/logo-txt.png')}}" alt="Logo Bab-E-Foot">
    <div class="qrcode">
        {!! $qr !!}
        <p>thibault.barral</p>
        <a href="" class="modifier"><img src="{{ asset('svg/pen.svg')}}" alt="Modifier"></a>
    </div>
    <a href="" class="exit"><img src="{{ asset('svg/exit.svg')}}" alt="Exit">
        <p>Déconnexion</p>
    </a>
    <div class="level">
        <div>
            <img src="{{ asset('svg/stats.svg')}}" alt="Stats">
            <h2>Mes Statistiques</h2>
        </div>
        <p>Niveau 25</p>    
        <div class="skillbar"></div>
    </div>
    <div class="stats">
        <div class="stats-1">
            
        </div>
        <div class="stats-2">
            
        </div>
        <div class="stats-3">
            
        </div>
        <div class="stats-4">
            
        </div>
    </div>
</section>
@endsection
