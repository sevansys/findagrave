<div class="max-w-screen-xl w-full mx-auto flex pt-10 gap-8">
  <div>
    <x-entities.memorial.daily></x-entities.memorial.daily>
  </div>
  <div class="grow">
    <x-features.actions.main></x-features.actions.main>

    {{ $slot }}
  </div>
  <div>
    <div class="w-72 h-48 border flex items-center justify-center">
      Content Ad
    </div>
  </div>
</div>
