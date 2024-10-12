<section class="cemetery__creat">
  <header class="border-b pb-5 pt-2 md:pt-5 text-sm text-gray-500">
    <div class="max-w-screen-md mx-auto w-full">
      <p>Please provide details about this cemetery. If you are unsure about non-required fields, simply leave them blank.</p>
      <a href="#" class="link">Learn more about adding a cemetery.</a>
    </div>
  </header>

  <form
    method="POST"
    x-data='@json($xData)'
    action="{{ route('cemetery.store') }}"
    class="flex flex-col gap-5 max-w-screen-md mx-auto w-full py-5"
  >
    @csrf

    <div class="border-b pb-5 md:pb-10">
      <fieldset class="cemetery__create-names flex flex-col gap-3 w-full md:w-2/3">
        <legend class="text-primary text-lg font-semibold">Cemetery Name(s)</legend>
        <ul x-sort class="flex flex-col items-start gap-2">
          <template x-for="(name, index) in names" :key="`name.${index}`">
            <li
              x-sort:item
              class="flex gap-2 w-full items-center"
            >
              <x-shared.field
                required
                name="name[]"
                x-bind:value="name"
                class="bg-gray-50 flex-1"
                label="Cemetery name (Required)"
              ></x-shared.field>

              <a
                href="#"
                x-sort:handle
                class="flex p-0.5 w-6 h-6 cemetery__name-move"
              >
                <x-shared.icons.draggable></x-shared.icons.draggable>
              </a>

              <a
                href="#"
                @click.prevent="() => names.splice(index, 1)"
                class="w-8 h-8 flex px-2 py-1 rounded text-[#aa2b27] hover:text-white hover:bg-[#aa2b27] transition-colors cemetery__name-trash"
              >
                <x-shared.icons.trash></x-shared.icons.trash>
              </a>
            </li>
          </template>
        </ul>

        <div>
          <a
            href="#"
            class="inline-flex gap-2 items-center px-1 py-0.5 rounded text-[#1775a5]"
            @click.prevent="names.push('')"
          >
            <span class="w-4 h-4 bg-[#1775a5] rounded-full p-0.5 text-white">
              <x-shared.icons.plus></x-shared.icons.plus>
            </span>
            Add alternative name(s)
          </a>
        </div>

        @error('name')
          <x-shared.errors :items="$errors->get('name')"></x-shared.errors>
        @enderror
      </fieldset>
    </div>

    <div class="border-b pb-5 md:pb-10">
      <fieldset class="flex flex-col gap-4">
        <legend class="text-primary text-lg font-semibold">Location</legend>
        <div class="flex flex-col gap-4 w-full md:w-2/3">
          <div class="flex gap-2 items-center">
            <x-shared.autocomplete
              required
              ref="location"
              name="location"
              value-name="location_id"
              base-url="/locations/autocomplete"
              label="Location for search (Required)"
              :error="$errors->get('location_id')"
              :value="old('location', request()->get('location'))"
              :input-value="old('location_id', request()->get('location_id'))"
              :params="[
                'types' => [\App\Enums\EnumLocation::CITY, \App\Enums\EnumLocation::COUNTY],
              ]"
            >
              <x-slot name="suggestionIcon">
                <x-shared.icons.location></x-shared.icons.location>
              </x-slot>
              <x-slot name="after">
                <a
                  href="#"
                  class="link"
                  x-dialog.browse-locations="{ onSelect({ id, path }) { query=path, inputValue=id } }"
                >Browse</a>
              </x-slot>
            </x-shared.autocomplete>
          </div>

          <div class="flex gap-2 flex-col sm:flex-row items-start">
            <x-shared.btn class="w-full sm:w-auto px-1 sm:px-5 bg-gray-600 hover:bg-gray-800 transition-colors rounded-md text-white text-sm">
              <span class="w-5 h-5 inline-block align-middle">
                <x-shared.icons.location></x-shared.icons.location>
              </span>
              SET GPS AND ADDRESS USING MAP
            </x-shared.btn>
            <x-shared.field
              type="textarea"
              class="bg-gray-50"
              name="street_address"
              label="Street Address"
              :value="old('street_address', request()->get('street_address'))"
            ></x-shared.field>
          </div>

          <div class="flex flex-col sm:flex-row gap-2">
            <x-shared.field
              name="latitude"
              label="Latitude"
              class="bg-gray-50"
              :value="old('latitude', request()->get('latitude'))"
            ></x-shared.field>
            <x-shared.field
              name="longitude"
              label="Longitude"
              class="bg-gray-50"
              :value="old('longitude', request()->get('longitude'))"
            ></x-shared.field>
          </div>
        </div>

        <div
          x-collapse
          class="flex flex-col gap-2"
          x-show="showAdditionalAddresses"
        >
          <p class="text-sm text-gray-500">Some cemeteries may span city or county boundaries. You can include additional municipalities here.</p>

          <div class="cemetery__create-additional-locations w-full md:w-2/3 flex flex-col gap-2">
            <template x-for="(address, index) in addresses" :key="`address.${index}`">
              <div class="flex gap-2 items-start sm:items-center">
                <x-shared.autocomplete
                  ref="location"
                  name="additional_location_name[]"
                  label="Additional City or County"
                  value-name="additional_location[]"
                  base-url="/locations/autocomplete"
                  x-init="query = address.name; inputValue = address.id;"
                  :params="[
                    'types' => [\App\Enums\EnumLocation::CITY, \App\Enums\EnumLocation::COUNTY],
                  ]"
                >
                  <x-slot name="suggestionIcon">
                    <x-shared.icons.location></x-shared.icons.location>
                  </x-slot>

                  <x-slot name="after">
                    <a
                      href="#"
                      class="link"
                      x-dialog.browse-locations="{ onSelect({ id, path }) { query=path; inputValue=id } }"
                    >Browse</a>
                  </x-slot>
                </x-shared.autocomplete>
                <a
                  href="#"
                  @click.prevent="() => addresses.splice(index, 1)"
                  class="cemetery__create-additional-location-remove w-8 h-8 flex px-2 py-1 rounded text-[#aa2b27] hover:text-white hover:bg-[#aa2b27] transition-colors"
                >
                  <x-shared.icons.trash></x-shared.icons.trash>
                </a>
              </div>
            </template>
          </div>

          <div>
            <a
              href="#"
              class="inline-flex gap-2 p-1 text-[#1775a5] items-center"
              @click.prevent="addresses.push({ id: null, name: null })"
            >
              <span class="w-4 h-4 bg-[#1775a5] rounded-full p-0.5 text-white">
                <x-shared.icons.plus></x-shared.icons.plus>
              </span>
              Add expanded location
            </a>
          </div>
        </div>
        <a
          href="#"
          x-show="!showAdditionalAddresses"
          class="flex flex-col gap-1 p-2 rounded"
          @click.prevent="showAdditionalAddresses = true"
        >
          <span class="flex gap-2 items-center text-[#1775a5]">
            <span class="w-4 h-4 bg-[#1775a5] rounded-full p-0.5 text-white">
              <x-shared.icons.plus></x-shared.icons.plus>
            </span>
            Add More Location Details
          </span>
          <span class="text-gray-500">Add additional locations to help with accuracy or search-ability.</span>
        </a>
      </fieldset>
    </div>

    <fieldset class="border-b pb-5 md:pb-10">
      <legend class="text-primary font-semibold text-lg">Description</legend>
      <x-shared.text-editor
        name="description"
      >{{ old('description') }}</x-shared.text-editor>
    </fieldset>

    <div class="flex flex-col gap-4">
      <p class="text-gray-600 text-sm">Add contact info, public access, categories, settings and more.</p>

      <div
        x-collapse
        x-show="showMoreDetails"
        class="flex flex-col gap-2"
      >
        <fieldset class="flex flex-col gap-1 border-b pb-5 md:pb-10">
          <legend class="text-primary font-semibold">Contact Info</legend>
          <div class="flex flex-col gap-4">
            <div class="flex flex-col sm:flex-row gap-4">
              <x-shared.field
                label="Email"
                name="more[email]"
                class="bg-gray-50"
                :value="old('more.email')"
                :errors="$errors->get('more.email')"
              ></x-shared.field>
              <x-shared.field
                type="url"
                class="bg-gray-50"
                name="more[website]"
                :value="old('more.website')"
                :errors="$errors->get('more.website')"
                label="Website (https://www.example.com)"
              ></x-shared.field>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
              <x-shared.field
                type="tel"
                label="Phone"
                name="more[phone]"
                class="bg-gray-50"
                :value="old('more.phone')"
                :errors="$errors->get('more.phone')"
              ></x-shared.field>
              <div class="w-full"></div>
            </div>
            <div class="w-full md:w-2/3">
              <x-shared.field
                type="textarea"
                class="bg-gray-50"
                label="Office Address"
                name="more[office_address]"
                :value="old('more.office_address')"
                :errors="$errors->get('more.office_address')"
              ></x-shared.field>
            </div>
          </div>
        </fieldset>

        <fieldset class="flex flex-col gap-2 border-b pb-5 md:pb-10">
          <legend class="text-primary font-semibold">Cemetery Status</legend>
          <div class="flex flex-col gap-2 pb-0 md:pb-5 pt-5 items-start">
            @foreach(\App\Enums\EnumVisibility::asOptions() as $index => $option)
              <x-shared.radio
                name="more[visibility]"
                :label="$option['label']"
                :value="$option['value']"
                :checked="!empty(old('more.visibility')) ? intval(old('more.visibility')) === $option['value'] : !$index"
              ></x-shared.radio>
            @endforeach
          </div>
        </fieldset>

        <fieldset class="flex flex-col gap-2 border-b pb-5 md:pb-10">
          <legend class="text-primary font-semibold">Additional Information</legend>
          <p class="text-xs text-gray-500">
            Enter additional information about the cemetery such as directions or special instructions for taking photos.
          </p>
          <div class="w-full md:w-2/3">
            <x-shared.text-editor
              name="more[additional_info]"
            >{{ old('more.additional_info') }}</x-shared.text-editor>
          </div>
        </fieldset>
      </div>
      <div x-show="!showMoreDetails">
        <x-shared.btn
          @click.prevent="showMoreDetails = true"
          class="flex gap-2 items-center border text-[#1775a5] rounded-md py-1.5"
        >
          <span class="w-4 h-4 bg-[#1775a5] text-white p-0.5 rounded-full">
            <x-shared.icons.plus></x-shared.icons.plus>
          </span>
          Add More Details
        </x-shared.btn>
      </div>
    </div>

    <div class="bg-gray-100 py-4 px-4">
      <x-shared.btn
        type="submit"
        variant="primary"
        class="rounded-md px-5"
      >
        Create Cemetery
      </x-shared.btn>
    </div>
  </form>
</section>
