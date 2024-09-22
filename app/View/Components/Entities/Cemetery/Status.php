<?php

namespace App\View\Components\Entities\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;
use App\Enums\EnumVisibility;

class Status extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    public function getVisibilityIcon(): string
    {
        return match ($this->target->visibility) {
            EnumVisibility::PRIVATE => 'lock',
            EnumVisibility::NO_LONGER_EXISTS_OR_HAS_BEEN_REMOVED => 'cancel',
            default => 'global',
        };
    }

    public function getVisibilityLabel()
    {
        return match ($this->target->visibility) {
            EnumVisibility::PRIVATE => 'This cemetery is marked as private and may not be accessible.',
            EnumVisibility::NO_LONGER_EXISTS_OR_HAS_BEEN_REMOVED => 'This cemetery is not longer exists or has been removed.',
            default => 'Publicly accessible',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        if (!$this->target->visible === EnumVisibility::PUBLIC) {
            return "";
        }

        return view('components.entities.cemetery.status', [
            'icon' => $this->getVisibilityIcon(),
            'label' => $this->getVisibilityLabel(),
        ]);
    }
}
