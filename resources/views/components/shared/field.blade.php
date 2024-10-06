<div class="flex flex-col gap-1 w-full">
  <label
    @class([
      'field relative inline-flex w-full flex-col',
      'field--errors' => $isHasErrors,
      $clsx
    ])
  >
    @switch($type)
      @case('textarea')
        <textarea
          {!! $attrs !!}
          cols="{{ $cols }}"
          rows="{{ $rows }}"
          @required($required)
          @if($autofocus) autofocus @endif
          @if ($name) name="{{ $name }}" @endif
          @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
          placeholder="{{ $floatLabel ? '' : $label }}"
          {{ $attributes->merge([
            'class' => Arr::toCssClasses($fieldClsx),
          ]) }}>{{ $value }}</textarea>
          @break
      @default
        <input
          {!! $attrs !!}
          @required($required)
          @if($autofocus) autofocus @endif
          @if ($type) type="{{ $type }}" @endif
          @if ($name) name="{{ $name }}" @endif
          @if ($value) value="{{ $value }}" @endif
          @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
          placeholder="{{ $floatLabel ? '' : $label }}"
          {{ $attributes->merge([
            'class' => Arr::toCssClasses($fieldClsx),
          ]) }}
        />
        @break
    @endswitch

    @if($isLabeled)
      <span class="field__label absolute px-4 py-1 text-sm text-gray-800 truncate">{{ $label }}</span>
    @endif
  </label>

  @if($showErrors && !empty($isHasErrors))
    <x-shared.errors :items="$fieldErrors"></x-shared.errors>
  @endif
</div>
