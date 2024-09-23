<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Field extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $value = "",
        public ?string $clsx = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $attrs = null,
        public ?string $type = "text",
        public ?bool $required = false,
        public bool $floatLabel = true,
        public ?bool $autofocus = false,
        public ?string $fieldClsx = null,
        public ?string $autocomplete = null,
    ) {}

    protected function getIsLabeled(): bool
    {
        return $this->label && $this->floatLabel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.field', [
            'isLabeled' => $this->getIsLabeled(),
        ]);
    }
}
