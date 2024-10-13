@extends('layouts/default')

@section('head')
  <link href="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.css" rel="stylesheet" />
@endsection

@section('content')
  <article class="flex flex-col">
    <section class="bg-[#fcf2e0] flex flex-col">
      <div class="max-w-screen-md mx-auto w-full py-0 sm:py-2 md:py-5">
        <x-shared.content-ad h="24" w="24"></x-shared.content-ad>
      </div>

      <x-widgets.cemetery.banner-lite :target="$item"></x-widgets.cemetery.banner-lite>
      <x-widgets.cemetery.tabs :target="$item"></x-widgets.cemetery.tabs>
    </section>

    <div class="flex flex-col pt-4 px-2">
      <x-widgets.cemetery.map :target="$item"></x-widgets.cemetery.map>
    </div>

    <section class="w-full pb-5">
      <x-widgets.cemetery.footer :target="$item"></x-widgets.cemetery.footer>
    </section>
  </article>
@endsection
