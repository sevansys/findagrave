<label @class(['checkbox inline-flex', $clsx])>
  <span class="flex items-center cursor-pointer relative">
    <input
      type="checkbox"
      @checked($checked)
      @required($required)
      {{ $attributes->merge([
        'name' => $name,
        'value' => $value,
        'class' => 'peer h-5 w-5 bg-white cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-300 checked:bg-[#c60] checked:border-[#c60]'
      ]) }}
    />
    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
      <span class="block h-3 w-3">
        <x-shared.icons.tick></x-shared.icons.tick>
      </span>
    </span>
  </span>

  @if($label)
    <span @class(['cursor-pointer ml-2', $labelClsx])>
      {{ $label }}
    </span>
  @endif
</label>
