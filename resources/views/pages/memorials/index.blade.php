@extends('layouts/default')

@section('content')
  <section class="bg-[#f0efeb] flex flex-col gap-16 py-5">
    <x-shared.content-ad w="[877px]" h="24" clsx="mx-auto"></x-shared.content-ad>

    <div class="flex max-w-screen-xl w-full mx-auto gap-16">
      <div>
        <x-features.search.memorial compact show-title></x-features.search.memorial>
      </div>
      <div class="w-72">
        <x-shared.content-ad></x-shared.content-ad>
      </div>
    </div>
  </section>

  <section class="py-6">
    <div class="max-w-screen-xl mx-auto flex items-start">
      <div class="flex flex-1 justify-center">
        <x-features.actions.memorials></x-features.actions.memorials>
      </div>
      <div class="w-80">
        <x-features.memorial.honoring></x-features.memorial.honoring>
      </div>
    </div>
  </section>
@endsection
