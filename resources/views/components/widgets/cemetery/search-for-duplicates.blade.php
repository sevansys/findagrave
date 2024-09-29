<div
  class="flex flex-col gap-20"
  x-data="{
    data: null,
    error: null,
    isLoading: false,
    onSubmit(event) {
      const formData = new FormData(event.target)

      this.isLoading = true;
      window.axios.get('/cemeteries/search', {
        params: Object.fromEntries(formData.entries())
      }).then((response) => {
        this.data = response.data?.data ?? [];
        this.error = null;
      }).catch(({ response }) => {
        this.data = null;
        this.error = response.data?.message ?? null;
      }).finally((() => this.isLoading = false))
    }
  }"
>
  <h2 class="text-primary text-2xl font-semibold text-center">Search for duplicates</h2>


  <div class="max-w-screen-lg min-h-48 mx-auto w-full flex flex-col gap-5">
    <div class="px-24 flex flex-col gap-2">
      <x-features.search.cemetery
        :types="$types"
        @submit.prevent="onSubmit"
        class="grid grid-cols-2|3|auto"
        :show-hint="false"></x-features.search.cemetery>
      <template x-if="error">
        <p x-html="error" class="text-red-600 font-semibold"></p>
      </template>
    </div>

    <div x-show="isLoading" class="flex justify-center py-5">
      <x-shared.loading :size="60"></x-shared.loading>
    </div>

    <div class="flex flex-col gap-0">
      <template x-for="cemetery in (data ?? [])" :key="`cemetery.${cemetery.id}`">
        <x-entities.cemetery.list-item-alpine
          class="border-b p-2"
          x-data="cemetery"></x-entities.cemetery.list-item-alpine>
      </template>

      <div
        x-show="data !== null"
        class="flex flex-col gap-1 items-center py-1 text-gray-500"
      >
        <h4 x-show="data !== null && data.length === 0" class="text-xl font-semibold">No results found</h4>
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
    </div>
  </div>
</div>
