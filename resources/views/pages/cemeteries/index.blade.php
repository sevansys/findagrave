@extends('layouts/default')

@section('head')
  <link href="https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.css" rel="stylesheet" />
@endsection

@section('content')
  <div class="py-5 flex flex-col gap-5">
    <x-shared.content-ad w="[877px]" h="24" clsx="mx-auto"></x-shared.content-ad>

    <x-widgets.cemeteries.search></x-widgets.cemeteries.search>
    <x-widgets.cemeteries.items>
      <x-slot name="aside">
        <x-widgets.cemeteries.favorites></x-widgets.cemeteries.favorites>
        <x-shared.content-ad></x-shared.content-ad>
      </x-slot>
    </x-widgets.cemeteries.items>
  </div>
@endsection
