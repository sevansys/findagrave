@props([
  'placeholder' => null
])

<div
  x-data="textEditor({ placeholder: '{{ $placeholder }}' })"
  class="editor">
  {{ $slot }}
</div>
