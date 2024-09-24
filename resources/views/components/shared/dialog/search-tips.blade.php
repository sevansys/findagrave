<x-shared.dialog dialog-clsx="max-w-screen-md mt-20">
  <x-slot name="activator">
    {{ $slot }}
  </x-slot>

  <div class="flex flex-col p-8">
    <ul class="list-disc px-2">
      <li>
        When searching in a cemetery, use the ? or * wildcards in name fields. ? replaces one letter. *
        represents zero to many letters. <i>E.g. Sorens?n or Wil*</i>
      </li>
      <li>Search for an exact birth/death year or select a range, before or after.</li>
      <li>
        <span>Select "More search options" to:</span>
        <ul class="list-disc pl-6">
          <li>Search for a memorial or contributor by <b>ID</b>.</li>
          <li>Include the name of a <b>spouse</b>, <b>parent</b>, <b>child or sibling</b> in your search.</li>
          <li>Use partial name search or similar name spellings to catch alternate spellings or broaden your search.</li>
          <li>Narrow your results to famous, Non-Cemetery Burials, memorials with or without grave photos and more.</li>
        </ul>
      </li>
    </ul>

    <p>
      Get more help from our <a href="#" class="link">Help Center</a>.
    </p>
  </div>

  <div class="flex justify-end border-t py-3 px-4">
    <span @click="() => close()">
      <x-shared.btn class="rounded px-5 py-2 bg-gray-100">Close</x-shared.btn>
    </span>
  </div>
</x-shared.dialog>
