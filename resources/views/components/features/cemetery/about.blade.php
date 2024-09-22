<div class="flex flex-col text-gray-600">
  @foreach($entities as $index => $entity)
    <x-dynamic-component
      :target="$target"
      :component="sprintf('entities.cemetery.%s', $entity)"
    />
  @endforeach
</div>
