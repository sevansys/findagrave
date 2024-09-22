<div class="relative">
  <x-entities.cemetery.cover-image
    :target="$target"></x-entities.cemetery.cover-image>

  <div class="max-w-screen-xl mx-auto flex gap-4 relative z-10 items-start">
    <div class="w-1/3">
      <x-entities.cemetery.thumbnail
        :target="$target"></x-entities.cemetery.thumbnail>
    </div>
    <div class="flex-1 pt-5 pb-10 flex flex-col gap-4">
      <header @class([
        'flex flex-col',
        'text-white border-white' => $hasMedia,
        'text-black border-black' => !$hasMedia,
      ])>
        <h1 class="text-4xl font-medium">{{ $target->name }}</h1>
        @if(!empty($alsoKnownAs))
          <h2 class="text-lg">
            Also known as <i>{{ $alsoKnownAs }}</i>
          </h2>
        @endif
        <address>{{ $target->address }}</address>
      </header>

      <div class="bg-white bg-opacity-75 p-4 rounded-lg">
        <x-features.search.memorial
          compact
          mx="none"
          without-cemetery-location
          submit-text="Search this cemetery"
        >
          <input type="hidden" name="cemetery-id" value="{{ $target->id }}" />
        </x-features.search.memorial>
      </div>
      <x-features.cemetery.actions :clsx="$actionsClsx"></x-features.cemetery.actions>
    </div>
  </div>
</div>
