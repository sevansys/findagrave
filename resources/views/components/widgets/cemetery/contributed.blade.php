<x-shared.widget title="Members have Contributed">
  <x-features.cemetery.contributor
    :target="$target"></x-features.cemetery.contributor>

  <x-slot name="footer">
    <div class="flex justify-center">
      <a href="#" class="flex gap-1 items-center text-gray-600 px-1 py-0.5">
        <span class="w-4 h-4">
          <x-shared.icons.question></x-shared.icons.question>
        </span>
        <span class="text-sm">About these numbers</span>
      </a>
    </div>
  </x-slot>
</x-shared.widget>
