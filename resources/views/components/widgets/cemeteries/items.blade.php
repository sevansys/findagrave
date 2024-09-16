<section
  x-data="cemeteriesWidget"
  class="max-w-screen-xl w-full mx-auto">
  <div class="flex gap-10">
    <div class="flex flex-col gap-4 flex-1">
      <header class="flex justify-between border-b pb-2">
        <h2 class="text-primary font-medium text-2xl">Cemeteries - <span x-html="viewLabel"></span></h2>
        <a
          x-clock href="#"
          @click.prevent="toggle"
          class="flex text-primary p-1.5 transition-colors ease-in rounded hover:text-white hover:bg-[#5c60a3]">
          <span x-show="isMapView" class="w-6 h-6">
            <x-shared.icons.map></x-shared.icons.map>
          </span>
          <span x-show="isListView" class="w-6 h-6">
            <x-shared.icons.list></x-shared.icons.list>
          </span>
        </a>
      </header>

      <div x-clock>
        <div x-show="isMapView">
          <x-features.cemeteries.map></x-features.cemeteries.map>
        </div>
        <div x-show="isListView">
          <x-features.cemeteries.list-items></x-features.cemeteries.list-items>
        </div>
      </div>

      <p class="text-gray-600">
        Find a Grave currently contains information from over 580,095 cemeteries in over 249 different countries.
      </p>
    </div>
    <aside class="w-96 flex flex-col gap-4">
      @if(!empty($aside))
        {{ $aside }}
      @endif
    </aside>
  </div>
</section>
