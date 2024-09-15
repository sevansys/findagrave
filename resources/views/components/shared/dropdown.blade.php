<div @class([
  'dropdown',
  'inline-flex',
  'justify-center',
  $clsx,
])>
  <div
    x-bind="bindRoot"
    class="relative w-full h-full"
    x-data="dropdown({ value: '{{ $value  }}', placeholder: '{{ $placeholder }}' })"
  >
    <select x-ref="select" name="{{ $name }}" hidden="hidden" x-bind:value="value">
      @foreach($options as $option)
        <option value="{{ $option['value'] }}">
          {{ $option['label'] }}
        </option>
      @endforeach
    </select>

    <label
      x-bind="bindActivator"
      class="flex w-full h-full cursor-pointer max-w-full dropdown__activator"
    >
      @if($slot->isNotEmpty())
        {{ $slot }}
      @else
        <span class="default-activator flex gap-2 bg-white px-4 py-2 justify-between rounded-lg w-full max-w-full">
          <span class="flex flex-1 flex-col max-w-full">
            @if($label)
              <span class="text-xs text-gray-500 truncate">{{ $label }}</span>
            @endif

            <span x-html="selectedLabel" class="block max-w-full truncate"></span>
          </span>

          <span class="self-center flex-none">
            <span class="flex w-5 h-5">
              <x-shared.icons.arrow-down></x-shared.icons.arrow-down>
            </span>
          </span>
        </span>
      @endunless
    </label>

    <div
      x-bind="bindPanel"
      style="display: none;"
      @class([
        'w-40',
        'z-20',
        'mt-1.5',
        'left-0',
        'absolute',
        'bg-white',
        'shadow-md',
        'rounded-md',
        'w-full' => $fluid,
      ])
    >
      @foreach($options as $option)
        <a
          href="#"
          x-bind="bindOption('{{ $option['value'] }}')"
          class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2 text-left text-sm hover:bg-gray-50 disabled:text-gray-500 text-nowrap"
        >
          {{ $option['label']  }}
        </a>
      @endforeach
    </div>
  </div>
</div>
