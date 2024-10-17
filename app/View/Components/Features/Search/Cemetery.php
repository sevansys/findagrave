<?php

namespace App\View\Components\Features\Search;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

use App\Enums\EnumLocation;

class Cemetery extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $ajax = true,
        public bool $showHint = true,
        public ?string $action = null,
        public array|string $types = '*',
        public string $browseText = 'Browse',
        public string $actionText = 'Search',
        public bool $cemeteryRequired = false,
        public ?string $ajaxDataEvaluateKey = null,
        public ?string $ajaxErrorEvaluateKey = null,
        public ?string $ajaxLoadingEvaluateKey = null,
        public string $namePlaceholder = 'Cemetery Name',
        public string $hint = '*Only displays locations with cemeteries',
    ) {
        if (!$this->action) {
            $this->action = route('cemeteries.search.json');
        }
    }

    protected function getAllTypes(): array
    {
        return [
            EnumLocation::CITY,
            EnumLocation::COUNTY,
            EnumLocation::STATE,
            EnumLocation::COUNTRY,
        ];
    }

    protected function getSelectedTypes(): array
    {
        $types = $this->types;
        if ($types === '*') {
            $types = $this->getAllTypes();
        }

        return $types;
    }

    protected function getLabel(): string
    {
        $types = $this->getSelectedTypes();

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

    private function getParams(): array
    {
        return [
            'ajax' => $this->ajax,
            'evaluateErrorKey' => $this->ajaxErrorEvaluateKey,
            'evaluationDataKey' => $this->ajaxDataEvaluateKey,
            'evaluateLoadingKey' => $this->ajaxLoadingEvaluateKey,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.features.search.cemetery', [
            'label' => $this->getLabel(),
            'params' => $this->getParams(),
            'selectedTypes' => $this->getSelectedTypes(),
        ]);
    }
}
