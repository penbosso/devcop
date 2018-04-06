
@extends('layouts.app')

@section('content')
<div class="col-sm-9  col-md-9 col-lg-9 pull-left">

    <!-- Jumbotron -->
      <div class="jumbotron">
        
        <p class="lead">
          <b>Company : </b>{{ $company->name}}
          <br/>
          <b>Project : </b>{{$project->name}}
        </p>
        <h2 class="text-primary"><b class="small">Task : </b>{{ $task->name}}</h2>
        <p class="lead">
          <b>Estimated time :</b> <i >{{$task->days}} Days</i> <i>{{$task->hours}} Hours</i>
          <br/>
          <b>Status : </b>
          @if($task->status==0)
              <b class="text-warning">not completed</b>
          @endif
          @if($task->status==1)
              <b class="text-success">completed</b>
          @endif
      </p>
        <!-- <p><a class="btn btn-lg btn-success" role="button" href="#">Get started today</a></p> -->
        <form action="{{ route('tasks.destroy',[$task->id]) }}" method="POST" id="delete-task-form">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}

          <a href="#"  class="btn btn-sm btn-warning"
          
          onclick = "
          var result = confirm('Are you sure you wish to delete this task?');
              if(result){
                  event.preventDefault();
                  document.getElementById('delete-task-form').submit();
              }
          "><i class=" fas fa-minus-circle"></i> Delete Task</a>
          <span> </span> 
          <button class="btn btn-success btn-sm"
            >
              <i class=" fas fa-check-circle"></i> Complete    
          </button> 

          <form id="status-form" action="{{ route('tasks.update',[$task->id]) }}"
                  method="POST" style="display: none;">
                  <input type="hidden" name="_method" value="put" />
                  <input type="hidden" name="status" value="1" />
                  {{csrf_field()}}
          </form>
      </div>
      
      <div class="row container-fluid">


      @include('partials.comments')
      
      <button data-toggle="collapse" data-target="#commentdiv" class="btn btn-info btn-sm pull-right">Comment</button> 
        <div id="commentdiv" class="collapse" >
          <form method="post" action="{{ route('comments.store') }}">
              {{csrf_field()}}

              <input type="hidden" name="commentable_type" value="App\task">
              <input type="hidden" name="commentable_id" value="{{ $task->id }}">

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
        <!-- <a href="/projects/create" class="pull-right btn btn-default btn-sm">Add Project</a> -->
               
<div class="col-sm-3 col-md-3 col-lg-3 blog-sidebar">
          <!-- <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div> -->
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/companies/{{$company->id}}/edit"><i class="fas fa-edit"></i> Edit</a></li>
              <li><a href="/projects/create/{{$company->id}}"><i class="fas fa-plus-circle"></i> Add Project</a></li>
              <li><a href="/companies"><i class="fas fa-building"></i> My companies</a></li>
              <li><a href="/companies/create"><i class="fas fa-plus-circle"></i> Create new Company</a></li>
              <br/>
              <li><a href="#"
              
                onclick = "
                var result = confirm('Are you sure you wish to delete this company?');
                    if(result){
                      event.preventDefault();
                      document.getElementById('delete-form').submit();
                    }
                "><i class="fas fa-minus-circle"></i> Delete
                </a>
               <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}"
                    method="POST" style="display: none;">
                    <input type="hidden" name="_method" value="delete" />
                      {{csrf_field()}}
              </form>

              </li>
              
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
              <li><a href="#">Chris</a></li>
             
            </ol>
          </div>
          
</div>

 @endsection