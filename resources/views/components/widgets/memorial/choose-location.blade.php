<section>
  <div
    x-cloak
    x-data="{ notBuriedInCemetery: false }"
    class="max-w-screen-sm mx-auto w-full border rounded-md py-10 px-5 flex flex-col gap-10">
    <div class="flex flex-col gap-5 text-center text-gray-500 text-lg">
      <h1 class="text-4xl font-semibold text-primary">Add Memorial</h1>
      <p>Step 1 of 2 — Memorial Location</p>
      <p>1. Choose a Cemetery</p>
    </div>
    <form action="" class="flex flex-col gap-5 items-start max-w-md w-full mx-auto">
      <div
        x-collapse
        class="w-full"
        x-show="!notBuriedInCemetery"
      >
        <x-features.search.cemetery
          class="flex-col w-full"></x-features.search.cemetery>
      </div>

      <x-shared.checkbox
        name="not-buried-in-cemetery"
        label="Not buried in a cemetery?"
        @change="(event) => notBuriedInCemetery = !!event.target?.checked"
      ></x-shared.checkbox>

      <div x-collapse x-show="notBuriedInCemetery" class="w-full">
        <x-features.cemeteries.not-bured-in-cemetery></x-features.cemeteries.not-bured-in-cemetery>
      </div>
    </form>
  </div>
  <div ></div>
</section>
