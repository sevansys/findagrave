<a
  href="{{ $href ?? '#' }}"
  class="flex flex-col p-2 gap-2 text-primary items-center"
>
  <span class="w-12 h-12 md:w-14 md:h-14">
    @if(!empty($icon))
      {{ $icon }}
    @elseif($iconName)
      {!! Blade::render(sprintf(
          '<x-shared.icons.%s />',
          $iconName
      )) !!}
    @endif
  </span>
  <span>
    {{ $slot }}
  </span>
</a>
