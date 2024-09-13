<?php

namespace App\View\Components\Features\Menu;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

abstract class Menu extends Component
{
    /**
     * @return array<[label: string, url: string, name: string]>
     */
    abstract function getItems(): array;

    public function getMenu(): array
    {
        return array_map(function (array $item) {
            $item['active'] = $this->isActive($item);
            return $item;
        }, $this->getItems());
    }

    public function isActive(array $item): bool
    {
        return Route::is($item['name'] ?? null);
    }
}
