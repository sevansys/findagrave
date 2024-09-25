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
        public int $rows = 3,
        public int $cols = 30,
        public ?string $value = "",
        public ?string $clsx = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $attrs = null,
        public ?string $type = "text",
        public ?bool $required = false,
        public bool $floatLabel = true,
        public ?bool $autofocus = false,
        public ?string $autocomplete = null,
    ) {}

    protected function getIsLabeled(): bool
    {
        return $this->label && $this->floatLabel;
    }

    protected function getClsx(): array
    {
        $isLabeled = $this->getIsLabeled();

        return [
            'px-4',
            'pb-2',
            'w-full',
            'h-full',
            'rounded-lg',
            'outline-none',
            'transition-shadow',
            'pt-6' => $isLabeled,
            'pt-2' => !$isLabeled,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.shared.field', [
            'isLabeled' => $this->getIsLabeled(),
            'fieldClsx' => $this->getClsx(),
        ]);
    }
}
