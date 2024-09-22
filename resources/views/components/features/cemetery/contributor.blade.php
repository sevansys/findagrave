<div class="flex flex-col py-5">
  <x-features.cemetery.partials.contributor-progress-graphic
    :value="20"></x-features.cemetery.partials.contributor-progress-graphic>

  <div class="flex flex-col gap-1 items-center">
    <span class="flex gap-1 items-center text-primary">
      <span class="w-6 h-6">
        <x-shared.icons.grave></x-shared.icons.grave>
      </span>
      <span class="text-lg font-bold">
        @if($target->memeorialsCount)
          {{ $target->memeorialsCount }} Memorials
        @else
          No Memorials
        @endif
      </span>
    </span>
    <a href="#" class="flex gap-1 items-center text-[#c60] hover:underline hover:text-[#8f4903] transition-colors">
      <span class="w-6 h-6">
        <x-shared.icons.camera></x-shared.icons.camera>
      </span>
      <span class="">
        {{ $photographed }}
        photographed
      </span>
    </a>
    <a href="#" class="flex gap-1 items-center text-[#328800] hover:underline hover:text-[#296a03] transition-colors">
      <span class="w-6 h-6">
        <x-shared.icons.gps></x-shared.icons.gps>
      </span>
      <span>
        {{ $withGPS }}
        with gps
      </span>
    </a>
  </div>
</div>
