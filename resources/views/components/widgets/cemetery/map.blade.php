<section class="map map--cemetery flex flex-col md:flex-1 w-full">
  <header class="py-2 flex gap-3 justify-center md:justify-end items-center text-gray-700 text-sm">
    @unless($hasCoordinates)
      <span class="flex gap-1 items-center">
        <span class="w-5 h-5">
          <x-shared.icons.global></x-shared.icons.global>
        </span>
        <span>No coordinates</span>
      </span>
    @else
      <x-shared.get-directions
        :latitude="$target->latitude"
        :longitude="$target->longitude"
      ></x-shared.get-directions>
      ·
      <span class="flex items-center gap-1">
        <span class="w-5 h-5">
          <x-shared.icons.global></x-shared.icons.global>
        </span>
        <span class="hidden lg:inline-block">Coordinates:</span>
        <span>{{ $target->latitude }},</span>
        <span>{{ $target->longitude }}</span>
      </span>
    @endif
  </header>

  <div class="flex md:h-full flex-col md:flex-row gap-5 md:gap-0">
    <x-widgets.cemetery.map-info class="order-1 md:order-0 md:w-80" :target="$target"></x-widgets.cemetery.map-info>
    <x-features.cemetery.map class="order-0 md:order-1" :target="$target"></x-features.cemetery.map>
  </div>
</section>
