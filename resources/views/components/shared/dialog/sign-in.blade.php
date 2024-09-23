<x-shared.dialog dialog-clsx="my-10 max-w-screen-md p-0">
  <x-slot name="activator">
    {{ $slot }}
  </x-slot>

  <div x-data="{ forgotPassword: false }" class="text-black normal-case">
    <header class="bg-[#5c60a3] text-white flex justify-between items-center">
      <h4 class="px-5 text-lg font-semibold">Sign in to Find a Grave</h4>
      <a href="#" class="w-14 h-14 p-3 flex opacity-50 hover:opacity-100" @click.prevent="modelOpen = false">
        <x-shared.icons.cross></x-shared.icons.cross>
      </a>
    </header>

    <div class="max-w-[400px] mx-auto w-full py-5">
      <div x-show="!forgotPassword">
        <form
          method="POST"
          action="/sing-in"
          x-data="{ showPassword: false }"
          class="flex flex-col gap-4 p-5">
          @csrf

          <x-shared.field
            required
            type="email"
            name="email"
            label="Enter your email address"></x-shared.field>

            <x-shared.field
              required
              type="password"
              name="password"
              label="Password"
              autocomplete="email"
              attrs=":type='showPassword ? `text` : `password`'"></x-shared.field>

          <div class="flex justify-between gap-4 items-center">
            <x-shared.checkbox
              clsx="text-nowrap"
              label="Show password"
              autocomplete="password"
              attrs="@change='(event) => showPassword = !!event.target.checked'"></x-shared.checkbox>

            <a href="#" class="link" @click.prevent="forgotPassword = true">Forgot password?</a>
          </div>

          <x-shared.btn
            type="submit"
            variant="primary"
            clsx="rounded-md">Sign in with Find a Grave</x-shared.btn>
          <x-shared.checkbox
            name="remember-me"
            label="Keep me signed in"></x-shared.checkbox>
        </form>
      </div>

      <div x-show="forgotPassword" class="flex flex-col gap-3 p-4">
        <div>
          <h4 class="text-primary text-2xl font-semibold text-center">Password Reset</h4>
          <p class="text-sm text-gray-600">Please enter your email address and we will send you an email with a reset password code.</p>
        </div>

        <x-shared.field
          required
          type="email"
          autocomplete="email"
          label="Enter your email address"></x-shared.field>

        <x-shared.btn
          clsx="rounded-md"
          variant="primary">Reset Password</x-shared.btn>

        <div class="text-center">
          <a href="#" class="link" @click.prevent="forgotPassword = false">Sign In</a>
        </div>
      </div>
    </div>
    <footer class="px-4 py-2 bg-gray-100 flex justify-center gap-2">
      <b>New to Find a Grave?</b>
      <a href="#" class="link" @click.prevent="modelOpen = false; window.topMenuRegister?.click()">Sign Up</a>
    </footer>
  </div>
</x-shared.dialog>
