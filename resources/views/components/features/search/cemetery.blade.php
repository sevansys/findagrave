<form action="" class="flex gap-4">
  <div class="w-72">
    <x-shared.field
      name="name"
      label="Cemetery Name"></x-shared.field>
  </div>
  <div class="flex flex-1 flex-col gap-1">
    <x-shared.field
      name="location"
      label="Cemetery Location (City, County, State, or Country)"></x-shared.field>

    <div class="flex justify-between">
      <x-shared.dialog.browse-locations>
        <a class="link text-sm">Browse</a>
      </x-shared.dialog.browse-locations>

      <span class="text-gray-600 text-sm">*Only displays locations with cemeteries</span>
    </div>
  </div>
  <div>
    <x-shared.btn variant="primary" clsx="rounded-md px-8">Search</x-shared.btn>
  </div>
</form>