<div class="flex flex-col">
  @foreach(($items ?? []) as $index => $item)
    <div
      @class([
        'pt-4 px-4 pb-3 hover:bg-gray-100',
        'border-b' => $index < $items->count() - 1,
      ]) class="">
      <x-entities.cemetery.nearby
        :target="$item"></x-entities.cemetery.nearby>
    </div>
  @endforeach
</div>
