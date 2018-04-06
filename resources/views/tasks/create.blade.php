
@extends('layouts.app')

@section('content')
<div class="row col-sm-8  col-md-8 col-lg-8  pull-left" style="background: white;">
  <h1>Create new task</h1>

      <!-- Example row of columns -->
      <div class="row col-sm-12 col-md-12 col-lg-12 panel panel-primary" >
        <form method="post" action="{{ route('tasks.store') }}">
            {{csrf_field()}}


             <div class="form-group">
              <label for="project-content">Select Project</label>
                <select name="project_id" class="form-control">
                @foreach( $projects as $project)
                  <option value="{{$project->id}}">{{ $project->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                <label for="project-name">Task<span class="required">*</span></label>
                <input placeholder="Enter task"
                        id="task-name"
                        required
                        name="name"
                        spellcheck="false"
                        class="form-control"
                        
                        />
            </div>
          


            <div class="form-group">
            <label for="duration">Extimated duration</label>
              <div class="duration col-md-4"  >
              <input type="number" name="days" placeholder="Days" class="form-control">
                  
              </div>
              <div class="duration col-md-4" >

                  <input type="number" name="hours" placeholder="Hours" class="form-control">
                  
              </div>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit" />
            </div>
        </form>
      </div>
</div>
<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
          <!-- <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div> -->
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">                                                                    
              
              <li><a href="/tasks">All tasks</a></a></li>
            </ol>
          </div>
            </ol>
          </div>
          
        </div>
 @endsection
