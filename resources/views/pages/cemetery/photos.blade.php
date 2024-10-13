@extends('layouts/default')

@section('content')
  <article class="flex flex-col gap-2">
    <section class="bg-[#fcf2e0] flex flex-col">
      <div class="max-w-screen-xl mx-auto w-full py-0 sm:py-2 md:py-5">
        <x-shared.content-ad h="24" w="24"></x-shared.content-ad>
      </div>

      <x-widgets.cemetery.banner-lite :target="$item"></x-widgets.cemetery.banner-lite>
      <x-widgets.cemetery.tabs :target="$item"></x-widgets.cemetery.tabs>
    </section>

    <x-widgets.cemetery.all-photos :target="$item"></x-widgets.cemetery.all-photos>

    <section class="max-w-screen-xl w-full mx-auto pt-5 md:pt-10 pb-5 px-2">
      <x-widgets.cemetery.footer :target="$item"></x-widgets.cemetery.footer>
    </section>
  </article>
@endsection
