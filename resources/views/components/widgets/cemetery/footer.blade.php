<footer class="border-t flex flex-col items-center text-center gap-3 py-8 text-gray-600">
  @foreach($breadcrumbs as $index => $breadcrumb)
      <x-shared.breadcrumbs
        class="justify-center"
        :items="$breadcrumb"></x-shared.breadcrumbs>

    @if ($index < $breadcrumbsCount - 1)
      <hr class="border-t max-w-96 w-full" />
    @endif
  @endforeach

  <div class="flex flex-col gap-1 justify-center text-gray-600">
    <time datetime="{{ $created }}">Added: {{ $createdAtFormatted }}</time>
    <span>Find a Grave Cemetery ID: <b>{{ $id }}</b></span>
  </div>
</footer>
