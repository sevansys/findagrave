<div class="flex gap-2">
  <a href="{{ $href }}" class="w-1/5">
    <picture>
      <img src="{{ $image }}" alt="{{ $name }}" />
    </picture>
  </a>

  <div class="flex flex-col gap-1">
    <div>
      <a href="{{ $href }}" class="link">
        <h4>{{ $name }}</h4>
      </a>
    </div>
    <address class="text-sm text-gray-600">{{ $address }}</address>
  </div>
</div>
