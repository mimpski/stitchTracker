@extends('layouts.master')

@section('content')

<br/><br/>
<h3>Following</h3>
@if ($friends->count())
  @foreach ($friends as $friend)
      {{ $friend->name }}<br/>
      <a href="/unfollow/{{ $friend->id }}">Unfollow</a><br/>
  @endforeach

@else
  No other users

@endif

<br/><br/>
<h3>Others</h3>
  @if ($users->count())
    @foreach ($users as $user)
        {{ $user->name }}<br/>
        <a href="/follow/{{ $user->id }}">Follow</a><br/>
    @endforeach

  @else
    No other users

  @endif


@endsection
