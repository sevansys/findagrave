<div class="flex flex-col md:flex-row hover:bg-gray-100 border-b py-2">
  <a href="{{ $href }}" class="flex flex-1 items-center gap-4 px-4 p-2 text-[#1775a5] hover:text-[#995c1d]">
    <picture class="w-20 h-20 flex-shrink-0 flex-grow-0 border">
      @if(empty($image))
        <span class="p-3 block text-gray-600 bg-gray-100">
          <x-shared.icons.grave></x-shared.icons.grave>
        </span>
      @else
        <img src="{{ $image }}" alt="{{ $name }}" class="w-full h-full object-contain object-center" />
      @endif
    </picture>
    <div>
      <h3 class="text-xl">{{ $name }}</h3>
      <div class="flex flex-wrap gap-2 leading-none text-gray-600 text-sm">
        <address>{{ $address }}</address>

        @if($withoutGps)
          <span>– *No GPS coordinates</span>
        @endif
      </div>
    </div>
  </a>
  <div class="flex justify-center p-2">
    <div class="flex flex-col">
      @if($withPhotoRequestsCount)
        <a href="#" class="link flex gap-1 items-center">
          <span class="w-5 h-5">
            <x-shared.icons.grave></x-shared.icons.grave>
          </span>
          {{ $withPhotoRequestsCount }} requests
        </a>
      @endif

      @if($withMemorialsCount)
        <a href="#" class="link flex gap-1 items-center">
          <span class="w-5 h-5">
            <x-shared.icons.monument></x-shared.icons.monument>
          </span>
          {{ $withMemorialsCount }} memorials
        </a>
      @endif

      @if($withGpsCount)
        <a href="#" class="link flex gap-1 items-center">
          <span class="w-5 h-5">
            <x-shared.icons.gps></x-shared.icons.gps>
          </span>
          {{ $withGpsCount }} with GPS
        </a>
      @endif
    </div>
  </div>
</div>
