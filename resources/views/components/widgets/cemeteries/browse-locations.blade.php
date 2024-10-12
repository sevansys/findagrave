<div class="flex gap-10 flex-col md:flex-row">
  <div class="flex flex-col flex-1">
    @if($hasItems)
      <x-features.locations.browse-items
        :location="$target"></x-features.locations.browse-items>
      <x-features.cemeteries.browse-items
        :location="$target"></x-features.cemeteries.browse-items>
    @else
      <b>No results found right now.</b>
    @endif
  </div>

  <aside class="w-full md:w-80">
    <x-shared.content-ad></x-shared.content-ad>
  </aside>
</div>
