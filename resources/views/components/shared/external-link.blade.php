<a
  target="_blank"
  href="{{ $href }}"
  @class([
    'link flex gap-0.5',
    $clsx,
  ])
>
  {{ $slot }}
  <span class="w-4 h-4 mt-0.5">
    <x-shared.icons.external></x-shared.icons.external>
  </span>
</a>