<?php

namespace App\View\Components\Features\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class Map extends Component
{
    public const string DEFAULT_STYLE = 'mapbox://styles/mapbox/standard?optimize=true';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function getStyles(): array
    {
        return [
            [
                'label' => 'Map',
                'value' => self::DEFAULT_STYLE,
                'icon' => 'global',
            ],
            [
                'label' => 'Satellite',
                'value' => 'mapbox://styles/mapbox/satellite-streets-v12',
                'icon' => 'browse-location',
            ]
        ];
    }

    protected function getLatitude(): float
    {
        return $this->target->latitude ?? 40;
    }

    protected function getLongitude(): float
    {
        return $this->target->longitude ?? -74.5;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.features.cemetery.map', [
            'zoom' => 9,
            'style' => self::DEFAULT_STYLE,
            'styles' => $this->getStyles(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'key' => config('app.mapbox.public_key'),
        ]);
    }
}
