<div class="flex flex-col">
  @foreach($items as $item)
    <x-entities.cemetery.list-item
      :name="$item['name']"
      :href="$item['href']"
      :image="$item['image']"
      :address="$item['address']"
      :without-gps="$item['without_gps']"
      :with-gps-count="$item['with_gps_count']"
      :with-memorials-count="$item['with_memorials_count']"
      :with-photo-requests-count="$item['with_photo_requests_count']"
    ></x-entities.cemetery.list-item>
  @endforeach
</div>
