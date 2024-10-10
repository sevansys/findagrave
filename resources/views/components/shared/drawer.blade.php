@props([
  'bg' => 'white',
  'opacity' => 100,
  'isOpen' => false,
  'bodyClsx' => null,
  'name' => 'mobile-menu',
])

<div
  x-cloak
  x-show="show"
  x-data="drawer({
    name: '{{ $name }}',
    show: {{ $isOpen ? 'true' : 'false' }},
  })"
  {{ $attributes->merge([
    'class' => 'fixed w-full h-full overflow-hidden inset-0 z-20'
  ]) }}
>
  <div
    x-cloak
    x-show="show"
    aria-hidden="true"
    @click="() => close()"
    x-transition:leave-end="opacity-0"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:enter="transition ease-out duration-300 transform"
    class="fixed inset-0 transition-opacity bg-black bg-opacity-40"
  ></div>
  <div
    x-show="show"
    @class([
      'h-full absolute w-[90%] sm:w-2/3 md:w-1/2 overflow-y-auto',
      $bodyClsx,
    ])
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-200 transform"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
  >
    {{ $slot }}
  </div>
</div>
