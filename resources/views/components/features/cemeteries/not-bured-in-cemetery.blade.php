<form
  method="GET"
  {{ $attributes->merge([
    'class' => 'flex flex-col gap-4 w-full'
  ]) }}
>
  <div class="flex flex-col gap-1.5">
    <x-shared.combobox
      required
      name="burial_type"
      placeholder="Choose a burial type"
      :options="\App\Enums\EnumBurial::asOptions()"
    ></x-shared.combobox>
  </div>


  <x-shared.field
    type="textarea"
    name="burial_details"
    label="Add any other burial details (OPTIONAL)"
  ></x-shared.field>

  <input type="hidden" name="cemetery_id" value="" />

  <div>
    <x-shared.btn
      type="submit"
      variant="primary"
      class="py-2 px-4 rounded-lg"
    >Continue</x-shared.btn>
  </div>
</form>
