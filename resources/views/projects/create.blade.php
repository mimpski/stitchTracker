@extends('layouts.master')

@section('content')

  <div class="container">
      <div class="row">
          <div class="col-md-10 col-md-offset-1">
              <div class="panel panel-default">
                  <div class="panel-heading">Create Project</div>

                  <div class="panel-body">
                    {!! Form::open(['route' => 'save_project', 'method' => 'post']) !!}

                      {!! Form::hidden('owner', $id) !!}

                      <div class="form-group">
                        {!! Form::text('name', 'Name your project', ['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::text('slug', 'Slug your project', ['class' => 'form-control']) !!}
                      </div>
                      
                      <div class="form-group">
                        {!! Form::text('source', 'Pattern source', ['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::date('start_date', \Carbon\Carbon::now()) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::select('status', ['Just Started' => 'Just Started', 'In Progress' => 'In Progress', 'Finished' => 'Finished'], 'Just Started'); !!}
                      </div>

                      <div class="form-group">
                        {!! Form::submit('Save project', ['class' => 'btn btn-primary']) !!}
                      </div>

                    {!! Form::close() !!}
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection
