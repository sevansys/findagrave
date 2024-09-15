<a href="{{ $href ?? '#' }}" class="flex flex-col p-2 gap-2 text-primary items-center">
  <span class="w-14 h-14">
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
