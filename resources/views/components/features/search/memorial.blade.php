<form
  x-cloak
  action=""
  method="GET"
  class="search-form"
  :class="{ 'search-form--expanded': expanded }"
  x-data="memorialsSearch({
    expanded: {{ $expanded ? 'true' : 'false' }}
  })"
>
  @if($showTitle)
    <h1 class="text-primary text-2xl px-{{ $px }} search-form__title max-w-screen-md mx-auto">{{ $title }}</h1>
  @endif

  <div class="pt-4 flex flex-col gap-4">
    <section class="search-form__fields max-w-screen-md w-full px-{{ $px }} mx-{{ $mx }} flex flex-col gap-2">
      <x-shared.fields-group clsx="gap-0">
        <x-shared.field
          autofocus
          name="first-name"
          label="First Name"></x-shared.field>
        <x-shared.field
          name="middle-name"
          label="Middle Name"></x-shared.field>
        <x-shared.field
          name="last-name"
          label="Last Name(s)"></x-shared.field>
      </x-shared.fields-group>

      <x-shared.fields-group clsx="gap-2 fields-group_1_1_2">
        <div class="flex gap-0 items-stretch">
          <x-shared.field
            name="born"
            type="number"
            label="Year Born"
            field-clsx="rounded-tr-none rounded-br-none"></x-shared.field>
          <x-shared.dropdown
            name="born-filter"
            :options="\App\Enums\EnumYearFilter::options()"
            :value="\App\Enums\EnumYearFilter::EXACT->value"
          >
            <x-shared.btn
              :lofty="false"
              class="rounded-lg rounded-tl-none rounded-bl-none -ml-1.5 bg-gray-200 flex items-center gap-2">
              <span x-html="selectedLabel" class="text-nowrap"></span>
              <span class="w-5 h-5">
                <x-shared.icons.arrow-down></x-shared.icons.arrow-down>
              </span>
            </x-shared.btn>
          </x-shared.dropdown>
        </div>

        <div class="flex gap-0 items-stretch">
          <x-shared.field
            name="died"
            type="number"
            label="Year Died"
            field-clsx="rounded-tr-none rounded-br-none"></x-shared.field>
          <x-shared.dropdown
            name="died-filter"
            :options="\App\Enums\EnumYearFilter::options()"
            :value="\App\Enums\EnumYearFilter::EXACT->value"
          >
            <x-shared.btn
              :lofty="false"
              class="rounded-lg rounded-tl-none rounded-bl-none -ml-1.5 flex items-center bg-gray-200 gap-2">
              <span x-html="selectedLabel" class="text-nowrap"></span>
              <span class="w-5 h-5">
                <x-shared.icons.arrow-down></x-shared.icons.arrow-down>
              </span>
            </x-shared.btn>
          </x-shared.dropdown>
        </div>

        <div
          @class([
            'gap-0 items-stretch',
            'flex' => !$withoutCemeteryLocation,
            'hidden xl:flex' => $withoutCemeteryLocation,
          ])
        >
          @if(!$withoutCemeteryLocation)
            <x-shared.autocomplete
              required
              ref="location"
              name="location"
              value-name="location_id"
              label="Cemetery Location"
              base-url="/locations/autocomplete"
              :error="$errors->get('location_id')"
              field-clsx="rounded-tr-none rounded-br-none border-r-0"
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
                <x-shared.btn
                  :lofty="false"
                  x-dialog.browse-locations="{ onSelect({ id, path }) { query=path, inputValue=id } }"
                  class="rounded-lg self-stretch rounded-tl-none rounded-bl-none bg-gray-200 -ml-2 relative"
                >
                  Browse
                </x-shared.btn>
              </x-slot>
            </x-shared.autocomplete>
          @endif
        </div>
      </x-shared.fields-group>
    </section>

    <div
      x-collapse
      x-show="expanded">
      <section
        class="search-form__additional-fields max-w-screen-md w-full px-{{ $px }} mx-{{ $mx }} pb-4 flex flex-col gap-2"
      >
        <x-shared.fields-group clsx="gap-2 fields-group_3_3_1">
          <x-shared.field label="Bio keywords"></x-shared.field>
          <x-shared.field label="Spouse, Parent, Child or Sibling name"></x-shared.field>
          <x-shared.field label="Plot"></x-shared.field>
        </x-shared.fields-group>

        <x-shared.fields-group clsx="gap-2 fields-group--no-shrink fields-group_1_1_1_1">
          <x-shared.field type="number" name="memorial-id" label="Memorial ID"></x-shared.field>
          <x-shared.field type="number" name="contributor-id" label="Contributor ID"></x-shared.field>
          <x-shared.dropdown
            fluid
            label="Added Date"
            :options="\App\Enums\EnumDateAdded::options()"
            :value="\App\Enums\EnumDateAdded::NONE->value"
          ></x-shared.dropdown>
          <x-shared.dropdown
            fluid
            label="Order By"
            :options="\App\Enums\EnumOrderBy::options()"
            :value="\App\Enums\EnumOrderBy::NONE->value"
          ></x-shared.dropdown>
        </x-shared.fields-group>
      </section>

      <div class="search-form__checkboxes py-5">
        <section class="max-w-screen-md w-full mx-{{ $mx }} px-{{ $px }} grid gap-14 grid-cols-2 sm:grid-cols-3">
          @if(!empty($types))
            <div class="flex flex-col gap-4">
              <h4>By Memorial Types:</h4>
              @foreach($types as $name => $label)
                <x-shared.checkbox
                  name="{{ $name }}"
                  label="{{ $label }}"
                  label-clsx="text-sm"></x-shared.checkbox>
              @endforeach
            </div>
          @endif

          @if(!empty($include))
            <div class="flex flex-col gap-4">
              <h4>Include:</h4>
              @foreach($include as $name => $label)
                <x-shared.checkbox
                  name="{{ $name }}"
                  label="{{ $label }}"
                  label-clsx="text-sm"></x-shared.checkbox>
              @endforeach
            </div>
          @endif

          @if(!empty($with))
            <div class="flex flex-col gap-4">
              <h4>Memorials with:</h4>
              @foreach($with as $name => $label)
                <x-shared.checkbox
                  name="{{ $name }}"
                  label="{{ $label }}"
                  label-clsx="text-sm"></x-shared.checkbox>
              @endforeach
            </div>
          @endif
        </section>
      </div>
    </div>
  </div>

  <div
    @class([
      'pt-6' => $compact,
      'pt-16' => !$compact,
      'flex flex-col gap-3 md:gap-10 search-form__actions',
    ])
  >
    <section class="max-w-screen-md w-full px-{{ $px }} pb-4 mx-{{ $mx }}">
      <div class="flex flex-wrap gap-1 sm:gap-2 md:gap-5 items-center">
        <x-shared.btn
          type="submit"
          variant="primary"
          class="rounded-lg px-5 py-2 text-lg font-bold uppercase">
          {{ $submitText }}
        </x-shared.btn>
        <a
          href="#"
          @click.prevent="expanded = !expanded"
          class="p-2 rounded-md flex gap-1 items-center text-primary hover:underline">
          <span>More search options</span>
          <span
            :class="{ 'rotate-180': expanded }"
            class="w-5 h-5 transition-transform">
            <x-shared.icons.arrow-down></x-shared.icons.arrow-down>
          </span>
        </a>
        <x-shared.dialog.search-tips>
          <a href="#" @click.prevent class="p-2 hover:underline text-primary rounded-md flex gap-0 items-center">
            <span class="w-4 h-4 mr-2">
              <x-shared.icons.info></x-shared.icons.info>
            </span>
            <span>Search tips</span>
            <span class="w-6 h-6">
              <x-shared.icons.arrow-right></x-shared.icons.arrow-right>
            </span>
          </a>
        </x-shared.dialog.search-tips>
      </div>
    </section>

    @if(!empty($slot))
      {{ $slot }}
    @endif
  </div>
</form>
