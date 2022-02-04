@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Mantenimiento')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('css/base/pages/page-misc.css') }}">
@endsection

@section('content')
    <!-- Not authorized-->
    <div class="misc-wrapper">
        
        <div class="w-100 text-center">
            <h2 class="mb-1">¡LO SENTIMOS! 🔐</h2>

            <p class="mb-2">la página esta recibiendo cambios actualmente</p>

            <img class="img-fluid" src="{{ asset('images/pages/not-authorized.png') }}" alt="Not authorized page" />
        </div>
    </div>
    <!-- / Not authorized-->
    </section>
    <!-- maintenance end -->
@endsection
