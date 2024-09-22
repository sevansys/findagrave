<div class="max-w-screen-xl flex gap-10 mx-auto">
  <div class="w-1/3"></div>
  <nav class="flex-1">
    <menu class="flex">
      @foreach($items as $item)
        <li>
          <a
            href="{{ $item['href'] }}"
            @class([
              'text-gray-600 border-b-transparent' => !($item['active'] ?? false),
              'text-[#5c60a3] font-semibold border-b-[#5c60a3]' => $item['active'] ?? false,
              'flex gap-2 items-center px-6 py-4 border-b-2 hover:bg-[#6e6c680d] transition-colors',
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
  </nav>
</div>
