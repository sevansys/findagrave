<nav class="flex flex-wrap leading-tight gap-1 items-center">
  @foreach($items as $index => $item)
    @if ($item['href'])
      <a class="link"
         href="{{ $item['href'] }}"
         @if($item['target']) target="{{ $item['target'] }}" @endif
      >
        {{ $item['text'] }}
      </a>
    @else
      <span>{{ $item['text'] }}</span>
    @endif

    @if($count !== $index + 1)
      <span class="w-4 h-4 flex-shrink-0">
        <x-shared.icons.arrow-right></x-shared.icons.arrow-right>
      </span>
    @endif
  @endforeach
</nav>
