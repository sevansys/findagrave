@extends('layouts/default')

@section('content')
  <section class="bg-[#f0efeb] flex flex-col gap-4 md:gap-8 lg:gap-16 py-0 md:py-2 lg:py-5 px-3">
    <x-shared.content-ad w="[877px]" h="24" clsx="mx-auto"></x-shared.content-ad>

    <div class="flex flex-col lg:flex-row max-w-screen-xl w-full mx-auto gap-4 md:gap-8 lg:gap-16">
      <x-features.search.memorial compact show-title></x-features.search.memorial>
      <div class="w-full lg:w-72">
        <x-shared.content-ad></x-shared.content-ad>
      </div>
    </div>
  </section>

  <section class="py-6 px-3">
    <div class="max-w-screen-xl w-full gap-5 lg:gap-10 mx-auto flex flex-col md:flex-row items-start">
      <div class="flex flex-1 justify-center w-full">
        <x-features.actions.memorials
          justify="center"
        ></x-features.actions.memorials>
      </div>
      <div class="w-full md:w-80">
        <x-features.memorial.honoring></x-features.memorial.honoring>
      </div>
    </div>
  </section>
@endsection
