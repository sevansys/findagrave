<div
  {{ $attributes->merge([
    'class' => 'relative md:flex-1 flex border-l h-cemetery-map w-full'
  ]) }}
  x-data="map({
    maxZoom: 15,
    minZoom: 7,
    container: 'map',
    zoom: {{ $zoom }},
    style: '{{ $style }}',
    accessToken: '{{ $key }}',
    center: [{{ $longitude }}, {{ $latitude }}],
    cemeteries: [
      {
        name: '{{ $target->name }}',
        latitude: {{ $latitude }},
        longitude: {{ $longitude }},
        memorialsCount: 0,
      }
    ],
  })"
>
  <div id="map" class="w-full md:h-full"></div>

  <template id="cemetery-marker-template">
    <span class="flex w-10 h-10 p-2 bg-[#c60] text-white rounded-md">
      <x-shared.icons.cemetery></x-shared.icons.cemetery>
    </span>
  </template>
  <template id="cemetery-popover-template">
    <div class="flex flex-col gap-4 text-xs p-2">
      <h4>{{ $target->name }}</h4>
      <div class="flex gap-1 items-center justify-center">
        <span class="w-4 h-4">
          <x-shared.icons.global></x-shared.icons.global>
        </span>
        <span>
          {{$target->latitude}}, {{$target->longitude}}
        </span>
      </div>

      <x-shared.get-directions
        :latitude="$target->latitude"
        :longitude="$target->longitude"
      >Get direction</x-shared.get-directions>
    </div>
  </template>

  <nav class="absolute top-0 right-10 z-10 px-1.5 md:px-3 py-2 flex items-center gap-1 md:gap-3">
    <div class="flex gap-3 bg-white rounded-full py-2 px-3 text-sm">
      <x-shared.switcher>
        <span class="flex">
          <span class="border border-white w-4 h-4 rounded-full bg-[#fdb32b]"></span>
          <span class="border border-white w-4 h-4 rounded-full bg-[#dd1c80] -ml-2"></span>
        </span>
        <span class="hidden lg:inline-block">Memorials</span>
      </x-shared.switcher>
      <x-shared.switcher>
        <span class="w-4 h-4 text-green-600">
          <x-shared.icons.location></x-shared.icons.location>
        </span>
        <span class="hidden lg:inline-block">Cemetery</span>
      </x-shared.switcher>
    </div>

    <div class="flex rounded-md border border-[#5c60a3] overflow-hidden">
      @foreach($styles as $style)
        <a
          href="#"
          @click.prevent="updateStyle('{{ $style['value'] }}')"
          class="px-2 py-0.5 flex items-center"
          :class="{
            'bg-white text-[#5c60a3]': style !== '{{ $style['value'] }}',
            'bg-[#5c60a3] text-white': style === '{{ $style['value'] }}',
          }">
          <span class="block md:hidden w-5 h-5">
            <x-dynamic-component
              :component="sprintf('shared.icons.%s', $style['icon'])"
            ></x-dynamic-component>
          </span>
          <span class="hidden md:block">{{ $style['label'] }}</span>
        </a>
      @endforeach
    </div>
  </nav>
</div>
