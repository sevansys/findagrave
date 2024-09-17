@extends('layouts/default')

@section('content')
  <section class="bg-[#fcf2e0] py-6">
    <x-widgets.cemeteries.browse-header
      :target="$item"></x-widgets.cemeteries.browse-header>
  </section>

  <section class="max-w-screen-xl mx-auto w-full py-10">
    <x-widgets.cemeteries.browse-locations
      :target="$item"></x-widgets.cemeteries.browse-locations>
  </section>
@endsection
