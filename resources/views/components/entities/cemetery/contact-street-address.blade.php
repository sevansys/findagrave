<x-entities.cemetery.contact-info icon-name="location" :bordered="false">
  <div class="flex flex-col gap-2">
    <div class="flex flex-col">
      <x-shared.external-link href="#" clsx="font-bold">
        Get directions
      </x-shared.external-link>
      <span>{{ $target->address }}</span>
    </div>
    <div>
      <span>Coordinates:</span>
      <span class="latitude">{{ $target->latitude }},</span>
      <span class="longitude">{{ $target->longitude }}</span>
    </div>
  </div>
</x-entities.cemetery.contact-info>
