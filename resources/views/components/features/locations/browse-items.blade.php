<menu class="flex flex-col">
  @foreach($items as $item)
    <li class="hover:bg-gray-100 transition-colors">
      <a
        class="link font-medium text-lg leading-[-1px] py-0.5 px-1"
        href="{{ $item['href'] }}">
        {{ $item['text'] }}
      </a>
    </li>
  @endforeach
</menu>
