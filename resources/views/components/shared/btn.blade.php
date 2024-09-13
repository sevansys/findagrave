<button
  type="{{ $type }}"
  @class([
    'btn p-3',
    'btn--' . $variant => $variant,
    $clsx,
  ])
>
  {{ $slot }}
</button>
