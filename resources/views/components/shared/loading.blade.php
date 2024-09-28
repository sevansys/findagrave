@props([
  'size' => null,
  'color' => null,
])

@php
if (is_numeric($size)) {
  $size = "{$size}px";
}
@endphp

<div class="loader" @style([
  "--loader-size: $size" => $size,
  "--loader-color: $color" => $color,
])></div>
