<menu class="menu flex flex-wrap gap-x-4 gap-y-2 justify-center font-medium">
  <li class="menu__item">
    <a href="{{ route('memorials-index') }}">Memorials</a>
  </li>
  <li>
    <a href="{{ route('cemeteries-index') }}">Cemeteries</a>
  </li>
  <li>
    <a href="{{ route('famous-index') }}">Famous</a>
  </li>
  <li>
    <a href="#help">Help</a>
  </li>
  <li>
    <a href="#about">About</a>
  </li>
</menu>

<menu class="menu flex flex-wrap gap-x-4 gap-y-2 justify-center font-medium">
  <li>
    <a href="#" class="flex gap-1 items-center">
      <span class="w-5 h-5">
        <x-shared.icons.fb></x-shared.icons.fb>
      </span>
      <span>Facebook</span>
    </a>
  </li>
  <li>
    <a href="#" class="flex gap-1 items-center">
      <span class="w-4 h-4">
        <x-shared.icons.x></x-shared.icons.x>
      </span>
      <span>X (Twitter)</span>
    </a>
  </li>
  <li>
    <a href="#" class="flex gap-1 items-center">
      <span class="w-4 h-4">
        <x-shared.icons.instagram></x-shared.icons.instagram>
      </span>
      <span>Instagram</span>
    </a>
  </li>
  <li>
    <a href="#contact">Website Feedback</a>
  </li>
</menu>
