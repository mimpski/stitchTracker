@extends('layouts.master')

@section('content')

  @foreach ($profile as $user)
    <p>This is user {{ $user->name }} / {{ $user->id }}</p>

  @endforeach

  <br/><br/>

  @foreach ($project as $projects)
    <p>Current project is <br/>

       <a href="/{{ $profile[0]['name']}}/{{ $projects->slug }}">{{ $projects->name }}</a><br/>
      started on {{ $projects->start_date->format('M jS Y g:ia') }}<br/>
      using {{ $projects->source}}<br/>
      project status: {{ $projects->status }}</p>
  @endforeach

@endsection
