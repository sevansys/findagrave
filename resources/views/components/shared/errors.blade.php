@props([
  'items' => [],
])

@if(count($items))
  <div class="field__errors flex flex-col gap-1 text-sm">
    @foreach($items as $item)
      <span class="field__error text-red-600 px-0.5 py-1">
          {!! $item !!}
        </span>
    @endforeach
  </div>
@endif

