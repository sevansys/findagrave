<menu class="menu menu--top gap-4 hidden lg:flex">
  @foreach($items as $item)
    <li @class([
          'menu__item',
          'menu__item--active' => !!($item['active'] ?? null)
        ])>
      <a href="{{ route($item['name']) }}" class="block px-2.5 pt-2.5 pb-2">{{ $item['label'] }}</a>
    </li>
  @endforeach
</menu>
