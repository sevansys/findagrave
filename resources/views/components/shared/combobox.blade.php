@props([
  'id' => null,
  'name' => null,
  'options' => [],
  'label' => null,
  'required' => false,
  'notFoundText' => 'No matches found',
])

@empty($id)
  @php $id = 'combobox=-' . Str::random(5) @endphp
@endif

<div
  x-data='combobox({
    allOptions: @json($options),
  })'
  class="flex w-full flex-col gap-1"
  x-on:keydown="handleKeydownOnOptions($event)"
  x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
  @isset($label)
    <label
      for="{{ $id }}"
      class="w-fit pl-0.5 text-sm text-neutral-600"
    >{{ $label }}</label>
  @endisset
  <div class="relative">
    <button
      type="button"
      role="combobox"
      aria-haspopup="listbox"
      aria-controls="makesList"
      x-on:click="isOpen = ! isOpen"
      x-bind:aria-expanded="isOpen || openedWithKeyboard"
      x-on:keydown.down.prevent="openedWithKeyboard = true"
      x-on:keydown.enter.prevent="openedWithKeyboard = true"
      x-on:keydown.space.prevent="openedWithKeyboard = true"
      x-bind:aria-label="selectedOption ? selectedOption.value : 'Please Select'"
      {{ $attributes->merge([
        'class' => 'inline-flex w-full items-center justify-between gap-2 border border-neutral-300 rounded-lg bg-white px-4 py-2 text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black'
      ]) }}
    >
      <span
        class="text-sm font-normal"
        x-text="selectedOption ? selectedOption.label : 'Please Select'"></span>
      <svg
        class="size-5"
        aria-hidden="true"
        viewBox="0 0 20 20"
        fill="currentColor"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
        />
      </svg>
    </button>

    <input
      type="hidden"
      id="{{ $id }}"
      name="{{ $name }}"
      @required($required)
      x-ref="hiddenTextField"
    />
    <div
      x-transition
      id="makesList"
      role="listbox"
      x-trap="openedWithKeyboard"
      aria-label="industries list"
      x-show="isOpen || openedWithKeyboard"
      x-on:keydown.down.prevent="$focus.wrap().next()"
      x-on:keydown.up.prevent="$focus.wrap().previous()"
      x-on:click.outside="isOpen = false, openedWithKeyboard = false"
      class="absolute left-0 top-11 z-10 w-full overflow-hidden rounded-md border border-neutral-300 bg-white"
    >
      <div class="relative">
        <svg
          fill="none"
          stroke-width="1.5"
          aria-hidden="true"
          viewBox="0 0 24 24"
          stroke="currentColor"
          xmlns="http://www.w3.org/2000/svg"
          class="absolute left-4 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
          />
        </svg>
        <input
          type="text"
          name="searchField"
          x-ref="searchField"
          aria-label="Search"
          placeholder="Search"
          x-on:input="getFilteredOptions($el.value)"
          class="w-full border-b borderneutral-300 bg-neutral-50 py-2.5 pl-11 pr-4 text-sm text-neutral-600 focus:outline-none focus-visible:border-black disabled:cursor-not-allowed disabled:opacity-75"
        />
      </div>

      <ul class="flex max-h-44 flex-col overflow-y-auto">
        <li
          x-ref="noResultsMessage"
          class="hidden px-4 py-2 text-sm text-neutral-600"
        >
          <span>{{ $notFoundText }}</span>
        </li>
        <template
          x-for="(item, index) in options"
          x-bind:key="item.value"
        >
          <li
            role="option"
            x-on:click="setSelectedOption(item)"
            x-bind:id="'option-' + index" tabindex="0"
            x-on:keydown.enter="setSelectedOption(item)"
            class="combobox-option inline-flex cursor-pointer justify-between gap-6 bg-white px-4 py-2 text-sm text-neutral-600 hover:bg-neutral-900/5 hover:text-neutral-900 focus-visible:bg-neutral-900/5 focus-visible:text-neutral-900 focus-visible:outline-none"
          >
            <span
              x-text="item.label"
              x-bind:class="selectedOption == item ? 'font-bold' : null"
            ></span>
            <span
              class="sr-only"
              x-text="selectedOption == item ? 'selected' : null"
            ></span>
            <svg
              fill="none"
              class="size-4"
              stroke-width="2"
              aria-hidden="true"
              viewBox="0 0 24 24"
              stroke="currentColor"
              xmlns="http://www.w3.org/2000/svg"
              x-cloak x-show="selectedOption == item"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m4.5 12.75 6 6 9-13.5"
              />
            </svg>
          </li>
        </template>
      </ul>
    </div>
  </div>
</div>
