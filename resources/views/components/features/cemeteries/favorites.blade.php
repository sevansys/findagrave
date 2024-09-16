<ul class="flex flex-col gap-2">
  @foreach($items as $item)
    <li class="flex gap-1">
      <x-entities.cemetery.favorite
        :name="$item['name']"
        :href="$item['href']"
        :image="$item['image']"
        :address="$item['address']"></x-entities.cemetery.favorite>
    </li>
  @endforeach
</ul>
