
<div class="max-w-screen-xl mx-auto w-full flex flex-col gap-10">
  <x-shared.content-ad h="20"></x-shared.content-ad>

  <div class="flex flex-col gap-5">
    <x-shared.breadcrumbs :items="$breadcrumbs"></x-shared.breadcrumbs>

    <h1 class="text-primary font-medium text-2xl">
      {{ $titlePrefix }}
      @if(!empty($targetName))
        in {{ $targetName }}
      @endif
    </h1>
  </div>
</div>
