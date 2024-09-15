<label @class(['field relative inline-flex w-full', $clsx])>
  <input
    placeholder=""
    @required($required)
    @if($autofocus) autofocus @endif
    @if ($type) type="{{ $type }}" @endif
    @if ($name) name="{{ $name }}" @endif
    @if ($value) value="{{ $value }}" @endif
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
