<button
  type="{{ $type }}"
  @class([
    'btn p-3',
    'btn--lofty' => $lofty,
    'btn--' . $variant => $variant,
    $clsx,
  ])
>
  {{ $slot }}
</button>
