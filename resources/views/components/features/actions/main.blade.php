<nav class="flex gap-4 items-{{ $align }} justify-{{ $justify }}">
  @foreach($actions as $action)
    <x-shared.icon-action
      :href="$action['href']"
      :icon-name="$action['icon']">
      {{ $action['text'] }}
    </x-shared.icon-action>
  @endforeach
</nav>
