@extends('layouts.master')

@section('content')

  @foreach ($user as $users)
    <p>This is user {{ $users->name }} / {{ $users->id }}</p>
  @endforeach

  <br/><br/>

  @foreach ($project as $projects)
    <p>Current project is <br/>
      {{ $projects->name }}<br/>
      started on {{ $projects->start_date }}<br/>
      using {{ $projects->source}}<br/>
      currently the project {{ $projects->status }}</p>
  @endforeach

@endsection
