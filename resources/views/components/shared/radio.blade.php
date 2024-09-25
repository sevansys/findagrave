@props([
  'name' => null,
  'value' => null,
  'label' => null,
])

<label class="flex">
  <input
    type="radio"
    name="{{ $name }}"
    value="{{ $value }}"
    class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" />
  <span class="text-sm text-gray-500 ms-2 dark:text-neutral-400">{{ $label }}</span>
</label>
