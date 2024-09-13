@extends('layouts/default')

@section('head')
  @vite('resources/css/pages/home.scss')
@endsection

@section('content')
<x-shared.banner></x-shared.banner>

<main class="home pt-32">
  <section class="max-w-screen-md mx-auto">
    <h1 class="shadow-text text-4xl tracking-wide font-bold text-center text-white">World’s largest gravesite collection.</h1>
    <p class="shadow-text font-bold tracking-wide text-secondary text-xl text-center">Over 248 million memorials created by the community since 1995.</p>

    <x-features.search.memorial></x-features.search.memorial>
  </section>
</main>
@endsection
