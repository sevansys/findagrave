<div class="max-w-screen-xl w-full mx-auto flex flex-col px-2 pb-0 md:pb-4 pt-4 text-gray-800">
  <h1 class="text-xl md:text-2xl lg:text-4xl font-semibold">{{ $target->name }}</h1>
  @if($alsoKnownAs)
    <h2 class="text-sm md:text-lg font-semibold">Also known as <i>{{ $alsoKnownAs }}</i></h2>
  @endif
  <address>{{ $target->address }}</address>
</div>
