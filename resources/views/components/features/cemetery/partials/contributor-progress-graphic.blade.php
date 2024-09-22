@props([
  'gps' => 0,
  'photographed' => 0,
])

<div class="flex flex-col items-center">
  <div class="relative flex justify-center items-center w-28 h-28">
    <span class="absolute top-0 left-0">
      <x-shared.svg-progress
        :size="112"
        color="#328800"></x-shared.svg-progress>
      <span class="absolute top-3 left-3">
          <x-shared.svg-progress
            :size="88"
            :stroke-width="20"
            color="#c60"></x-shared.svg-progress>
      </span>
    </span>
    <span class="bg-[#5c60a3] text-white rounded-full flex w-12 h-12 p-2.5 m-0.5 relative z-10">
      <x-shared.icons.cemetery></x-shared.icons.cemetery>
    </span>
  </div>
</div>
