<div
  x-cloak
  x-data="map({
    minZoom: 12,
    zoom: {{ $zoom }},
    center: @json($center),
    accessToken: '{{ $key }}',
  })"
  class="w-full h-[500px] text-gray-600 bg-gray-100 border"
></div>

