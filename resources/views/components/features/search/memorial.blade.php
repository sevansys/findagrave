<form action="" method="GET" class="max-w-screen-md mx-auto flex flex-col gap-4 py-4">
  <x-shared.fields-group clsx="gap-0">
    <x-shared.field
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
          clsx="rounded-lg rounded-tl-none rounded-bl-none -ml-1.5 flex items-center gap-2">
          <span x-html="selectedLabel" class="text-nowrap"></span>
          <x-shared.icons.arrow-down></x-shared.icons.arrow-down>
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
        <x-shared.btn clsx="rounded-lg rounded-tl-none rounded-bl-none -ml-1.5 flex items-center gap-2">
          <span x-html="selectedLabel" class="text-nowrap"></span>
          <x-shared.icons.arrow-down></x-shared.icons.arrow-down>
        </x-shared.btn>
      </x-shared.dropdown>
    </div>

    <div class="flex gap-0 items-stretch">
      <x-shared.field
        type="address"
        label="Cemetery Location"
        field-clsx="rounded-tr-none rounded-br-none"></x-shared.field>
      <x-shared.dialog>
        <x-slot name="activator">
          <x-shared.btn clsx="rounded-lg rounded-tl-none rounded-bl-none -ml-1.5 relative">Browse</x-shared.btn>
        </x-slot>
        AA
      </x-shared.dialog>
    </div>
  </x-shared.fields-group>

  <div class="flex flex-col gap-4">
    <x-shared.fields-group clsx="gap-2 fields-group_3_3_1">
      <x-shared.field label="Bio keywords"></x-shared.field>
      <x-shared.field label="Spouse, Parent, Child or Sibling name"></x-shared.field>
      <x-shared.field label="Plot"></x-shared.field>
    </x-shared.fields-group>

    <x-shared.fields-group clsx="gap-2 fields-group_1_1_1_1">
      <x-shared.field type="number" name="memorial-id" label="Memorial ID"></x-shared.field>
      <x-shared.field type="number" name="contributor-id" label="Contributor ID"></x-shared.field>
      <x-shared.dropdown
        label="Added Date"
        :options="\App\Enums\EnumDateAdded::options()"
        :value="\App\Enums\EnumDateAdded::NONE->value"
      ></x-shared.dropdown>
      <x-shared.dropdown
        label="Order By"
        :options="\App\Enums\EnumOrderBy::options()"
        :value="\App\Enums\EnumOrderBy::NONE->value"
      ></x-shared.dropdown>
    </x-shared.fields-group>
  </div>

  <div class="flex gap-4">
    <x-shared.btn type="submit" variant="primary" clsx="rounded-lg px-5 py-2 text-lg font-bold uppercase">Search</x-shared.btn>
    <a href="#">More search options</a>
    <a href="#">Search tips</a>
  </div>
</form>
