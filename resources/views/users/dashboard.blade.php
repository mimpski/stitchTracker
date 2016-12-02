@extends('layouts.master')

@section('content')

This is your dashboard
<br/><br/>

  @if ($feed->count())
    @foreach ($feed as $update)
        {{ $update->name }}<br/>
    @endforeach

  @else
    No feed

  @endif


@endsection
