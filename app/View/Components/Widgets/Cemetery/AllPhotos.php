<?php

namespace App\View\Components\Widgets\Cemetery;

use Illuminate\View\Component;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;

use App\Models\Media;
use App\Models\Cemetery;

class AllPhotos extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target,
    ) {}

    /**
     * @return Collection<Media>|null
     */
    protected function getItems(): ?Collection
    {
        if (!$this->target->relationLoaded('media')) {
            return null;
        }

        return $this->target->media;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemetery.all-photos', [
            'items' => $this->getItems(),
        ]);
    }
}
