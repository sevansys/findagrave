<div x-data="{ location: null, locationId: null }" class="flex gap-4">
  <div class="w-72">
    <x-shared.field
      name="name"
      class="bg-gray-50"
      label="Cemetery Name"></x-shared.field>
  </div>
  <div class="flex flex-1 flex-col gap-1">
    <x-shared.field
      name="location"
      x-bind:value='location'
      class="bg-gray-50"
      :label="$label"></x-shared.field>
    <input type="hidden" name="location_id" :value="locationId" />
    <div class="flex justify-between">
      <x-shared.dialog.browse-locations>
        <a class="link text-sm">Browse</a>
      </x-shared.dialog.browse-locations>

      @if($showHint)
        <span class="text-gray-600 text-sm">{{ $hint }}</span>
      @endif
    </div>
  </div>
  <div>
    <x-shared.btn
      variant="primary"
      class="rounded-md px-8"
      x-bind:disabled="!locationId"
      @click.prevent="cemeteriesIsNotFound=true">Search</x-shared.btn>
  </div>
</div>
