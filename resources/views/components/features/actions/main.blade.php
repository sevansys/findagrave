<nav class="flex gap-{{ $gap }} items-{{ $align }} justify-{{ $justify }}">
  @foreach($actions as $action)
    <x-shared.icon-action
      :href="$action['href']"
      :icon-name="$action['icon']">
      {{ $action['text'] }}

      @if(!empty($action['count']))
        <span class="text-gray-600">
          {{ $action['count'] }}
        </span>
      @endif
    </x-shared.icon-action>
  @endforeach
</nav>
