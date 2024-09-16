<?php

namespace App\View\Components\Features\Cemeteries;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ListItems extends Component
{
    public function getItems(): array
    {
        return [
            [
                'href' => '#',
                'image' => null,
                'without_gps' => true,
                'name' => 'Arin Berd',
                'with_gps_count' => 0,
                'with_memorials_count' => 1,
                'with_photo_requests_count' => 0,
                'address' => 'City of Yerevan, Yerevan, Armenia',
            ],
            [
                'href' => '#',
                'without_gps' => false,
                'with_gps_count' => 10,
                'with_memorials_count' => 3,
                'name' => 'Charbakh Cemetery',
                'with_photo_requests_count' => 7,
                'address' => 'Yerevan, City of Yerevan, Yerevan, Armenia',
                'image' => 'https://images.findagrave.com/photos250/photos/2015/164/CEM2581870_1434337568.jpg',
            ],
            [
                'href' => '#',
                'image' => null,
                'without_gps' => true,
                'name' => 'Arin Berd',
                'with_gps_count' => 0,
                'with_memorials_count' => 1,
                'with_photo_requests_count' => 0,
                'address' => 'City of Yerevan, Yerevan, Armenia',
            ],
            [
                'href' => '#',
                'without_gps' => false,
                'with_gps_count' => 10,
                'with_memorials_count' => 3,
                'name' => 'Charbakh Cemetery',
                'with_photo_requests_count' => 7,
                'address' => 'Yerevan, City of Yerevan, Yerevan, Armenia',
                'image' => 'https://images.findagrave.com/photos250/photos/2015/164/CEM2581870_1434337568.jpg',
            ],
            [
                'href' => '#',
                'image' => null,
                'without_gps' => true,
                'name' => 'Arin Berd',
                'with_gps_count' => 0,
                'with_memorials_count' => 1,
                'with_photo_requests_count' => 0,
                'address' => 'City of Yerevan, Yerevan, Armenia',
            ],
            [
                'href' => '#',
                'without_gps' => false,
                'with_gps_count' => 10,
                'with_memorials_count' => 3,
                'name' => 'Charbakh Cemetery',
                'with_photo_requests_count' => 7,
                'address' => 'Yerevan, City of Yerevan, Yerevan, Armenia',
                'image' => 'https://images.findagrave.com/photos250/photos/2015/164/CEM2581870_1434337568.jpg',
            ],
            [
                'href' => '#',
                'image' => null,
                'without_gps' => true,
                'name' => 'Arin Berd',
                'with_gps_count' => 0,
                'with_memorials_count' => 1,
                'with_photo_requests_count' => 0,
                'address' => 'City of Yerevan, Yerevan, Armenia',
            ],
            [
                'href' => '#',
                'without_gps' => false,
                'with_gps_count' => 10,
                'with_memorials_count' => 3,
                'name' => 'Charbakh Cemetery',
                'with_photo_requests_count' => 7,
                'address' => 'Yerevan, City of Yerevan, Yerevan, Armenia',
                'image' => 'https://images.findagrave.com/photos250/photos/2015/164/CEM2581870_1434337568.jpg',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.features.cemeteries.list-items', [
            "items" => $this->getItems(),
        ]);
    }
}
