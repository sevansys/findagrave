@props([
  'latitude' => null,
  'longitude' => null,
])

<x-shared.external-link
  clsx="font-semibold"
  :href="sprintf('https://www.google.com/maps/dir/?api=1&destination=%s,%s', $latitude, $longitude)">
  Get Directions
</x-shared.external-link>
