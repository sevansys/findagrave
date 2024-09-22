@props([
  'href' => '#',
  'name' => null,
  'clsx' => null,
  'date' => null,
])

<figcaption
  @class([
    'text-sm flex gap-1 px-3 py-2',
    $clsx,
  ])
>
  Photo added by
  <a href="{{ $href }}" class="link hover:underline">{{ $name ?? "Unknown" }}</a>
  @if($date)
    <time datetime="{{ $date }}">
      on {{ $date->format('d M Y') }}
    </time>
  @endif
</figcaption>
