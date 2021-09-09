@extends('layouts.app',
[
    'styles' => ['profil']
])

@section('content')
<section id="part-profil">
    <img src="{{ asset('img/logo-txt.png')}}" alt="Logo Bab-E-Foot">
    <div class="qrcode">
        {!! $qr !!}
        <p>{{ $user->username }}</p>
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
        <p>Niveau 0</p>
        <div class="skillbar"></div>
    </div>
    <div class="stats">
        <div class="stats-1">
            <p><span>{{ $stat->goals }}</span>buts</p>
            <p>Marqués au total</p>
        </div>
        <div class="stats-2">
            <p><span>{{ $stat->playtime }}</span>min</p>
            <p>De jeu</p>
        </div>
        <div class="stats-3">
            <p><span>{{ $stat->places_visited }}</span>lieux</p>
            <p>Partenaires visités</p>
        </div>
        <div class="stats-4">
            <p><span>{{ $stat->party_played }}</span>parties</p>
            <p>De babyfoot jouées</p>
        </div>
    </div>
    <div class="history">
        <div>
            <img src="{{ asset('svg/history.svg')}}" alt="History">
            <h2>Historique</h2>
        </div>
        <diV class="results-history-v">
            <div>
                <h2>Victoire</h2>
                <p>Vous avez affronté <span>Quentin</span></p>
            </div>
            <div class="circle-v">
                <p><span>01</span>buts</p>
            </div>
        </diV>
        <diV class="results-history-d">
            <div>
                <h2>Défaite</h2>
                <p>Vous avez affronté <span>Jules</span></p>
            </div>
            <div class="circle-d">
                <p><span>01</span>buts</p>
            </div>
        </diV>
    </div>
</section>
@endsection
