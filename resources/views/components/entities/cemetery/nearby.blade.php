<div class="flex gap-2 md:gap-4">
  @if($image)
    <a href="{{ $href }}">
      <picture class="w-20 h-20 flex border items-center justify-center">
          <img src="{{ $image->source_url }}" alt="{{ $name }}" class="w-full h-full object-contain object-center" />
      </picture>
    </a>
  @else
    <span class="w-10 h-10">
      <x-shared.icons.grave></x-shared.icons.grave>
    </span>
  @endif
  <div class="flex flex-col gap-1 flex-1">
    <div class="flex flex-col gap-0.5">
      <a href="{{ $href }}" class="link self-start">
        <h4 class="text-lg">{{ $name }}</h4>
      </a>
      <address class="text-gray-700">{{ $address }}</address>
    </div>
    <div class="flex gap-3 text-gray-600">
      <span class="flex items-center gap-0.5">
        <span class="w-4 h-4">
          <x-shared.icons.grave></x-shared.icons.grave>
        </span>
        <span>
          1
        </span>
      </span>
      <span class="flex items-center gap-0.5">
        <span class="w-4 h-4">
          <x-shared.icons.camera></x-shared.icons.camera>
        </span>
        <span>0%</span>
      </span>
      <span class="flex items-center gap-0.5">
        <span class="w-4 h-4">
          <x-shared.icons.gps></x-shared.icons.gps>
        </span>
        <span>0%</span>
      </span>
    </div>
  </div>
  @if ($isWithoutGps)
    <div class="grow-0 self-center">
      <span class="flex w-6 h-6 opacity-50">
        <x-shared.icons.unknown-gps></x-shared.icons.unknown-gps>
      </span>
    </div>
  @endif
</div>
