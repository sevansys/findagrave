@props([
  'name' => null,
  'placeholder' => null
])

<div
  x-data="textEditor({ placeholder: '{{ $placeholder }}' })"
  class="editor">
  {!! html_entity_decode($slot) !!}
</div>
<textarea data-ql-field  hidden="hidden" name="{{ $name }}">{{ $slot }}</textarea>
