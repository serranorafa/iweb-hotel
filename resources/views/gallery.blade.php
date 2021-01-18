@extends('layouts.app')

@section('content')
<div class="container" style="background-color: cyan;">
    <h1 style="text-align: center">{{ __('Fotos') }}</h1>
    <img src="{{ asset('/img/room/room-1.webp') }}" />
</div>
@endsection