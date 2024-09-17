<div class="flex gap-10">
  <div class="flex flex-col flex-1">
    <x-features.locations.browse-items
      :location="$target"></x-features.locations.browse-items>
    <x-features.cemeteries.browse-items
      :location="$target"></x-features.cemeteries.browse-items>
  </div>

  <aside class="w-80">
    <x-shared.content-ad></x-shared.content-ad>
  </aside>
</div>
