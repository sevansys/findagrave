<?php

namespace App\View\Components\Widgets\Cemeteries;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Models\Location;
use App\Enums\EnumLocation;

class BrowseHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?Location $target,
    ) {}

    private function getTitlePrefix(): string
    {
        return match ($this->target->type) {
            null => "Choose a region",
            EnumLocation::CONTINENT => "Choose a country",
            default => "Cemeteries",
        };
    }

    private function generateBreadcrumbs(): array
    {
        $parent = $this->getParentsRelation();
        $items = [];

        do {
            if (!$parent) {
                continue;
            }

            array_unshift($items, $this->makeBreadcrumbItemFromLocation($parent));
        } while ($parent = $parent?->parents);

        if ($this->target?->id) {
            $items[] = $this->makeBreadcrumbItem($this->target->text, null);
        }

        return array_merge($this->getDefaultBreadcrumbs(), $items);
    }

    private function getParentsRelation(): ?Location
    {
        if (!$this->target->relationLoaded('parents')) {
            return null;
        }

        return $this->target->getRelation('parents');
    }

    private function getDefaultBreadcrumbs(): array
    {
        return [
            $this->makeBreadcrumbItem(
                'Cemeteries',
                route('cemeteries-index'),
            ),
            $this->makeBreadcrumbItem(
                'Regions',
                $this->makeRegionsHref(),
            ),
        ];
    }

    private function makeRegionsHref(): ?string
    {
        if (!$this->target?->id) {
            return null;
        }

        return route('cemeteries-browse');
    }

    private function makeBreadcrumbItemFromLocation(Location $location, string $target = null): array
    {
        return $this->makeBreadcrumbItem(
            $location->text,
            $this->makeBreadcrumbItemUrl($location),
            $target
        );
    }

    private function makeBreadcrumbItem(string $text, ?string $href, ?string $target = null): array
    {
        return [
            'text' => $text,
            'href' => $href,
            'target' => $target,
        ];
    }

    private function makeBreadcrumbItemUrl(Location $location): string
    {
        return sprintf('%d/%s', $location->id, $location->text);
    }

    private function getInfo(): ?array
    {
        if (!$this->target->type || $this->target->type->value <= EnumLocation::CONTINENT->value) {
            return null;
        }

        $items = [0, 0];

        if ($this->target->relationLoaded('children')) {
            $items[0] = $this->target->children->count();
        }

        if ($this->target->relationLoaded('cemeteries')) {
            $items[1] = $this->target->cemeteries->count();
        }

        return [
            'items' => $items,
            'name' => $this->target->text,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.widgets.cemeteries.browse-header', [
            'info' => $this->getInfo(),
            'targetName' => $this->target['text'],
            'titlePrefix' => $this->getTitlePrefix(),
            'breadcrumbs' => $this->generateBreadcrumbs(),
        ]);
    }
}
