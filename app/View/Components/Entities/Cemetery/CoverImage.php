<?php

namespace App\View\Components\Entities\Cemetery;

use Closure;

use Illuminate\Contracts\View\View;

class CoverImage extends Thumbnail
{

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        $src = $this->getSrc();

        if (empty($src)) {
            return '';
        }

        return view('components.entities.cemetery.cover-image', [
            'src' => $src,
            'alt' => $this->getAlt(),
        ]);
    }
}
