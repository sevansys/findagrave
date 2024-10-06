<?php

namespace App\View\Components\Entities\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Cemetery;

abstract class AboutItem extends Component
{

    abstract protected function getProp(): string;
    abstract protected function getViewPath(): string;

    public function __construct(
        public Cemetery $target
    ) {}

    public function render(): View|string
    {
        $val = $this->target->{$this->getProp()};

        if (empty($val)) {
            return '';
        }

        return view($this->getViewPath());
    }
}
