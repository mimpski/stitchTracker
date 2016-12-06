@extends('layouts.master')

@section('content')

This is your dashboard
<br/><br/>
  <h3>Updates</h3>
  @if ($feed->count())
    @foreach ($feed as $update)
        {{ $update->name }}<br/>
    @endforeach

  @else
    No feed

  @endif

  <br/>
  <h3>Friends</h3>
  @if ($friends->count())
    @foreach ($friends as $friend)
        {{ $friend->name }}<br/>
        <a href="#">Remove friend</a>
    @endforeach

  @else
    No friends

  @endif


@endsection
