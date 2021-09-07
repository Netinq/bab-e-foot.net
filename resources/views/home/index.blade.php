@extends('layouts.app',
[
    'styles' => ['home']
])

@section('content')
@include('home.section-1')
@include('home.section-2')
@include('home.section-3')
@include('home.section-4')
@endsection
