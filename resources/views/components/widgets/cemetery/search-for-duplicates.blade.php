<div class="flex flex-col gap-20">
  <h2 class="text-primary text-2xl font-semibold text-center">Search for duplicates</h2>

  <form
    method="GET"
    action="/cemetery/create"
    x-data="{ cemeteriesIsNotFound: false }"
    class="max-w-screen-lg px-24 min-h-48 mx-auto w-full">
    <x-features.search.cemetery
      :types="$types"
      :show-hint="false"></x-features.search.cemetery>

    <div x-show="cemeteriesIsNotFound" class="flex flex-col gap-1 items-center py-10 text-gray-500">
      <h4 class="text-xl font-semibold">No results found</h4>
      <p class="mb-5">Still can't find a matching cemetery? You can add a cemetery now.</p>
      <x-shared.btn
        type="submit"
        class="flex gap-2 border rounded-md py-2 items-center text-[#1775a5]">
        <span class="w-5 h-5 bg-[#1775a5] text-white rounded-full p-0.5">
          <x-shared.icons.plus></x-shared.icons.plus>
        </span>
        Add Cemetery
      </x-shared.btn>
    </div>
  </form>
</div>
