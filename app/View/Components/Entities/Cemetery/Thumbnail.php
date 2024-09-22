<?php

namespace App\View\Components\Entities\Cemetery;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\User;
use App\Models\Cemetery;

class Thumbnail extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function getSrc(): ?string
    {
        if (!$this->hasThumbnail()) {
            return null;
        }

        return $this->getOriginalUrl($this->target->media->first()->src);
    }

    private function getOriginalUrl(string $src): string
    {
        return sprintf('%s/%s', config('scraper.base_url'), $src);
    }

    private function hasThumbnail(): bool
    {
        return $this->target->relationLoaded('media') && $this->target->media->isNotEmpty();
    }

    protected function getAlt(): string
    {
        return sprintf('%s thumbnail', $this->target->name);
    }

    protected function getContributor(): ?User
    {
        return null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.entities.cemetery.thumbnail', [
            'src' => $this->getSrc(),
            'alt' => $this->getAlt(),
            'has' => $this->hasThumbnail(),
            'contributor' => $this->getContributor(),
        ]);
    }
}
