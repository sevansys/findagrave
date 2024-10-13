<div class="max-w-screen-xl flex flex-col md:flex-row items-center pt-4 md:pt-0 gap-2 md:gap-10 mx-auto w-full">
  <div class="w-full md:w-1/3 px-4 text-center md:text-left">
    <a href="#" class="text-primary inline-flex gap-1 py-1 px-3 border rounded-md border-[#5c60a3] hover:bg-[#5c60a3] hover:text-white">
      <span class="w-4 h-4 self-center">
        <x-shared.icons.gallery></x-shared.icons.gallery>
      </span>
        See all cemetery photos
    </a>
  </div>
  <menu class="flex-1 flex">
    @foreach($items as $item)
      <li>
        <a
          href="{{ $item['href'] }}"
          @class([
            'text-gray-600 border-b-transparent' => !($item['active'] ?? false),
            'text-[#5c60a3] font-semibold border-b-[#5c60a3]' => $item['active'] ?? false,
            'flex gap-2 items-center px-4 md:px-6 py-3 md:py-4 border-b-2 hover:bg-[#6e6c680d] transition-colors',
          ])
        >
          <span class="transparent uppercase">{{ $item['text'] }}</span>

          @if(!is_null($item['count']))
            <span class="grow-0 shrink-0 min-w-5 h-5 px-1 rounded-full bg-green-600 text-white text-xs flex items-center justify-center">
              {{ $item['count'] }}
            </span>
          @endif
        </a>
      </li>
    @endforeach
  </menu>
</div>
