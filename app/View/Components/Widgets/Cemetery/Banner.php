<?php

namespace App\View\Components\Widgets\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class Banner extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function isHasMedia(): bool
    {
        return $this->target->relationLoaded('media') && $this->target->media->isNotEmpty();
    }

    protected function getActionsClsx(): string
    {
        if ($this->isHasMedia()) {
            return 'text-white border-white hover:bg-white hover:text-black';
        }

        return 'text-[#5C60A3] border-[#5C60A3] hover:bg-[#5C60A3] hover:text-white';
    }

    protected function getAlsoKnownAs(): ?string
    {
        if (empty($this->target->alt_name)) {
            return null;
        }

        return implode(',', $this->target->alt_name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemetery.banner', [
            'hasMedia' => $this->isHasMedia(),
            'alsoKnownAs' => $this->getAlsoKnownAs(),
            'actionsClsx' => $this->getActionsClsx(),
        ]);
    }
}
