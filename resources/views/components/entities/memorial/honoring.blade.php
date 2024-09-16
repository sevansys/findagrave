<div class="flex gap-3">
  <a href="{{ $href }}" class="w-auto">
    <picture class="w-full h-full">
      <img src="{{ $image }}" alt="{{ $name }}" class="h-full" />
    </picture>
  </a>
  <div class="flex flex-col gap-2">
    <span class="font-bold">HONORING</span>
    <a href="{{ $href }}" class="hover:underline">
      <h4 class="text-primary font-normal text-xl m-0">{{ $name }}</h4>
    </a>
    <div class="flex flex-col gap-1 text-gray-600">
      <time class="text-sm" datetime="{{ $birth }}">BIRTH: {{ $birth }}</time>
      <time class="text-sm" datetime="{{ $birth }}">DEATH: {{ $death }}</time>
    </div>
  </div>
</div>
