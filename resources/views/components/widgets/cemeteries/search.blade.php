<section class="bg-[#fcf2e0] flex flex-col gap-4 pt-6 md:pt-3 pb-6 md:pb-5 px-3">
  <div class="max-w-screen-xl w-full mx-auto flex flex-col lg:flex-row gap-6 md:gap-12 lg:gap-24">
    <div class="flex-1 flex flex-col gap-4">
      <div class="flex flex-col gap-1">
        <h1 class="font-normal text-2xl text-primary">Search 580,095 cemeteries in 249 different countries</h1>
        <x-features.search.cemetery
          action="/cemeteries"
          class="grid grid-cols-1 sm:grid-cols-cemetery-search"
        ></x-features.search.cemetery>
      </div>
      <x-features.actions.cemeteries
        justify="center"
        class="lg:justify-start"
      ></x-features.actions.cemeteries>
    </div>
    <div class="w-full lg:w-1/4 min-h-10">
      <x-shared.content-ad h="full"></x-shared.content-ad>
    </div>
  </div>
</section>
