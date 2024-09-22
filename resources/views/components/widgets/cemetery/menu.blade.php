<nav class="border-b gap-1 py-4 flex">
  <div class="flex-1">
    <x-features.cemetery.read-menu
      :gap="10"
      :target="$target"></x-features.cemetery.read-menu>
  </div>
  <span class="border-r"></span>
  <div class="flex-1">
    <x-features.cemetery.set-menu
      :gap="10"
      :target="$target"></x-features.cemetery.set-menu>
  </div>
</nav>
