@extends('layouts.master')

@section('content')

  @foreach ($project as $projects)
    <p>Project Page <br/>

      {{ $projects->name }}<br/>
      started on {{ $projects->start_date->format('M jS Y g:ia') }}<br/>
      using {{ $projects->source}}<br/>
      project status: {{ $projects->status }}</p>
      <a href="/{{$username}}/{{$projects->slug}}/updates" class="btn btn-primary" role="button">
         Add New Image
      </a>
  @endforeach

@endsection
