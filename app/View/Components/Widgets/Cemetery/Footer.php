<?php

namespace App\View\Components\Widgets\Cemetery;

use App\Models\Cemetery;
use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cemetery $target
    ) {}

    protected function getBreadcrumbs(): array
    {
        return [
            [
                [
                    "href" => "#",
                    "text" => "AA",
                    "target" => null,
                ],
                [
                    "href" => "#",
                    "text" => "BB",
                    "target" => null,
                ],
                [
                    "href" => null,
                    "target" => null,
                    "text" => $this->target->name,
                ]
            ],
            [
                [
                    "href" => "#",
                    "text" => "AA",
                    "target" => null,
                ],
                [
                    "href" => "#",
                    "text" => "BB",
                    "target" => null,
                ],
                [
                    "href" => "#",
                    "text" => "CC",
                    "target" => null,
                ],
                [
                    "href" => "#",
                    "text" => "DD",
                    "target" => null,
                ],
                [
                    "href" => "#",
                    "text" => "EE",
                    "target" => null,
                ],
                [
                    "href" => "#",
                    "text" => "FF",
                    "target" => null,
                ],
                [
                    "href" => null,
                    "target" => null,
                    "text" => $this->target->name,
                ]
            ],
            [
                [
                    "href" => "#",
                    "text" => "AA",
                    "target" => null,
                ],
                [
                    "href" => "#",
                    "text" => "BB",
                    "target" => null,
                ],
                [
                    "href" => null,
                    "target" => null,
                    "text" => $this->target->name,
                ]
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $breadcrumbs = $this->getBreadcrumbs();

        return view('components.widgets.cemetery.footer', [
            'id' => $this->target->id,
            'breadcrumbs' => $breadcrumbs,
            'created' => $this->target->created_at,
            'breadcrumbsCount' => count($breadcrumbs),
            'createdAtFormatted' => $this->target->created_at->format('d M Y'),
        ]);
    }
}
