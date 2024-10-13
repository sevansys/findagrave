<div class="flex flex-col">
  @foreach(($items ?? []) as $index => $item)
    <div
      @class([
        'pt-2 md:pt-4 px-2 md:px-4 pb-2 md:pb-3 hover:bg-gray-100',
        'border-b' => $index < $items->count() - 1,
      ]) class="">
      <x-entities.cemetery.nearby
        :target="$item"></x-entities.cemetery.nearby>
    </div>
  @endforeach
</div>
