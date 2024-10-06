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
        public ?bool $showErrors = true,
        public ?string $autocomplete = null,
        public array|string|null $errors = null,
    ) {}

    protected function getIsLabeled(): bool
    {
        return $this->label && $this->floatLabel;
    }

    protected function getClsx(): array
    {
        $hasErrors = $this->hasErrors();
        $isLabeled = $this->getIsLabeled();

        return [
            'px-4',
            'pb-2',
            'w-full',
            'h-full',
            'border',
            'rounded-lg',
            'outline-none',
            'transition-shadow',
            'pt-6' => $isLabeled,
            'pt-2' => !$isLabeled,
            'border-neutral-300' => !$hasErrors,
            'bg-red-100 border-red-600' => $hasErrors,
        ];
    }

    protected function getErrors(): array
    {
        if (!$this->errors) {
            return [];
        }

        if (is_string($this->errors)) {
            return [$this->errors];
        }

        return $this->errors;
    }

    protected function hasErrors(): bool
    {
        return count($this->getErrors());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.shared.field', [
            'fieldClsx' => $this->getClsx(),
            'fieldErrors' => $this->getErrors(),
            'isHasErrors' => $this->hasErrors(),
            'isLabeled' => $this->getIsLabeled(),
        ]);
    }
}
