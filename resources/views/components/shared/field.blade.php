<label @class(['field relative inline-flex w-full', $clsx])>
  <input
    {!! $attrs !!}
    @required($required)
    @if($autofocus) autofocus @endif
    @if ($type) type="{{ $type }}" @endif
    @if ($name) name="{{ $name }}" @endif
    @if ($value) value="{{ $value }}" @endif
    @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
    placeholder="{{ $floatLabel ? '' : $label }}"
    @class([
      'px-4',
      'pb-2',
      'w-full',
      'h-full',
      'rounded-lg',
      'outline-none',
      'transition-shadow',
      'pt-6' => $isLabeled,
      'pt-2' => !$isLabeled,
      $fieldClsx
    ])
  />
  @if($isLabeled)
    <span class="field__label absolute px-4 py-1 truncate">{{ $label }}</span>
  @endunless
</label>
