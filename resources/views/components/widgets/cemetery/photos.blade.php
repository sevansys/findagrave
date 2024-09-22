<x-shared.widget title="Photos">
  <div class="p-4 flex gap-3 flex-col items-center">
    @unless(count($images))
      <i class="text-gray-600">No additional photos.</i>
      <x-shared.btn
        :filled="false"
        clsx="flex items-center gap-2 rounded-md py-1.5 bg-white border"
      >
        <span class="w-4 h-4 p-0.5 rounded-full bg-[#5c60a3] text-white">
          <x-shared.icons.plus></x-shared.icons.plus>
        </span>
        Add Photos
      </x-shared.btn>
    @else
      <div class="flex gap-6 items-stretch">
        @foreach($images as $img)
          <div class="w-1/2">
            <x-entities.cemetery.photo
              :target="$img"
              :alt="$target->name"></x-entities.cemetery.photo>
          </div>
        @endforeach
      </div>

      @if($more > 0)
        <a
          href="{{ $moreHref }}"
          class="px-4 py-1 flex border text-sm bg-transparent rounded-md border-[#5c60a3] text-[#5c60a3] hover:text-white hover:bg-[#5c60a3] transition-colors"
        >
          See {{ $more }} more
        </a>
      @endif
    @endif
  </div>
</x-shared.widget>
