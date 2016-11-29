@extends('layouts.master')

@section('content')

  @foreach ($user as $users)
    <p>This is user {{ $users->name }} / {{ $users->id }}</p>
  @endforeach

  <br/><br/>

  @foreach ($project as $projects)
    <p>Current project is <br/>

       <a href="/{{ $users->name }}/{{ $projects->slug }}">{{ $projects->name }}</a><br/>
      started on {{ $projects->start_date->format('M jS Y g:ia') }}<br/>
      using {{ $projects->source}}<br/>
      project status: {{ $projects->status }}</p>
  @endforeach

@endsection
