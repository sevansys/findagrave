<?php

namespace App\View\Components\Entities\Cemetery;

use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class Nearby extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target,
    ) {}

    protected function getHref(): string
    {
        return route('cemetery.about', [
            'cemeteryAbout' => $this->target->id,
            'slug' => Str::slug($this->target->name),
        ]);
    }

    protected function getAddress(): ?string
    {
        return $this->target->address;
    }

    protected function getImage(): ?Media
    {
        if (!$this->target->relationLoaded('media')) {
            return null;
        }

        return $this->target->media->first();
    }

    protected function isWithoutGps(): bool
    {
        return is_null($this->target->latitude) || is_null($this->target->longitude);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.entities.cemetery.nearby', [
            'href' => $this->getHref(),
            'image' => $this->getImage(),
            'name' => $this->target->name,
            'address' => $this->getAddress(),
            'isWithoutGps' => $this->isWithoutGps(),
        ]);
    }
}
