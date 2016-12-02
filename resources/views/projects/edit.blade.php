@extends('layouts.master')

@section('content')

  <div class="container">
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="panel panel-default">
                  <div class="panel-heading">Edit Project - {{ $project[0]['name'] }}</div>

                  <div class="panel-body">
                    {!! Form::open(['route' => 'update_project', 'method' => 'post']) !!}

                      {!! Form::hidden('owner', $id) !!}

                      {!! Form::hidden('id', $project[0]['id'], ['class' => 'form-control', 'id' => 'id']) !!}

                      <div class="form-group">
                        {!! Form::hidden('name', $project[0]['name'], ['class' => 'form-control', 'id' => 'name']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::hidden('slug', $project[0]['slug'], ['class' => 'form-control', 'id' => 'slug']) !!}
                      </div>

                      <div class="form-group">
                        {!! Form::text('source', $project[0]['source'], ['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::hidden('start_date', $project[0]['start_date']) !!}
                      </div>
                      <!-- <div class="form-group">
                        {!! Form::date('end_date', \Carbon\Carbon::now()) !!}
                      </div> -->
                      <div class="form-group">
                        {!! Form::select('status', ['Just Started' => 'Just Started', 'In Progress' => 'In Progress', 'Finished' => 'Finished'], $project[0]['status']); !!}
                      </div>

                      <div class="form-group">
                        {!! Form::submit('Update project', ['class' => 'btn btn-primary']) !!}
                      </div>

                    {!! Form::close() !!}
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection
