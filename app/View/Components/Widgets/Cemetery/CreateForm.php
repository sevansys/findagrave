<?php

namespace App\View\Components\Widgets\Cemetery;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class CreateForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    protected function getIsAditionalexpanded(): bool
    {
        return !empty(old('more'));
    }

    protected function getAddresses(): array
    {
        $selected_names = old('additional_location_name', []);
        $selected_locations = old('additional_location', []);

        return collect($selected_locations)
            ->map(fn(?int $locationId, int $index) => [
                'id' => $locationId,
                'name' => $selected_names[$index] ?? null,
            ])->toArray();
    }

    protected function getXData(): array
    {
        $req = request();
        $addresses = $this->getAddresses();

        return [
            "locationId" => null,
            "addresses" => $addresses,
            "showAdditionalAddresses" => !!count($addresses),
            "showMoreDetails" => $this->getIsAditionalexpanded(),
            "location" => old('location', $req->get('location')),
            "names" => old('name', [
                $req->get('cemetery')
            ]),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.cemetery.create-form', [
            'xData' => $this->getXData(),
        ]);
    }
}
