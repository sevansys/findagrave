<?php

namespace App\View\Components\Features\Search;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Enums\EnumLocation;

class Cemetery extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $showHint = true,
        public array|string $types = '*',
        public string $hint = '*Only displays locations with cemeteries',
    ) {}

    protected function getAllTypes(): array
    {
        return [
            EnumLocation::CITY,
            EnumLocation::COUNTY,
            EnumLocation::STATE,
            EnumLocation::COUNTRY,
        ];

    }

    protected function getLabel(): string
    {
        $types = $this->types;

        if ($types === '*') {
            $types = $this->getAllTypes();
        }

        $typesCount = count($types);

        $fields = [];
        foreach ($types as $index => $type) {
            $sep = $index == $typesCount - 2 ? ' or' : ',';

            $fields[] = sprintf(
                '%s%s',
                EnumLocation::label($type),
                $index == $typesCount - 1 ? '' : $sep,
            );
        }

        return sprintf(
            'Cemetery Location (%s)',
            implode(' ', $fields)
        );
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.features.search.cemetery', [
            'label' => $this->getLabel(),
        ]);
    }
}
