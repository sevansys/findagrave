<form method="GET" class="flex gap-2 items-center">
  <span>View</span>

  @foreach($items as $item)
    <label class="flex gap-1">
      <input
        type="radio"
        name="cemetery-photos-view"
        value="{{ $item['value'] }}"
        @checked($item['value'] === old('cemetery-photos-view', \App\Enums\EnumCemeteryPhotosView::ALL))
      />
      <span>{{ $item['label'] }}</span>
    </label>
  @endforeach
</form>
