@extends('layouts.default')

@section('content')
  <section class="flex flex-col items-center gap-3 max-w-screen-md mx-auto py-16">
    <div class="w-52 h-52 flex items-center text-primary">
      <x-shared.icons.hasty-grave></x-shared.icons.hasty-grave>
    </div>
    <h1 class="text-primary text-4xl font-semibold">
      We can't find the page you're looking for.
    </h1>
    <p class="text-sm">
      Check out our <a href="#" class="link">Help</a> page or head <a href="{{ url()->previous() }}" class="link">back home</a>.
    </p>
    <span class="text-xs text-neutral-600">Error 404</span>
  </section>
@endsection
