<div
  x-data="map({
    zoom: {{ $zoom }},
    accessToken: '{{ $key }}',
    center: [{{ $longitude }}, {{ $latitude }}]
  })"
  class="w-full h-[500px] text-gray-600 items-center justify-center bg-gray-100 border flex italic"
></div>

