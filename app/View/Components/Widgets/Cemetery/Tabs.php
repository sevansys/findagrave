<?php

namespace App\View\Components\Widgets\Cemetery;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

use App\Models\Cemetery;

class Tabs extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function getMenuItems(): array
    {
        return [
            [
                "count" => null,
                "text" => "About",
                'active' => Route::is('cemetery.about'),
                "href" => $this->makeRouteUrl('cemetery.about'),
            ],
            [
                "text" => "Photos",
                "count" => $this->getMediaCount(),
                'active' => Route::is('cemetery.photos'),
                "href" => $this->makeRouteUrl('cemetery.photos', 'cemeteryPhotos'),
            ],
            [
                "count" => null,
                "text" => "Map",
                'active' => Route::is('cemetery.map'),
                "href" => $this->makeRouteUrl('cemetery.map', 'cemeteryMap'),
            ]
        ];
    }

    protected function getMediaCount(): int
    {
        if (!$this->target->relationLoaded('media')) {
            return 0;
        }

        return $this->target->media->count();
    }

    protected function makeRouteUrl(string $name, string $key = "cemeteryAbout"): string
    {
        return route($name, [
            $key => $this->target->id,
            'slug' => Str::of($this->target->name),
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemetery.tabs', [
            'items' => $this->getMenuItems(),
        ]);
    }
}
