<form
  {{ $attributes->merge([
    'class' => 'flex gap-4'
  ]) }}
>
  <div class="w-72">
    <x-shared.autocomplete
      name="cemetery"
      base-url="/cemeteries/autocomplete"
      :label="$namePlaceholder"
    >
      <x-slot name="suggestionIcon">
        <x-shared.icons.cemetery></x-shared.icons.cemetery>
      </x-slot>
    </x-shared.autocomplete>
  </div>
  <div class="flex flex-1 flex-col gap-1">
    <x-shared.autocomplete
      name="location"
      :label="$label"
      :params="[
        'types' => $selectedTypes,
      ]"
      base-url="/locations/autocomplete"
    >
      <x-slot name="suggestionIcon">
        <x-shared.icons.location></x-shared.icons.location>
      </x-slot>
    </x-shared.autocomplete>

    <div class="flex justify-between">
      <x-shared.dialog.browse-locations>
        <a class="link text-sm">{{ $browseText }}</a>
      </x-shared.dialog.browse-locations>

      @if($showHint)
        <span class="text-gray-600 text-sm">{{ $hint }}</span>
      @endif
    </div>
  </div>

  <div>
    <x-shared.btn
      type="submit"
      variant="primary"
      class="rounded-md px-8"
      x-bind:disabled="!locationId"
      @click.prevent="cemeteriesIsNotFound=true">
      {{ $actionText }}
    </x-shared.btn>
  </div>
</form>
