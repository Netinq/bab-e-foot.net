@section('description', "Une nouvelle manière d'apprécier et de jouer au babyfoot. Rejoignez une communauté des joueurs en ligne depuis n'importe quel babyfoot partenaire !")

<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Default meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">

        <meta name='author' content='Quentin Sar, Netinq'>
        <meta name='owner' content='Bab-E-Foot'>
        <meta name='subject' content="Bab-E-Foot">

        <meta name='identifier-URL' content='bab-e-foot.net'>
        <meta name="description" content="@yield('description')">
        <meta name='reply-to' content='contact@bab-e-foot.net'>

        <meta name='language' content='FR'>
        <meta name='target' content='all'>
        <meta name='theme-color' content='#47F561'>

        <link rel='shortcut icon' type='image/png' href='{{ asset('img/icon.png') }}'>
        <link rel="apple-touch-icon" href="{{ asset('img/icon.png') }}" />

        <!-- Twitter Card meta -->
        <meta name='twitter:card' content='summary'>
        <meta name="twitter:title" content="@hasSection('title') @yield('title') @else Votre babyfoot connecté, notre solution embarqué @endif" />
        <meta name='twitter:url' content='https://bab-e-foot.net' />
        <meta name='twitter:domain' content='bab-e-foot.net' />
        <meta name="twitter:description" content="@yield('description')" />
        <meta name="twitter:image" content="{{asset('img/meta.png')}}" />

        <!-- Open Graph meta -->
        <meta property='og:title' content='@hasSection('title') @yield('title') @else Votre babyfoot connecté, notre solution embarqué @endif' />
        <meta property="og:description" content="@yield('description')" />
        <meta property="og:image" content="{{asset('img/meta.png')}}" />
        <meta property='og:type' content='website' />
        <meta property='og:url' content='https://bab-e-foot.net' />
        <meta property='og:site_name' content='{{Config::get('app.name')}}' />
        <meta property="og:locale" content="fr_FR" />

        <!-- IOS meta -->
        <meta name="apple-mobile-web-app-title" content="{{Config::get('app.name')}}">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "Organization",
                "name": "Bab-E-Foot",
                "legalName": "Bab-E-Foot",
                "description": ""Une nouvelle manière d'apprécier et de jouer au babyfoot. Rejoignez une communauté des joueurs en ligne depuis n'importe quel babyfoot partenaire !",
                "image": "https://bab-e-foot.net/img/meta.jpg",
                "logo": "https://bab-e-foot.net/img/logo.png",
                "url": "https://bab-e-foot.net",
                "email": "volley@agja.fr"
            }
        </script>

        <title>@hasSection('title') @yield('title') @else Votre babyfoot connecté, notre solution embarqué @endif</title>

        <!-- STATIC Stylesheets -->
        @hasSection('noMaster') @else
            <link rel="stylesheet" type="text/css" href="{{ asset('css/master.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/header.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/layouts/footer.css') }}">
        @endif

        <!-- GENERATE Stylesheet -->
        @if($styles ?? null)
            @foreach($styles as $style)
            <link rel="stylesheet" type="text/css"
            href="{{ asset('css/'.$style.'.css') }}">
            @endforeach
        @endif

    </head>

    <body class="row">
        {{-- @include('layouts.header') --}}
        @yield('content')
        <script src="{{asset('js/layouts/menu.js')}}"></script>
    </body>
</html>
