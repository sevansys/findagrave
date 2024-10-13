<section class="max-w-screen-xl w-full mx-auto">
  <header class="py-5 border-b flex flex-raw flex-wrap gap-4 justify-between items-center px-2">
    <x-shared.btn variant="white" class="border rounded py-1 px-3">
      <span class="flex gap-2 items-center text-[#1775a5]">
        <span class="w-4 h-4 bg-[#1775a5] p-0.5 rounded-full text-white">
          <x-shared.icons.plus></x-shared.icons.plus>
        </span>
        Add Photos
      </span>
    </x-shared.btn>

    @if (count($items))
      <x-features.cemetery.photos-filter></x-features.cemetery.photos-filter>
    @endif
  </header>

  @unless(count($items))
    <div class="pt-8 text-center text-lg text-gray-400 px-2">
      <i>No photos yet</i>
    </div>
  @else
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 py-5 gap-1.5 md:gap-3 lg:gap-6 xl:gap-8 px-2">
      @foreach($items as $item)
        <div class="border rounded-md">
          <x-entities.cemetery.photo
            show-date
            :target="$item"
            :alt="$target->name"></x-entities.cemetery.photo>
        </div>
      @endforeach
    </div>
  @endif
</section>
