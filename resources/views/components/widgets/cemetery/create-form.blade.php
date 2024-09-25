<section>
  <header class="border-b py-5 text-sm text-gray-500">
    <div class="max-w-screen-md mx-auto w-full">
      <p>Please provide details about this cemetery. If you are unsure about non-required fields, simply leave them blank.</p>
      <a href="#" class="link">Learn more about adding a cemetery.</a>
    </div>
  </header>

  <form
    x-data="{
      locationId: null,
      showMoreDetails: false,
      showAdditionalAddresses: false,
      addresses: [{ id: null, name: null }],
      location: '{{ request()->get('location') }}',
    }"
    action=""
    class="flex flex-col gap-5 max-w-screen-md mx-auto w-full py-5"
  >
    <div class="border-b pb-10">
      <fieldset class="flex flex-col gap-2 w-1/2">
        <legend class="text-primary text-lg font-semibold">Cemetery Name(s)</legend>
        <x-shared.field
          required
          name="name"
          class="bg-gray-50"
          label="Cemetery name (Required)"
          :value="request()->get('name')"></x-shared.field>
      </fieldset>
    </div>

    <div class="border-b pb-10">
      <fieldset class="flex flex-col gap-4">
        <legend class="text-primary text-lg font-semibold">Location</legend>
        <div class="flex flex-col gap-4 w-2/3">
          <div class="flex gap-2 items-center">
            <x-shared.field
              required
              name="name"
              class="bg-gray-50"
              x-bind:value="location"
              label="Location for search (Required)"></x-shared.field>
            <input type="hidden" :value="locationId" name="location-id" />
            <x-shared.dialog.browse-locations>
              <a class="link">Browse</a>
            </x-shared.dialog.browse-locations>
          </div>

          <div class="flex gap-2 items-start">
            <x-shared.btn class="px-5 bg-gray-600 hover:bg-gray-800 transition-colors rounded-md text-white text-sm">
              <span class="w-5 h-5 inline-block align-middle">
                <x-shared.icons.location></x-shared.icons.location>
              </span>
              SET GPS AND ADDRESS USING MAP
            </x-shared.btn>
            <x-shared.field
              required
              type="textarea"
              name="street-address"
              label="Street Address"></x-shared.field>
          </div>

          <div class="flex gap-2">
            <x-shared.field
              label="Latitude"
              class="bg-gray-50"
              name="latitude"></x-shared.field>
            <x-shared.field
              label="Longitude"
              class="bg-gray-50"
              name="longitude"></x-shared.field>
          </div>
        </div>

        <div
          x-collapse
          class="flex flex-col gap-2"
          x-show="showAdditionalAddresses"
        >
          <p class="text-sm text-gray-500">Some cemeteries may span city or county boundaries. You can include additional municipalities here.</p>

          <div class="w-2/3 flex flex-col gap-2">
            <template x-for="(address, index) in addresses" :key="`address.${index}`">
              <div class="flex gap-2 items-center">
                <x-shared.field
                  required
                  class="bg-gray-50"
                  name="address-name[]"
                  x-bind:value="address.name"
                  label="Additional City or County"></x-shared.field>
                <input type="hidden" :value="address.id" name="address-id[]" />
                <x-shared.dialog.browse-locations>
                  <a class="link">Browse</a>
                </x-shared.dialog.browse-locations>
                <template x-if="index">
                  <a
                    href="#"
                    @click.prevent="() => addresses.splice(index, 1)"
                    class="w-8 h-8 flex px-2 py-1 rounded text-[#aa2b27] hover:text-white hover:bg-[#aa2b27] transition-colors"
                  >
                    <x-shared.icons.trash></x-shared.icons.trash>
                  </a>
                </template>
              </div>
            </template>
          </div>

          <div>
            <a href="#" class="inline-flex gap-2 p-1 text-[#1775a5] items-center" @click.prevent="addresses.push({ id: null, name: null })">
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

    <fieldset class="border-b pb-10">
      <legend class="text-primary font-semibold text-lg">Description</legend>
      <x-shared.text-editor></x-shared.text-editor>
    </fieldset>

    <div class="flex flex-col gap-4">
      <p class="text-gray-600 text-sm">Add contact info, public access, categories, settings and more.</p>

      <div
        x-collapse
        x-show="showMoreDetails"
        class="flex flex-col gap-2"
      >
        <fieldset class="flex flex-col gap-1 border-b pb-10">
          <legend class="text-primary font-semibold">Contact Info</legend>
          <div class="flex flex-col gap-4">
            <div class="flex gap-2">
              <x-shared.field
                name="email"
                label="Email"></x-shared.field>
              <x-shared.field
                name="website"
                label="Website (https://www.example.com)"></x-shared.field>
            </div>
            <div class="w-1/2">
              <x-shared.field
                name="phone"
                label="Phone"></x-shared.field>
            </div>
            <div class="w-2/3">
              <x-shared.field
                type="textarea"
                name="office-address"
                label="Office Address"></x-shared.field>
            </div>
          </div>
        </fieldset>

        <fieldset class="flex flex-col gap-2 border-b pb-10">
          <legend class="text-primary font-semibold">Cemetery Status</legend>

        </fieldset>

        <fieldset class="flex flex-col gap-2 border-b pb-10">
          <legend class="text-primary font-semibold">Additional Information</legend>
          <p class="text-xs text-gray-500">
            Enter additional information about the cemetery such as directions or special instructions for taking photos. One entry per language.
          </p>
          <div class="w-2/3">
            <x-shared.text-editor></x-shared.text-editor>
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
