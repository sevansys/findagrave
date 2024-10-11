
<div class="max-w-screen-xl mx-auto w-full flex flex-col gap-10">
  <x-shared.content-ad h="20"></x-shared.content-ad>

  <div class="flex flex-col gap-5">
    <x-shared.breadcrumbs :items="$breadcrumbs"></x-shared.breadcrumbs>

    <h1 class="text-primary font-medium text-xl md:text-2xl">
      {{ $titlePrefix }}
      @if(!empty($targetName))
        in {{ $targetName }}
      @endif
    </h1>

    @if($info)
      <div class="flex flex-col gap-2">
        @if($info['items'][0])
          <p>
            <span>{{ $info['items'][0] }}</span>
            <b>{{ $info['name'] }}</b>
            <span>locations</span>
          </p>
        @endif

        @if($info['items'][1])
          <p>
            <span>{{ $info['items'][1] }}</span>
            <span>cemeteries in</span>
            <b>{{ $info['name'] }}</b>
          </p>
        @endif
      </div>
    @endif
  </div>
</div>
