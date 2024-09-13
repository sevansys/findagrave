<label @class(['field relative inline-flex w-full', $clsx])>
  <input
    placeholder=""
    type="{{ $type }}"
    value="{{ $value }}"
    @class([
      'px-4',
      'pb-2',
      'pt-6',
      'w-full',
      'h-full',
      'rounded-lg',
      'outline-none',
      'transition-shadow',
      $fieldClsx
    ])
  />
  @unless(!$label)
    <span class="field__label absolute px-4 py-1 truncate">{{ $label }}</span>
  @endunless
</label>
