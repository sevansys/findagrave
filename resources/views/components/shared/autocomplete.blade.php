@props([
  'name' => null,
  'params' => null,
  'baseUrl' => null,
  'suggestion' => null,
  'label' => 'Keywords',
  'suggestionIcon' => null,
  'textLimitHit' => 'Please enter at last 3 characters.',
])

<div
  class="relative flex flex-col w-full"
  x-data='autoComplete({
    baseUrl: "{{ $baseUrl }}",
    params: @json($params),
  })'
>
  <div
    @click.away="active=false; cursorIndex=-1"
    @keydown.escape="active=false; cursorIndex=-1"
    @keydown.enter="console.log('directly linking to: ', inputValue )"
  >
    <x-shared.field
      type="text"
      @blur="onBlur"
      :label="$label"
      @focus="onFocus"
      @input="isTyped=true"
      x-model.debounce.250ms="query"
    ></x-shared.field>

    <input type="hidden" name="{{ $name }}" :value="inputValue" />

    <div
      x-cloak
      class="relative"
      x-show="isSuggestionActive"
      x-transition:leave="transition ease-in duration-100"
      x-transition:enter="transition ease-out duration-200"
      x-transition:leave-end="opacity-0 transform scale-y-90"
      x-transition:enter-start="opacity-0 transform scale-y-90"
      x-transition:enter-end="opacity-100 transform scale-y-100"
      x-transition:leave-start="opacity-100 transform scale-y-100"
    >
      <div class="absolute top-1 mt-0.5 w-full max-h-60 overflow-y-auto border bg-white shadow-xl rounded z-10">
        <div class="py-1.5">
          <div x-show="query?.length < 3" class="p-3 text-neutral-500 text-sm">
            <i>{{ $textLimitHit }}</i>
          </div>
          <div x-show="query?.length >= 3" x-ref="list" class="flex flex-col">
            <div x-show="isLoading" class="flex py-2 px-3 justify-center">
              <x-shared.loading :size="20"></x-shared.loading>
            </div>

            <template x-for="(suggestion, index) in suggestions" :key="`suggestion.${index}`">
              @if($suggestion)
                {{ $suggestion }}
              @else
                <a
                  href="#"
                  @click.prevent="() => selectSuggestion(suggestion)"
                  x-bind:class="{
                    'border-t': index,
                    'bg-gray-200': isActive(suggestion),
                    'py-2 px-3 flex gap-2 w-full text-neutral-600 hover:bg-gray-100': true
                  }"
                >
                  @if($suggestionIcon)
                    <span class="w-5 h-5">
                      {{ $suggestionIcon }}
                    </span>
                  @endif
                  <span x-html="marked(suggestion.label)" class="flex-1"></span>
                </a>
              @endif
            </template>

            <div x-show="!isLoading" class="bg-gray-50 px-3 py-1 text-neutral-500 text-sm">
              <span x-html="suggestions.length"></span>
              results are available
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
