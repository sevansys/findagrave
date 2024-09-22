@props([
  'bordered' => true,
  'iconName' => null,
])

<div
  @class([
    'border-t' => $bordered,
    'py-2 flex gap-2 px-3 items-center',
  ])
>
  <span class="w-6 h-6 text-primary">
    @if(!empty($icon))
      {{ $icon }}
    @elseif (!empty($iconName))
      <x-dynamic-component
        :component="sprintf('shared.icons.%s', $iconName)"></x-dynamic-component>
    @endif
  </span>
  <div class="flex-1 text-sm">
    {{ $slot }}
  </div>
</div>
