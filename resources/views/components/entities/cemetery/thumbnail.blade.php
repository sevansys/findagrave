<div class="cemetery__thumbnail flex flex-col relative h-full w-full">
  @if($has)
    <figure @class([
      "flex",
      "flex-col",
      "relative",
      "overflow-hidden",
      "cemetery__image",
      "cemetery__image--grady" => $src,
    ])>
      <a href="{{ $src }}" target="_blank" class="flex flex-1 h-full">
        <img src="{{ $src }}" alt="{{ $alt }}" class="block w-full h-full object-contain object-center flex-1" />
      </a>

{{--      @if($contributor)--}}
      <x-shared.contributor-link
        href="#"
        :name="$contributor?->name"
        clsx="absolute bottom-0 left-0 right-0 text-white justify-end z-10"></x-shared.contributor-link>
    </figure>
{{--      @endif--}}
  @else
    <div class="flex flex-col gap-5 items-center justify-center h-[420px]">
      <span class="w-20 h-20 text-gray-600">
        <x-shared.icons.cemetery></x-shared.icons.cemetery>
      </span>

      <x-shared.btn :filled="false" clsx="rounded bg-white items-center text-sm px-5 text-[#5c60a3]">
        <span class="flex gap-1">
          <span class="w-5 h-5">
            <x-shared.icons.add></x-shared.icons.add>
          </span>
          Add cemetery photo
        </span>
      </x-shared.btn>
    </div>
  @endif
</div>
