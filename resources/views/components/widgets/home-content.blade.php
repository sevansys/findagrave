<div class="max-w-screen-xl w-full mx-auto flex flex-wrap bg-[#fafafa] flex-col md:flex-row pt-10 gap-8 px-3">
  <div>
    <x-entities.memorial.daily
      class="flex-auto w-full md:w-72"></x-entities.memorial.daily>
  </div>
  <div class="flex-1">
    <x-features.actions.main></x-features.actions.main>

    {{ $slot }}
  </div>
  <div class="w-full xl:w-72">
    <div class="h-48 border flex items-center justify-center">
      Content Ad
    </div>
  </div>
</div>
