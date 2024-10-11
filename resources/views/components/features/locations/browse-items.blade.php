<menu class="flex flex-col gap-0.5">
  @foreach($items as $item)
    <li class="hover:bg-gray-100 transition-colors">
      <a
        class="link leading-none font-medium text-lg py-0.5 px-1"
        href="{{ $item['href'] }}">
        {{ $item['text'] }}
      </a>
    </li>
  @endforeach
</menu>
