<?php

namespace App\View\Components\Features\Cemetery;

use App\Enums\EnumCemeteryPhotosView;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PhotosFilter extends Component
{
    protected function getItems(): array
    {
        return [
            [
                'value' => EnumCemeteryPhotosView::ALL,
                'label' => 'All Photos',
            ],
            [
                'value' => EnumCemeteryPhotosView::MY,
                'label' => 'My Photo(s)',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.features.cemetery.photos-filter', [
            'items' => $this->getItems(),
        ]);
    }
}
