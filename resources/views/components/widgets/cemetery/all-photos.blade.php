<section class="max-w-screen-xl w-full mx-auto">
  <header class="py-5 border-b flex justify-between items-center">
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
    <div class="pt-8 text-center text-lg text-gray-400">
      <i>No photos yet</i>
    </div>
  @else
    <div class="grid grid-cols-4 py-5 gap-8">
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
