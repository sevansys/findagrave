<?php

namespace App\View\Components\Features\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

class About extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function getEntities(): array
    {
        return [
            'contact-street-address',
            'status',
            'website',
            'email',
            'phone',
            'office-address',
            'id',
            'additional-info',
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.features.cemetery.about', [
            'entities' => $this->getEntities(),
        ]);
    }
}
