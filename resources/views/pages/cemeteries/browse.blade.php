@extends('layouts/default')

@section('content')
  <section class="bg-[#fcf2e0] py-6 px-4">
    <x-widgets.cemeteries.browse-header
      :target="$item"></x-widgets.cemeteries.browse-header>
  </section>

  <section class="max-w-screen-xl mx-auto w-full py-5 md:py-10 px-4">
    <x-widgets.cemeteries.browse-locations
      :target="$item"></x-widgets.cemeteries.browse-locations>
  </section>
@endsection
