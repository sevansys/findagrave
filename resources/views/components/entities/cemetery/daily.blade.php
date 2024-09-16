<p class="text-center text-white text-sm m-0 p-1.5 flex justify-center gap-2">
  Photo of
  <a href="{{ $href ?? '#' }}"
     class="text-white hover:text-white hover:underline font-bold">
    {{ $name }}
  </a>

  @if(!empty($author))
    by
    <a href="{{ $author['href'] }}"
       class="text-white hover:text-white hover:underline font-bold">
      {{ $author['name'] }}
    </a>
  @endif
</p>
