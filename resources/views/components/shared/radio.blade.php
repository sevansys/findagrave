@props([
  'name' => null,
  'value' => null,
  'label' => null,
  'checked' => null,
  'required' => null,
])

<label class="inline-flex items-center gap-2 cursor-pointer text-neutral-600 hover:text-black">
  <input
    type="radio"
    name="{{ $name }}"
    value="{{ $value }}"
    @required($checked)
    @checked($checked)
    class="form-radio h-5 w-5 text-black checked:ring-black focus:ring-black"
  >
  <span class="ml-2 text-gray-800">{{ $label }}</span>
</label>
