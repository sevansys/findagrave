@extends('layouts/default')

@section('content')
  <article>
    <section class="bg-[#fcf2e0] flex flex-col">
      <div class="max-w-screen-xl mx-auto w-full py-5">
        <x-shared.content-ad h="24" w="24"></x-shared.content-ad>
      </div>

      <x-widgets.cemetery.banner :target="$item"></x-widgets.cemetery.banner>
      <x-widgets.cemetery.tabs :target="$item"></x-widgets.cemetery.tabs>
    </section>

    <section class="pt-5 pb-10">
      <div class="max-w-screen-xl mx-auto w-full flex gap-5">
        <div class="flex flex-col gap-8 w-1/3">
          <x-widgets.cemetery.about
            :target="$item"></x-widgets.cemetery.about>
          <x-widgets.cemetery.contributed
            :target="$item"></x-widgets.cemetery.contributed>
          <x-shared.content-ad></x-shared.content-ad>
          <x-widgets.cemetery.photos :target="$item"></x-widgets.cemetery.photos>
        </div>
        <div class="flex-1">
          <div class="sticky top-7 flex flex-col">
            <x-widgets.cemetery.menu
              :target="$item"></x-widgets.cemetery.menu>

            <div class="body-html py-4">
              @unless($item->description)
                <i class="text-gray-600 text flex text-center justify-center">
                  This cemetery currently has no description.
                </i>
              @else
                {!! $item->description !!}
              @endif
            </div>

            <x-widgets.cemetery.nearby-cemeteries :target="$item"></x-widgets.cemetery.nearby-cemeteries>
          </div>
        </div>
      </div>
    </section>

    <section class="max-w-screen-xl w-full mx-auto pt-10 pb-5">
      <x-widgets.cemetery.footer :target="$item"></x-widgets.cemetery.footer>
    </section>
  </article>
@endsection
