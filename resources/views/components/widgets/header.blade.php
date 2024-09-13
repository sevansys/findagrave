<header class="header flex px-4 pt-1 justify-between">
  <nav class="header__nav flex gap-10 items-end">
    <x-shared.logo></x-shared.logo>
    <x-features.menu.top></x-features.menu.top>
  </nav>

  <nav class="header__nav flex items-end">
    @auth()

    @else
      <x-features.auth.actions></x-features.auth.actions>
    @endauth
  </nav>
</header>
