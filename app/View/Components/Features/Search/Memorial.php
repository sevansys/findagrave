<?php

namespace App\View\Components\Features\Search;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Enums\{
    EnumSearchMemorialType,
    EnumSearchMemorialWith,
    EnumSearchMemorialInclude,
};

class Memorial extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $px = 0,
        public string $mx = 'auto',
        public bool $compact = false,
        public bool $expanded = false,
        public bool $showTitle = false,
        public string $submitText = "Search",
        public string $title = "Memorial Search",
        public bool $withoutCemeteryLocation = false,
    ) {}

    protected function getMemorialTypes(): array
    {
        return [
            EnumSearchMemorialType::FAMOUS->value => 'Famous',
            EnumSearchMemorialType::NOT_BURIED_CEMETERY->value => 'Not buried in a cemetery',
            EnumSearchMemorialType::CENOTAPH->value => 'Cenotaph',
            EnumSearchMemorialType::MONUMENT->value => 'Monument',
            EnumSearchMemorialType::VETERAN->value => 'Veteran',
        ];
    }

    protected function getMemorialInclude(): array
    {
        return [
            EnumSearchMemorialInclude::NICKNAME->value => 'Nickname',
            EnumSearchMemorialInclude::MAIDEN_NAME->value => 'Maiden name',
            EnumSearchMemorialInclude::TITLES->value => 'Titles',
            EnumSearchMemorialInclude::EXACT_NAME_SPELLING->value => 'Exact name spellings',
            EnumSearchMemorialInclude::SIMILAR_NAME_SPELLINGS->value => 'Similar name spellings',
        ];
    }

    protected function getMemorialWith(): array
    {
        return [
            EnumSearchMemorialWith::NO_GRAVE_PHOTO->value => 'No grave photo',
            EnumSearchMemorialWith::GRAVE_PHOTO->value => 'Grave photo',
            EnumSearchMemorialWith::NO_GPS->value => 'No GPS',
            EnumSearchMemorialWith::GPS->value => 'GPS',
            EnumSearchMemorialWith::PLOT_INFO->value => 'Plot Info',
            EnumSearchMemorialWith::NO_GRAVE_PHOTO->value => 'No Plot Info',
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.features.search.memorial', [
            'with' => $this->getMemorialWith(),
            'types' => $this->getMemorialTypes(),
            'include' => $this->getMemorialInclude(),
        ]);
    }
}
