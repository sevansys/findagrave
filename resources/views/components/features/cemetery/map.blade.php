<div
  class="relative flex-1 flex border-l w-full h-full"
  x-data="map({
    maxZoom: 15,
    minZoom: 13,
    container: 'map',
    zoom: {{ $zoom }},
    style: '{{ $style }}',
    accessToken: '{{ $key }}',
    center: [{{ $longitude }}, {{ $latitude }}],
  })"
>
  <div id="map" class="w-full h-full"></div>
  <nav class="absolute top-0 right-10 z-10 px-3 py-2 flex items-center gap-3">
    <div class="flex gap-3 bg-white rounded-full py-2 px-3 text-sm">
      <x-shared.switcher>
        <span class="flex">
          <span class="border border-white w-4 h-4 rounded-full bg-[#fdb32b]"></span>
          <span class="border border-white w-4 h-4 rounded-full bg-[#dd1c80] -ml-2"></span>
        </span>
        Memorials
      </x-shared.switcher>
      <x-shared.switcher>
        <span class="w-4 h-4 text-green-600">
          <x-shared.icons.location></x-shared.icons.location>
        </span>
        Cemetery
      </x-shared.switcher>
    </div>

    <div class="flex rounded-md border border-[#5c60a3] overflow-hidden">
      @foreach($styles as $style)
        <a
          href="#"
          @click.prevent="updateStyle('{{ $style['value'] }}')"
          class="px-2 py-0.5"
          :class="{
            'bg-white text-[#5c60a3]': style !== '{{ $style['value'] }}',
            'bg-[#5c60a3] text-white': style === '{{ $style['value'] }}',
          }">
          {{ $style['label'] }}
        </a>
      @endforeach
    </div>
  </nav>
</div>
