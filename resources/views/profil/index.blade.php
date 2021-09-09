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
    <form action="{{route('logout')}}" method="post">
        @csrf
        <button type="submit" class="exit"><img src="{{ asset('svg/exit.svg')}}" alt="Exit">
            <p>Déconnexion</p>
        </button>
    </form>
    <div class="level">
        <div>
            <img src="{{ asset('svg/stats.svg')}}" alt="Stats">
            <h2>Mes Statistiques</h2>
        </div>
        <p id="level">Niveau 0</p>
        <div class="skillbar">
            <div id="skill"></div>
        </div>
    </div>
    <div class="stats">
        <div class="stats-1">
            <p><span>{{ $stat->goals }}</span>buts</p>
            <p>Marqués au total</p>
        </div>
        <div class="stats-2">
            <p><span>{{ round($stat->playtime / 60, 0) }}</span>min</p>
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
        @foreach ($games as $game )
        <diV class="{{ $game->win ? 'results-history-v' : 'results-history-d'}}">
            <div>
                <h2>{{ $game->win ? 'Victoire' : 'Défaite'}}</h2>
                <p>Vous avez affronté <span>{{$game->enemy_name}}</span></p>
            </div>
            <div class="{{ $game->win ? 'circle-v' : 'circle-d'}}">
                <p><span>{{$game->goals}}</span>buts</p>
            </div>
        </diV>
        @endforeach
    </div>
</section>

<script>
    window.addEventListener('load', () => {

        const skill = document.getElementById('skill');
        const points = {!! json_encode($stat->points) !!};
        let level = 1;
        let exp = 9;
        for (let e = 9; 1.5**e < points; e++)
        {
            level++;
            exp += 1;
        }
        let percentage = (points - 1.5**(exp-1)) * 100 / (1.5**(exp)-1.5**(exp-1));
        skill.style.width = percentage+'%';
        document.getElementById('level').textContent = 'Niveau '+level;
    });
</script>

@endsection
