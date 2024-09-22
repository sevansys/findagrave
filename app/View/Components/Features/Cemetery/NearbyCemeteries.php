<?php

namespace App\View\Components\Features\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Cemetery;

class NearbyCemeteries extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    /**
     * @return Collection<Cemetery>|null
     */
    protected function getItems(): ?Collection
    {
        return Cemetery::withWhereHas('media')
            ->limit(4)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $items = $this->getItems();

        return view('components.features.cemetery.nearby-cemeteries', [
            'items' => $items,
        ]);
    }
}
