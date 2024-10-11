<x-shared.dialog name="browse-locations" container-clsx="p-0.5 md:p-5">
  <div x-data="browseLocations" class="max-w-screen-2xl flex flex-col overflow-hidden h-full">
    <header class="bg-[#5c60a3] text-white flex justify-between items-center">
      <h4 class="px-5 text-lg font-semibold">Browse</h4>
      <a href="#" class="w-14 h-14 p-3 flex opacity-50 hover:opacity-100" @click.prevent="() => close()">
        <x-shared.icons.cross></x-shared.icons.cross>
      </a>
    </header>

    <div class="grid grid-cols-browse-locations p-4 overflow-x-auto overflow-y-hidden max-h-full flex-1">
      <template x-for="(item, index) in data">
        <div class="flex flex-col max-h-[400px] h-screen overflow-hidden">
          <div class="bg-gray-100 py-1 px-3" x-html="getTitle(item.type)"></div>
          <div class="border flex flex-col overflow-y-auto">
            <template x-for="option in item.options">
              <a
                x-html="option.text"
                :href="`#${option.id}`"
                class="py-2 px-4 border-b flex hover:bg-gray-100"
                :class="{
                  'hover:bg-gray-100': !isSelected(index, option),
                  'bg-gray-200': isSelectedParent(index, option),
                  'bg-[#5c60a3] text-white': isCurrenSelected(index, option)
                }"
                @click.prevent="() => select(index, option)"></a>
            </template>
          </div>
        </div>
      </template>
    </div>

    <footer class="bg-gray-50 py-2 px-2 md:px-5 flex gap-8 justify-between items-center">
      <div class="flex items-center gap-1 text-primary overflow-hidden">
        <span class="w-4 h-4 flex-shrink-0">
          <x-shared.icons.location></x-shared.icons.location>
        </span>
        <span x-html="selectedLocations" class="overflow-hidden text-ellipsis text-nowrap"></span>
      </div>

      <div class="flex gap-2 flex-grow-0 flex-shrink-0">
        <x-shared.btn
          type="button"
          variatn="white"
          @click.prevent="clear()"
          class="py-1.5 rounded-md bg-white border"
        >Clear</x-shared.btn>
        <x-shared.btn
          type="button"
          variant="primary"
          class="py-1.5 rounded-md"
          x-bind:disabled="noneSelected"
          @click.prevent="useSelectedLocations">Use Selected Location</x-shared.btn>
      </div>
    </footer>
  </div>
</x-shared.dialog>
