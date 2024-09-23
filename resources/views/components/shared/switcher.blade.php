<label x-data="{ toggle: '0' }" class="flex gap-2 justify-center items-center cursor-pointer text-gray-700">
  <span
    class="relative rounded-full w-10 h-5 transition duration-200 ease-linear"
     :class="[toggle === '1' ? 'bg-[{{ $activeColor }}]' : 'bg-gray-400']"
  >
    <span class="absolute left-0 bg-white border-2 mb-2 w-5 h-5 rounded-full transition transform duration-100 ease-linear cursor-pointer"
           :class="[toggle === '1' ? 'translate-x-full border-[{{ $activeColor }}]' : 'translate-x-0 border-gray-400']"></span>
    <input type="checkbox"
           name="{{ $name }}"
           value="{{ $value }}"
           class="appearance-none w-full h-full active:outline-none focus:outline-none"
           @click="toggle === '0' ? toggle = '1' : toggle = '0'"/>
  </span>
  {{ $slot }}
</label>
