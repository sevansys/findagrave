<?php

namespace App\View\Components\Widgets\Cemetery;

use App\Models\Cemetery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BannerLite extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function getAlsoKnownAs(): ?string
    {
        if (empty($this->target->alt_name)) {
            return null;
        }

        return implode(', ', $this->target->alt_name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.cemetery.banner-lite', [
            'alsoKnownAs' => $this->getAlsoKnownAs(),
        ]);
    }
}
