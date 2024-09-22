<?php

namespace App\View\Components\Features\Actions;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Main extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $gap = 4,
        public string $align = 'end',
        public string $justify = 'center',
    ) {}

    protected function getActions(): array
    {
        return [
            [
                'icon' => 'grave',
                'text' => 'Add a Memorial',
                'href' => '#add-a-memorial',
            ],
            [
                'icon' => 'upload-photo',
                'text' => 'Upload Photos',
                'href' => '#upload-photos',
            ],
            [
                'icon' => 'edit',
                'text' => 'Transcribe Photos',
                'href' => '#transcribe-photos',
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.features.actions.main', [
            'actions' => $this->getActions(),
        ]);
    }
}
