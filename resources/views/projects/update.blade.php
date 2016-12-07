@extends('layouts.master')

@section('content')

  <div class="container">
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="panel panel-default">
                  <div class="panel-heading">Update Project - {{ $project[0]['name'] }}</div>

                  <div class="panel-body">
                    {!! Form::open(['route' => 'save_to_project', 'method' => 'post', 'files'=>'true']) !!}

                      {!! Form::hidden('owner', $id) !!}

                      {!! Form::hidden('username', $username) !!}

                      {!! Form::hidden('project_name', $project[0]['slug']) !!}

                      {!! Form::hidden('id', $project[0]['id'], ['class' => 'form-control', 'id' => 'id']) !!}


                    <div class="form-group">
                       {!! Form::file('filename', ['class' => 'form-control'])!!}
                    </div>

                    {!! Form::hidden('date', \Carbon\Carbon::today()) !!}

                    <div class="form-group">
                      {!! Form::text('description', 'Add your description', ['class' => 'form-control'])!!}
                    </div>


                    <br/><br/>
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
