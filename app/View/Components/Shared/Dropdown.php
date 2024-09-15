<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $options,
        public ?bool $fluid =false,
        public ?string $clsx = null,
        public ?string $name = null,
        public ?string $value = null,
        public ?string $label = null,
        public ?string $placeholder = 'Select option',
    ) {}

    public function getSelectedLabel(): ?string
    {
        $value = $this->getSelected();
        return $value ? $value['label'] : $this->placeholder;
    }

    public function getSelected(): ?array
    {
        if (!$this->value) {
            return null;
        }

        foreach ($this->options as $option) {
            if ($option['value'] === $this->value) {
                return $option;
            }
        }

        return null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.dropdown', [
            'selectedLabel' => $this->getSelectedLabel()
        ]);
    }
}
