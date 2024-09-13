<div @class(['inline-flex justify-center', $clsx])>
  <div
    class="relative w-full h-full"
    x-data="{
      open: false,
      value: '{{ $value }}',
      placeholder: '{{ $placeholder }}',
      toggle() {
        if (this.open) {
          return this.close()
        }

        this.$refs.button.focus()
        this.open = true
      },
      close(focusAfter) {
        if (!this.open) {
          return;
        }

        this.open = false;
        focusAfter && focusAfter.focus();
      },
      select(value) {
        this.value = value;
        this.close();
      },
      get selectedLabel() {
        return Array.from(this.$refs.select.options).find((option) => {
          return option.value === this.value
        })?.label ?? this.placeholder;
      }
    }"
    x-id="['dropdown-button']"
    x-on:keydown.escape.prevent.stop="close($refs.button)"
    x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
  >
    <select x-ref="select" name="{{ $name }}" hidden="hidden" x-bind:value="value">
      @foreach($options as $option)
        <option value="{{ $option['value'] }}">
          {{ $option['label'] }}
        </option>
      @endforeach
    </select>

    <label
      x-ref="button"
      :aria-expanded="open"
      x-on:click.prevent="toggle()"
      :aria-controls="$id('dropdown-button')"
      class="flex w-full h-full cursor-pointer"
    >

      @if($slot->isNotEmpty())
        {{ $slot }}
      @else
        <span class="flex gap-1 bg-white px-4 py-2 justify-between rounded-lg w-full overflow-hidden max-w-full">
          <span class="flex flex-col">
            @if($label)
              <span class="text-xs text-gray-500 truncate">{{ $label }}</span>
            @endif

            <span x-html="selectedLabel" class="truncate"></span>
          </span>

          <span class="self-center">
            <x-shared.icons.arrow-down></x-shared.icons.arrow-down>
          </span>
        </span>
      @endunless
    </label>

    <div
      x-ref="panel"
      x-show="open"
      style="display: none;"
      :id="$id('dropdown-button')"
      x-transition.origin.top.left
      x-on:click.outside="close($refs.button)"
      class="absolute left-0 mt-2 w-40 rounded-md bg-white shadow-md z-20"
    >
      @foreach($options as $option)
        <a href="#"
           class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2 text-left text-sm hover:bg-gray-50 disabled:text-gray-500 text-nowrap"
           x-on:click.prevent="select('{{ $option['value'] }}')"
        >
          {{ $option['label']  }}
        </a>
      @endforeach
    </div>
  </div>
</div>
