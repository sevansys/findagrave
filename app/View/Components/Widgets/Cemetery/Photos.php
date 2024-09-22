<?php

namespace App\View\Components\Widgets\Cemetery;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Media;
use App\Models\Cemetery;

class Photos extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    /**
     * @return Collection<Media>|null
     */
    protected function getImages(): ?Collection
    {
        if (!$this->target->relationLoaded('media')) {
            return null;
        }

        /**
         * @var Collection<Media> $media
         */
        $media = $this->target->getRelation('media');

        return $media->slice(1, 2);
    }

    protected function getMoreCount(): int
    {
        if (!$this->target->relationLoaded('media')) {
            return 0;
        }

        $more = $this->target->media->count() - 3;

        return max($more, 0);
    }

    protected function getMoreHref(): string
    {
        return route('cemetery.photos', [
            'cemeteryPhotos' => $this->target->id,
            'slug' => Str::slug($this->target->name),
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemetery.photos', [
            'images' => $this->getImages(),
            'more' => $this->getMoreCount(),
            'moreHref' => $this->getMoreHref(),
        ]);
    }
}
