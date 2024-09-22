<?php

namespace App\View\Components\Shared;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SvgProgress extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $color,
        public string|int $size,
        public float $strokeWidth = 15,
        public string $placeholderColor = '#e5e7eb',
    ) {}

    protected function getSize(): string
    {
        if (is_int($this->size)) {
            return sprintf('%dpx', $this->size);
        }

        return $this->size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.shared.svg-progress', [
            'sizeValue' => $this->getSize(),
        ]);
    }
}
