<div {{ $attributes->merge([
  'class' => 'flex flex-col gap-4 w-full'
]) }}>
  <x-shared.combobox
    name="burial-type"
    placeholder="Choose a burial type"
    :options="\App\Enums\EnumBurial::asOptions()"></x-shared.combobox>
  <x-shared.field
    type="textarea"
    name="other-burial-details"
    label="Add any other burial details (OPTIONAL)"></x-shared.field>

  <div>
    <x-shared.btn
      type="submit"
      variant="primary"
      class="py-2 px-4 rounded-lg"
    >Continue</x-shared.btn>
  </div>
</div>
