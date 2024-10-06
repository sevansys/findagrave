<x-entities.cemetery.contact-info icon-name="location" :bordered="false">
  <div class="flex flex-col gap-2">
    <div class="flex flex-col">
      <x-shared.get-directions
        :latitude="$target->latitude"
        :longitude="$target->longitude"></x-shared.get-directions>
      <span>{{ $target->address }}</span>
    </div>
    <div>
      @if(!$hasCoordinates)
        No coordinates
      @else
        <span>Coordinates:</span>
        <span class="latitude">{{ $target->latitude }},</span>
        <span class="longitude">{{ $target->longitude }}</span>
      @endif
    </div>
  </div>
</x-entities.cemetery.contact-info>
