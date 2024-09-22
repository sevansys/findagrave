<figure class="flex flex-col gap-0.5 text-center h-full">
  <a href="{{ $target->source_url }}" target="_blank" class="h-full">
    <img src="{{ $target->source_url }}" alt="{{ $alt ?? 'Cemetery photo' }}" class="h-full" />
  </a>

  <x-shared.contributor-link
    href="#{{ $target->contributor?->id }}"
    :date="$showDate ? $target->created_at : null"
    :name="$target->contributor?->name"></x-shared.contributor-link>
</figure>
