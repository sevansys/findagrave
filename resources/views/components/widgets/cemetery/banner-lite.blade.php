<div class="max-w-screen-xl w-full mx-auto flex flex-col py-4 text-gray-800">
  <h1 class="text-4xl font-semibold">{{ $target->name }}</h1>
  @if($alsoKnownAs)
    <h2 class="text-lg font-semibold">Also known as <i>{{ $alsoKnownAs }}</i></h2>
  @endif
  <address>{{ $target->address }}</address>
</div>
