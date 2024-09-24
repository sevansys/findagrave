<button type="{{ $type }}" {{
  $attributes->merge([
    'class' => \Arr::toCssClasses($clsx)
  ])
}}>
  {{ $slot }}
</button>
