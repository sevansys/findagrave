@extends('layouts.default')

@section('content')
  @if(request()->has('cemetery_id'))
    Memorial form
  @else
    <x-widgets.memorial.choose-location></x-widgets.memorial.choose-location>
  @endif
@endsection
