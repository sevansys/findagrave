<x-shared.dialog name="sign-up" dialog-clsx="max-w-screen-md p-0 my-2 sm:my-4">
  <x-slot name="activator">
    {{ $slot }}
  </x-slot>

  <div x-data="{ bePhotoVolunteer: false, showPassword: false }" class="flex flex-col gap-10 text-gray-500 normal-case">
    <header class="bg-[#5c60a3] text-white flex justify-between items-center">
      <h4 class="px-8 text-lg font-semibold">New Member Registration</h4>
      <a href="#" class="w-14 h-14 p-3 flex opacity-50 hover:opacity-100" @click.prevent="() => close()">
        <x-shared.icons.cross></x-shared.icons.cross>
      </a>
    </header>
    <form action="/sing-up" method="POST" class="flex flex-col gap-5">
      @csrf

      <h3 class="text-center">Becoming a Find a Grave member is fast, easy and FREE.</h3>

      <div class="text-sm registration-form items-center gap-x-6 gap-y-3 md:pl-10 px-4 md:px-8">
        <span class="col-auto">Name</span>
        <x-shared.fields-group clsx="gap-0">
          <x-shared.field name="first-name" :float-label="false" label="First Name"></x-shared.field>
          <x-shared.field name="last-name" :float-label="false" label="Last Name"></x-shared.field>
        </x-shared.fields-group>

        <span>Email</span>
        <x-shared.field
          required
          type="email"
          name="email"
          :float-label="false"
          autocomplete="email"
          label="Email Address"></x-shared.field>

        <span></span>
        <x-shared.checkbox label="Display my email on my public profile page."></x-shared.checkbox>

        <span>Password</span>
        <div class="flex gap-3 justify-start items-center">
          <x-shared.field
            required
            clsx="w-64"
            name="password"
            type="password"
            autocomplete="new-password"
            attrs=":type='showPassword ? `text` : `password`'"></x-shared.field>

          <div class="text-nowrap">
            <x-shared.checkbox
              label="Show password"
              @change='(event) => showPassword = !!event.target.checked'></x-shared.checkbox>
          </div>
        </div>

        <span>Repeat password</span>
        <x-shared.field
          required
          class="w-64"
          type="password"
          name="password_verify"
          autocomplete="new-password"></x-shared.field>

        <span>Public Name</span>
        <x-shared.field
          :float-label="false"
          label="Public Name (Leave blank for anonymous)"></x-shared.field>

        <span></span>
        <a href="#" class="link">What is a Public Name?</a>

        <span></span>
        <div class="flex flex-col gap-3">
          <x-shared.checkbox label="Receive email notifications about memorials you manage."></x-shared.checkbox>
          <x-shared.checkbox @change='(event) => bePhotoVolunteer = !!event.target.checked'>
            <x-slot name="label">
              I would like to be a photo volunteer. <a href="#" class="link">What is a Photo Volunteer?</a>
            </x-slot>
          </x-shared.checkbox>

          <div class="flex flex-col mb-2">
            <div x-show="bePhotoVolunteer">
              <span>Volunteer location</span>
              <div class="flex flex-wrap items-center gap-5">
                <x-shared.autocomplete
                  required
                  ref="location"
                  name="location"
                  value-name="location_id"
                  label="Cemetery Location"
                  base-url="/locations/autocomplete"
                  :error="$errors->get('location_id')"
                  :value="old('location', request()->get('location'))"
                  :input-value="old('location_id', request()->get('location_id'))"
                  :params="[
                      'types' => [\App\Enums\EnumLocation::CITY, \App\Enums\EnumLocation::COUNTY],
                  ]"
                >
                  <x-slot name="suggestionIcon">
                    <x-shared.icons.location></x-shared.icons.location>
                  </x-slot>
                  <x-slot name="after">
                    <span>OR</span>
                    <x-shared.btn
                      variant="secondary"
                      class="text-white bg-black flex flex-auto gap-2 rounded-md text-nowrap"
                      x-dialog.browse-locations="{ onSelect({ id, path }) { query=path, inputValue=id } }"
                    >
                      <span class="w-4 h-4">
                        <x-shared.icons.location></x-shared.icons.location>
                      </span>
                      <span>Use my location</span>
                    </x-shared.btn>
                  </x-slot>
                </x-shared.autocomplete>
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-3 -m-2 border border-[#5c60a3] px-2 py-4 rounded-md">
            <x-shared.checkbox  clsx="items-start">
              <x-slot name="label">
                Find a Grave may contact you via email about their products and services, such as what's new,
                upcoming events, and tips for using the site. You can unsubscribe or customize your email settings
                at any time.
              </x-slot>
            </x-shared.checkbox>
            <x-shared.checkbox required>
              <x-slot name="label">
                I have read and agree to the
                <a href="#" class="link">Terms and Conditions</a> and
                <a href="#" class="link">Privacy Statement</a>
              </x-slot>
            </x-shared.checkbox>
          </div>
        </div>
      </div>

      <div class="flex justify-end py-4 px-8 bg-gray-100">
        <x-shared.btn type="submit" variant="primary" class="rounded-md">Create Account</x-shared.btn>
      </div>
    </form>
  </div>
</x-shared.dialog>
