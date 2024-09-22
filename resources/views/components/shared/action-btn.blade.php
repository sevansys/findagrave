<a
  href="#"
  @class([
    'border py-1 px-3 rounded flex gap-1 items-center transition-colors',
    $clsx,
  ])
>
  <span class="w-4 h-4">
    @empty($icon)
      @if(!empty($iconName))
        {!!
          Blade::render(
            sprintf('<x-shared.icons.%s />', $iconName)
          )
        !!}
      @endif
    @else
      {{ $icon }}
    @endif
  </span>
  {{ $slot }}
</a>
