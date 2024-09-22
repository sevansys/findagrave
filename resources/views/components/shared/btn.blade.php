<button
  type="{{ $type }}"
  @class([
    'btn p-3',
    'btn--lofty' => $lofty,
    'btn--filled' => $filled,
    'btn--outlined' => $outlined,
    'btn--' . $variant => $variant,
    $clsx,
  ])
>
  {{ $slot }}
</button>
