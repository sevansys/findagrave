<?php

namespace Tests\Feature\Cemetery;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Location;
use App\Models\Cemetery;
use App\Enums\EnumLocation;
use App\Enums\EnumVisibility;
use App\Enums\EnumScrapStatus;

use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    private ?Location $location;

    private ?Collection $additionalLocations = null;

    protected function setUp(): void
    {
        parent::setUp();

        Location::insert([
            [
                'text' => 'Test location',
                'type' => EnumLocation::CITY,
                'src' => '/location/1234/test',
                'scrap_status' => EnumScrapStatus::SCRAPED,
            ],
            [
                'text' => 'Additional 1 location',
                'type' => EnumLocation::COUNTY,
                'src' => '/location/2345/test',
                'scrap_status' => EnumScrapStatus::SCRAPED,
            ],
            [
                'text' => 'Additional 2 location',
                'type' => EnumLocation::COUNTRY,
                'src' => '/location/3456/test',
                'scrap_status' => EnumScrapStatus::SCRAPED,
            ]
        ]);

        $this->location = Location::first();
        $this->additionalLocations = Location::orderBy('id', 'desc')->limit(2)->get();
    }

    private function request(array $data = [])
    {
        return $this->post(route('cemetery.store'), $data);
    }

    /**
     * A basic feature test example.
     */
    public function test_requiredFieldsError(): void
    {
        $response = $this->request();

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name',
            'location_id'
        ]);
    }

    public function test_validationErrors(): void
    {
        $response = $this->request([
            'more' => [
                'phone' => '+764234223',
                'website' => 'invalid url',
                'email' => 'invalid email',
                'office_address' => 'Any address',
                'visibility' => 14,
            ],
            'name' => 135234,
            'location_id' => 1234567890,
            'address' => null,
            'latitude' => 23,
            'longitude' => 43,
            'description' => 'Description content',
            'additional_location' => [
                [
                    'id' => 85554342,
                    'name' => 'Non exists location',
                ]
            ],
        ]);


        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name',
            'latitude',
            'longitude',
            'more.email',
            'location_id',
            'more.website',
            'more.visibility',
            'additional_location.0',
        ]);

        $this->assertDatabaseMissing('cemeteries', [
            'name' => '135234',
        ]);
    }

    public function test_validaMVP()
    {
        $response = $this->request([
            'name' => ['Test cemetery'],
            'location_id' => $this->location?->id,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('cemeteries', [
            'name' => 'Test cemetery',
            'location_id' => $this->location?->id,
        ]);
    }

    public function test_validFullData()
    {
        $location_id = $this->location->id;
        $additional_locations = $this->additionalLocations->pluck('id')->toArray();

        $response = $this->request([
            'name' => ['Test name', 'Alt name 1', 'Alt name 2'],
            'description' => 'Test description',
            'location_id' => $location_id,
            'address' => 'Test address',
            'latitude' => '55.751244',
            'longitude' => '37.618423',
            'additional_location' => $additional_locations,
            'more' => [
                'phone' => '+764234223',
                'email' => 'admin@host.com',
                'office_address' => 'Test address',
                'website' => 'https://www.test.com',
                'additional_info' => 'Additional info',
                'visibility' => EnumVisibility::PRIVATE->value,
            ],
        ]);

        $cemetery = Cemetery::first();

        $response->assertStatus(302);
        $response->assertRedirectToRoute('cemetery.about', [
            'slug' => $cemetery->name,
            'cemeteryAbout' => $cemetery->id,
        ]);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('cemeteries', [
            'name' => 'Test name',
            'description' => 'Test description',
            'location_id' => $this->location?->id,
            'address' => 'Test address',
            'latitude' => '55.751244',
            'longitude' => '37.618423',
            'email' => 'admin@host.com',
            'office_address' => 'Test address',
            'additional_info' => 'Additional info',
            'visibility' => EnumVisibility::PRIVATE->value,
        ]);

        $this->assertEquals($cemetery->alt_name, ['Alt name 1', 'Alt name 2']);
        $this->assertEquals($cemetery->phone, [
            'href' => '+764234223',
            'text' => '+764234223',
        ]);
        $this->assertEquals($cemetery->website, [
            'url' => 'https://www.test.com',
            'text' => 'https://www.test.com',
        ]);

        $this->assertDatabaseHas('cemetery_additional_locations', [
            'cemetery_id' => $cemetery->id,
            'location_id' => $additional_locations[0],
        ]);

        $this->assertDatabaseHas('cemetery_additional_locations', [
            'cemetery_id' => $cemetery->id,
            'location_id' => $additional_locations[1],
        ]);
    }
}
