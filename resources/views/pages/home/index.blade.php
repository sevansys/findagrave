@extends('layouts/default')

@section('head')
  @vite('resources/scss/pages/home.scss')
@endsection

@section('content')
<x-shared.banner></x-shared.banner>

<main class="home pt-28">
  <h1 class="shadow-text text-4xl tracking-wide font-bold text-center text-white">World’s largest gravesite collection.</h1>
  <p class="shadow-text font-bold tracking-wide text-secondary text-xl text-center">Over 248 million memorials created by the community since 1995.</p>

  <x-features.search.memorial expended>
    <x-features.cemetery.daily></x-features.cemetery.daily>
  </x-features.search.memorial>

  <x-widgets.home-content>
    <article class="py-5 text text-gray-500">
      <p>
        Find the graves of ancestors, create virtual memorials or add photos, virtual flowers and a note to a
        loved one's memorial. <a href="#" class="link">Search</a> or <a href="#" class="link">browse cemeteries</a> and
        <a href="#" class="link">grave records</a> for every-day and <a href="#" class="link">famous people</a> from
        around the world.
      </p>
    </article>
  </x-widgets.home-content>
</main>
@endsection
