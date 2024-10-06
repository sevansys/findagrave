<div
  x-cloak
  x-data="map({
    minZoom: 12,
    zoom: {{ $zoom }},
    center: @json($center),
    accessToken: '{{ $key }}',
    container: 'cemeteries-map',
  })"
  class="w-full h-[500px] text-gray-600 bg-gray-100 border flex justify-center items-center relative"
>
  <template id="cemetery-marker-template">
    <span class="flex w-10 h-10 p-2 bg-[#c60] text-white rounded-md">
      <x-shared.icons.cemetery></x-shared.icons.cemetery>
    </span>
  </template>
  <template id="cemetery-popover-template">
    <div __X_DATA__ class="flex flex-col gap-2 text-xs">
      <a :href="url" class="link text-sm font-semibold">
        <h4 x-html="name"></h4>
      </a>

      <div class="flex flex-col">
        <div class="flex items-center gap-0.5">
          <span class="w-4 h-4">
            <x-shared.icons.grave></x-shared.icons.grave>
          </span>
          <span class="flex items-center gap-0.5">
            <span x-html="memorialsCount"></span>
            <span>Memorials</span>
          </span>
          <template x-if="photographed">
            <span x-html="`(${photographed}% photographed)`"></span>
          </template>
        </div>
        <template x-if="memorialsWithGpsPercent">
          <div class="flex items-center gap-1">
            <span class="w-5 h-5">
              <x-shared.icons.gps></x-shared.icons.gps>
            </span>
            <span x-html="`${memorialsWithGpsPercent}% with GPS`"></span>
          </div>
        </template>
      </div>
    </div>
  </template>
  <template x-if="!instance">
    <div class="absolute">
      <x-shared.loading></x-shared.loading>
    </div>
  </template>
  <div id="cemeteries-map" class="w-full h-full"></div>
</div>

