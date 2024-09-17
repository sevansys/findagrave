<menu>
  @foreach($items as $item)
    <li class="hover:bg-gray-100 transition-colors flex flex-col">
      <a
        href="{{ $item['href'] }}"
        class="link font-medium text-lg leading-[-1px] py-0.5 px-1"
      >
        <span>{{ $item['text'] }}</span>
      </a>
      <span class="text-sm text-gray-500 px-1">Cemetery</span>
    </li>
  @endforeach
</menu>
