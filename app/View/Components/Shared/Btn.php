<?php

namespace App\View\Components\Shared;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

class Btn extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $lofty = true,
        public bool $filled = true,
        public bool $outlined = false,
        public string $type = 'button',
        public ?string $variant = 'default',
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shared.btn', [
            'clsx' => [
                'btn p-3',
                'btn--lofty' => $this->lofty,
                'btn--filled' => $this->filled,
                'btn--outlined' => $this->outlined,
                'btn--' . $this->variant => $this->variant,
            ]
        ]);
    }
}
