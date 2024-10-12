@extends('layouts/default')

@section('content')
  <div class="px-2 md:px-4 py-5">
    <div class="flex flex-col gap-2 max-w-screen-xl mx-auto w-full bg-white border rounded-md px-3 sm:px-5 py-5">
      <h1 class="text-center text-primary font-semibold text-2xl md:text-3xl lg:text-4xl">Add a New Cemetery</h1>

      @if(request()->get('location_id'))
        <x-widgets.cemetery.create-form></x-widgets.cemetery.create-form>
      @else
        <x-widgets.cemetery.search-for-duplicates></x-widgets.cemetery.search-for-duplicates>
      @endif
    </div>
  </div>
@endsection
