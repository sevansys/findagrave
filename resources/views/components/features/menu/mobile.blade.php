<menu class="flex flex-col gap-5 py-10 px-10">
  @foreach($items as $item)
    <li>
      <a
        href="{{ route($item['name']) }}"
        class="flex text-[#f9dedd] hover:white transition-colors hover:border-white border-b text-2xl border-b-[#9da0c8] px-3 py-3"
      >
        {{ $item['label'] }}
      </a>
    </li>
  @endforeach
</menu>
