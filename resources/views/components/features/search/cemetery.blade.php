<form
  {{ $attributes->merge([
    'class' => 'flex gap-4'
  ]) }}
  action="{{ $action }}"
  x-data="searchCemetery"
>
  <div class="flex flex-col">
    <x-shared.autocomplete
      ref="cemetery"
      name="cemetery"
      value-name="cemetery_id"
      :label="$namePlaceholder"
      base-url="/cemeteries/autocomplete"
      :value="request()->get('cemetery')"
      :input-value="request()->get('cemetery-id')"
    >
      <x-slot name="suggestionIcon">
        <x-shared.icons.cemetery></x-shared.icons.cemetery>
      </x-slot>
    </x-shared.autocomplete>
  </div>
  <div class="flex flex-1 flex-col gap-1">
    <x-shared.autocomplete
      ref="location"
      name="location"
      :label="$label"
      value-name="location_id"
      base-url="/locations/autocomplete"
      :value="request()->get('location')"
      :input-value="request()->get('location-id')"
      :params="[
        'types' => $selectedTypes,
      ]"
    >
      <x-slot name="suggestionIcon">
        <x-shared.icons.location></x-shared.icons.location>
      </x-slot>
    </x-shared.autocomplete>

    <div class="flex justify-between">
      <a
        href="#"
        class="link text-sm"
        x-dialog.browse-locations="{ onSelect: onDialogSelect.bind($data) }"
      >{{ $browseText }}</a>

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
    >
      {{ $actionText }}
    </x-shared.btn>
  </div>
</form>
