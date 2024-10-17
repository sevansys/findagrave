<section class="py-5 px-2">
  <div
    x-cloak
    x-data="{
      cemeteries: null,
      isLoading: false,
      notBuriedInCemetery: false,

      onCemeterySelect(cemetery) {
        window.location.search = '?cemetery_id=' + cemetery.id
      },
    }"
    class="max-w-screen-md mx-auto w-full bg-white border rounded-md py-10 flex flex-col gap-10"
  >
    <div class="flex flex-col gap-5 text-center text-gray-500 text-lg px-2">
      <h1 class="text-4xl font-semibold text-primary">Add Memorial</h1>
      <p>Step 1 of 2 — Memorial Location</p>
      <p>1. Choose a Cemetery</p>
    </div>
    <div class="flex flex-col gap-5 items-start max-w-lg w-full mx-auto px-2">
      <div
        x-collapse
        class="w-full"
        x-show="!notBuriedInCemetery"
      >
        <x-features.search.cemetery
          ajax
          class="flex-col max-w-full"
          ajax-error-evaluate-key="errors"
          ajax-data-evaluate-key="cemeteries"
          ajax-loading-evaluate-key="isLoading"
        ></x-features.search.cemetery>
      </div>

      <x-shared.checkbox
        name="not-buried-in-cemetery"
        label="Not buried in a cemetery?"
        @change="(event) => notBuriedInCemetery = !!event.target?.checked"
      ></x-shared.checkbox>

      <div
        x-collapse
        class="w-full"
        x-show="notBuriedInCemetery"
      >
        <x-features.cemeteries.not-bured-in-cemetery></x-features.cemeteries.not-bured-in-cemetery>
      </div>
    </div>
    <div x-show="cemeteries !== null || isLoading" class="border-t py-5">
      <div class="flex flex-col gap-5 w-full px-0 sm:px-5 md:px-10">
        <template x-if="isLoading">
          <div class="flex justify-center px-5 py-2">
            <x-shared.loading :size="60"></x-shared.loading>
          </div>
        </template>
        <template x-if="!isLoading && cemeteries?.length">
          <p class="text-gray-500 text-center text-lg">2. Please select a cemetery below</p>
        </template>
        <div class="flex flex-col">
          <template x-for="cemetery in cemeteries ?? []" :key="cemetery.id">
            <x-entities.cemetery.list-item-alpine
              x-data="cemetery"
              class="border-b p-2"
              @click.prevent="() => onCemeterySelect(cemetery)"
            ></x-entities.cemetery.list-item-alpine>
          </template>
        </div>
      </div>
    </div>
  </div>
</section>
