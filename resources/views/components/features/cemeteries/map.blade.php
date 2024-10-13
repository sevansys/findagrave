<div
  x-cloak
  x-data="map({
    minZoom: 12,
    zoom: {{ $zoom }},
    center: @json($center),
    accessToken: '{{ $key }}',
    container: 'cemeteries-map',
  })"
  class="w-full h-[500px] max-h-[80vh] text-gray-600 bg-gray-100 border flex flex-col justify-center items-center relative"
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


@if($showInfo)
  <div class="flex flex-col gap-2 py-5">
    <div class="flex justify-between gap-5 items-centers flex-wrap">
      <div class="flex flex-wrap items-center gap-5">
        <span class="flex items-center gap-2">
          <span class="flex w-8 h-8 p-1.5 flex-shrink-0 bg-[#c60] text-white rounded-md">
            <x-shared.icons.cemetery></x-shared.icons.cemetery>
          </span>
          Cemetery
        </span>
        <span class="flex items-center gap-1">
          <span class="bg-[#c60] rounded-full text-sm h-6 w-6 md:w-8 md:h-8 text-white flex items-center justify-center">2</span>
          <span>More than one cemetery</span>
        </span>
      </div>

      <x-shared.checkbox
        label="Use current location"
      ></x-shared.checkbox>
    </div>
  </div>
@endif

