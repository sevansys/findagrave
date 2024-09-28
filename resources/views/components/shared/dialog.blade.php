<div x-data="dialog"  @class(['dialog', $clsx])>
  <label @click="() => open()" class="flex h-full w-full cursor-pointer">
    {{ $activator }}
  </label>

  <div
    x-cloak
    x-show="show"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-title"
    class="fixed inset-0 z-50 overflow-y-auto"
  >
    <div
      @class([
        'flex items-end justify-center min-h-screen text-center md:items-center sm:block',
        $containerClsx
      ])
    >
      <div x-cloak @click="() => close()" x-show="show"
           x-transition:enter="transition ease-out duration-300 transform"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100"
           x-transition:leave="transition ease-in duration-200 transform"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           class="fixed inset-0 transition-opacity bg-black bg-opacity-40" aria-hidden="true"
      ></div>

      <div
        x-cloak
        x-show="show"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        @class([
          "inline-block w-full overflow-hidden text-left transition-all transform bg-white shadow-xl",
          $dialogClsx
        ])
      >
        {{ $slot }}
      </div>
    </div>
  </div>
</div>
