<div {{ $attributes->merge([
  'class' => 'flex flex-col gap-6 px-3 text-gray-500'
]) }}>
  <div class="flex flex-col gap-1">
    <div class="flex justify-between gap-1">
    <span class="flex gap-2 items-center">
      <span class="w-5 h-5">
        <x-shared.icons.grave></x-shared.icons.grave>
      </span>
      <b>Total memorials added:</b>
    </span>
      <a href="#" class="link">600</a>
    </div>
    <div class="flex justify-between items-center gap-1">
    <span class="flex gap-2 items-center">
      <span class="bg-[#dd1c80] w-4 h-4 rounded-full"></span>
      <b>Memorials with GPS:</b>
    </span>
      <a href="#" class="link">242</a>
    </div>
    <div class="flex items-center justify-center gap-1">
      <span>Without grave photo -</span>
      <span class="w-4 h-4 bg-[#fdb32b] rounded-full"></span>
    </div>
  </div>

  <a href="#" class="link flex items-center px-3 gap-1">
    <span class="w-4 h-4">
      <x-shared.icons.info></x-shared.icons.info>
    </span>
    <span>Why GPS is important</span>
  </a>

  <form action="" method="GET" class="flex flex-col gap-1">
    <b class="text-primary">Search this map area</b>
    <div class="flex">
      <x-shared.field
        autofocus
        :float-label="false"
        label="Search names"
        class="rounded-tr-none rounded-br-none"
      ></x-shared.field>
      <x-shared.btn
        type="reset"
        :lofty="false"
        class="rounded-tr-md rounded-br-md bg-gray-200 py-1"
      >
        <span class="flex w-5 h-5">
          <x-shared.icons.cross></x-shared.icons.cross>
        </span>
      </x-shared.btn>
    </div>
  </form>

  <div class="flex flex-col gap-2 text-sm py-4">
    <span class="text-center">
      <b class="inline-flex gap-1">
        <span class="w-4 h-4">
          <x-shared.icons.info></x-shared.icons.info>
        </span>
        <span>Tip</span>
      </b>
      <span>Hold down the SHIFT key and drag the mouse to select multiple memorials in a section of the cemetery.</span>
    </span>
    <div class="flex justify-center">
      <a href="#" class="inline-flex px-2 py-0.5 border border-[#5C60A3] text-xs text-[#5C60A3] rounded">
        More Tips
      </a>
    </div>
  </div>
</div>
