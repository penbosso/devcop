
@extends('layouts.app')

@section('content')
<div class="col-sm-9  col-md-9 col-lg-9 pull-left">
    <!-- Jumbotron -->
      <div class="well well-lg">
        <h1>{{ $project->name }}</h1>
        <p class="lead">{{$project->description }}</p>
        <!-- <p><a class="btn btn-lg btn-success" role="button" href="#">Get started today</a></p> -->
        
        <button data-toggle="collapse" data-target="#tasksdiv" class="btn btn-info btn-sm" >Add task</button> 
              <div class="panel-body collapse" id="tasksdiv" >

                <!-- New Task Form -->
                <form action="{{ route('tasks.store') }}" method="POST" class="form-horizontal ">
                    {{ csrf_field() }}

                  <div class="form-group">
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                  </div>
                    <!-- Task Name -->
                    <div class="form-group">
                        <label for="task" class="col-sm-3 control-label">Task</label>

                        <div class="col-sm-5" >
                            <input type="text" name="name" id="task-name" class="form-control">                            
                        </div>
                        <div class="col-sm-2" >
                            <input type="number" name="days" placeholder="Days" class="form-control">
                            
                        </div>
                        <div class="col-sm-2" >

                            <input type="number" name="hours" placeholder="Hours" class="form-control">
                            
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i> Add Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            <!-- Current Tasks -->
    @if (count($tasks) < 1)
        <em class="text-center small">No task yet</em>
    @endif
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
               <a href="#showtasks" data-toggle="collapse"> Current Tasks </a>
            </div>

            <div class="panel-body collapse" id="showtasks">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>

                                <td>
                                <form action="{{ route('tasks.destroy',[$task->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-warning btn-sm">Delete Task</button><span> </span> <button class="btn btn-success btn-sm">Complete</button> <span class="pull-right"><i >{{$task->days}} Days</i> <i>{{$task->hours}} Hours</i></span>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

      
      <!-- Example row of columns -->
      <div class="row" style="background: white; margin: 10px">
        <!-- <a href="/projects/create" class="pull-right btn btn-default btn-sm">Add Project</a> -->

          
        <div class="row container-fluid">
      
          @include('partials.comments')
          <button data-toggle="collapse" data-target="#commentdiv" class="btn btn-info btn-sm pull-right">Comment</button> 
            <div id="commentdiv" class="collapse" >
            <form method="post" action="{{ route('comments.store') }}">
                {{csrf_field()}}

                <input type="hidden" name="commentable_type" value="App\project">
                <input type="hidden" name="commentable_id" value="{{ $project->id }}">

                <div clas="form-group">
                <label for="comment-content"><i class="fas fa-comment-dots"></i> comment</label>
                    <textarea placeholder="Enter comment"
                            style="resize: vertical"
                            id="comment-content"
                            required
                            name="body"
                            rows="3"
                            spellcheck="false"
                            class="form-control autosize-target text-left"
                            >
                                
                            </textarea>
                </div>
                <div class="form-group">
                <label for="comment-content">Enter proof of work done (url/photo)</label>
                    <textarea placeholder="Enter proof url or photo)"
                            style="resize: vertical"
                            id="comment-content"
                            name="url"
                            rows="2"
                            spellcheck="false"
                            class="form-control autosize-target text-left"
                            >
                                
                            </textarea>
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-sm btn-primary pull-right" value=" submit " /> <i class="fas fa-comment-dots pull-right"></i>
                </div>
            </form>
            </div>
      </div>

       
</div>
<!-- </div> -->
<div class="col-sm-3 col-md-3 col-lg-3 blog-sidebar">
          <!-- <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div> -->
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/projects/{{$project->id}}/edit"><i class="fas fa-edit"></i> Edit</a></li>
              <li><a href="/projects/create"><i class="fas fa-plus-circle"></i> Create new project</a></li>
              <li><a href="/projects"><i class="fas fa-list"></i> List Projects</a></li>
              
              <br/>

              @if($project->user_id == Auth::user()->id)
              <li><a href="#" class ="text-warning"
              
                onclick = "
                var result = confirm('Are you sure you wish to delete this project?');
                    if(result){
                      event.preventDefault();
                      document.getElementById('delete-form').submit();
                    }
                "><i class="fas fa-minus-circle"></i> Delete
                </a>
               <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}"
                    method="POST" style="display: none;">
                    <input type="hidden" name="_method" value="delete" />
                      {{csrf_field()}}
              </form>

              </li>
              @endif
              
            </ol>

            <h4>Add members</h4>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <form id="add-user" action="{{ route('projects.adduser')}}"
                    method="POST">
                <div class="input-group">
                  <input class="form-control " name="project_id" type="hidden" value="{{ $project->id }}">
                  {{ csrf_field() }}
                  <input type="text" required class="form-control" name="email" placeholder="email">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Add</button>
                  </span>
                </div>
                </form>
              </div>
            </div>

            <br />
            
          </div>
          <div class="sidebar-module">
            <h4>Team members</h4>
            <ol class="list-unstyled">
             @foreach($project->users as $user)
              <li><a href="#">{{ $user->email}}</a></li>
             @endforeach
             
            </ol>
          </div>
          
</div>
 @endsection