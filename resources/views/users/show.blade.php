
@extends('layouts.app')

@section('content')
<div class="col-sm-9  col-md-9 col-lg-9 pull-left">

    <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>{{ $company->name}}</h1>
        <p class="lead">{{$company->description}}</p>
        <!-- <p><a class="btn btn-lg btn-success" role="button" href="#">Get started today</a></p> -->
      </div>

      <div class="row container-fluid">
      
      @include('partials.comments')
      
      <button data-toggle="collapse" data-target="#commentdiv" class="btn btn-info btn-sm pull-right">Comment</button> 
        <div id="commentdiv" class="collapse" >
          <form method="post" action="{{ route('comments.store') }}">
              {{csrf_field()}}

              <input type="hidden" name="commentable_type" value="App\company">
              <input type="hidden" name="commentable_id" value="{{ $company->id }}">

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

      <!-- style="display:inline-block; float:none; -->
      <!-- Example row of columns -->
      <div class="row"   style="background: white; margin: 10px; ">
      <!-- <a href="/projects/create/{{$company->id}}" class="pull-right btn btn-default btn-sm">Add Project</a> -->
      <div  class="row row-eq-height" >
      @foreach($company->projects as $project)
        <div class="col-lg-6 col-md-6 col-sm-6">
          <h2>{{ $project->name}}</h2>
          <p class="text-danger">{{ $project->description}}</p>
          <p><a class="btn btn-primary" role="button" href="/projects/{{ $project->id }}"> View »</a></p>
        </div>
      @endforeach
      </div>
      </div>
</div>
        <!-- <a href="/projects/create" class="pull-right btn btn-default btn-sm">Add Project</a> -->
               
<div class="col-sm-3 col-md-3 col-lg-3 blog-sidebar">
          <!-- <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div> -->
          <div class="sidebar-module">
          @if($role == 1)
          <h3 class="text-info">Admin</h3>
          @endif
          @if($role ==2)
          <h3 class="text-info">Manager</h3>
          @endif
            <h4>Actions</h4>
            <ol class="list-unstyled">
            @if($role < 3)
              <li><a class="text-warning" href="/companies/{{$company->id}}/edit"><i class="fas fa-edit"></i> Edit</a></li>
            @endif
              <li><a href="/projects/create/{{$company->id}}"><i class="fas fa-plus-circle"></i> Add Project</a></li>
              <li><a href="/companies"><i class="fas fa-building"></i> My companies</a></li>
              <li><a href="/companies/create"><i class="fas fa-plus-circle"></i> Create new Company</a></li>
              <br/>
              @if($role == 1)
              <li><a href="#" class="text-warning"
              
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
              @endif
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