<a
  {{ $attributes->merge([
    ':href' => 'href',
    'target' => '_blank',
    'class' => 'flex gap-4 items-center hover:bg-gray-50',
  ]) }}
>
  <picture class="border p-0.5 w-20 h-20 flex">
    <img :src="image" :alt="name" class="w-full h-full object-contain object-center" />
  </picture>
  <div class="flex flex-col flex-1 gap-0 text-sm">
    <h4 x-html="name" class="text-lg text-[#1775a5] hover:text-[#0e4562] hover:underline"></h4>
    <address x-show="address" x-html="address"></address>
    <template x-for="(altName, index) in (alt_name ?? [])" :key="`altName.${id}.${index}`">
      <p x-html="altName" class="text-sm"></p>
    </template>
  </div>
  <div class="flex flex-col gap-2">
    <a
      x-show="memorialsCount"
      :href="`cemetery/${id}/memorial-search`"
      class="link flex items-center gap-1"
    >
      <span class="w-4 h-4">
        <x-shared.icons.grave></x-shared.icons.grave>
      </span>
      <span>
        <span x-html="memorialsCount"></span>
        memorials
      </span>
    </a>
    <a
      x-show="photographed"
      class="link flex items-center gap-1"
      :href="`cemetery/${id}/memorial-search?filter[photographed]=true`"
    >
      <span class="w-4 h-4">
        <x-shared.icons.camera></x-shared.icons.camera>
      </span>
      <span>
        <span x-html="`${photographed}%`"></span>
        photographed
      </span>
    </a>
  </div>
</a>
