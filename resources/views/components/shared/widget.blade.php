<div class="widget rounded-lg border overflow-hidden">
  <header class="border-b px-3 py-1 flex gap-3">
    @if(!empty($title))
      <h4 class="text-primary font-semibold text-lg">{{ $title }}</h4>
    @endif

    @if (!empty($afterTitle))
      {{ $afterTitle }}
    @endif
  </header>

  @if ($slot->isNotEmpty())
    <div class="py-0.5">
      {{ $slot }}
    </div>
  @endif

  @if(!empty($footer))
    <footer class="border-t px-3 py-2">
      {{ $footer }}
    </footer>
  @endif
</div>
