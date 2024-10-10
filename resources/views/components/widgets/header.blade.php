<header class="header flex px-4 pt-1 justify-between">
  <nav class="header__nav flex gap-10 items-center lg:items-end">
    <a
      x-data
      href="#"
      x-drawer.mobile-menu
      class="w-10 h-10 text-white flex lg:hidden"
    >
      <x-shared.icons.menu></x-shared.icons.menu>
    </a>

    <x-shared.logo></x-shared.logo>

    <x-features.menu.top></x-features.menu.top>
  </nav>

  <nav x-data class="header__nav items-center lg:items-end flex">
    @auth()

    @else
      <x-features.auth.actions></x-features.auth.actions>
    @endauth
  </nav>
</header>
