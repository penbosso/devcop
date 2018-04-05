
@extends('layouts.app')

@section('content')
<div class="col-sm-9  col-md-9 col-lg-9 pull-left">
    <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>{{ $company->name}}</h1>
        <p class="lead">{{$company->description}}</p>
        <!-- <p><a class="btn btn-lg btn-success" role="button" href="#">Get started today</a></p> -->
      </div>

      <!-- Example row of columns -->
      <div class="row" style="background: white; margin: 10px">
      <a href="/projects/create/{{$company->id}}" class="pull-right btn btn-default btn-sm">Add Project</a>
      @foreach($company->projects as $project)
        <div class="col-lg-4">
          <h2>{{ $project->name}}</h2>
          <p class="text-danger">{{ $project->description}}</p>
          <p><a class="btn btn-primary" role="button" href="/projects/{{ $project->id }}">Add comment »</a></p>
        </div>
       @endforeach
      </div>
</div>
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
              <li><a href="#">March 2014</a></li>
             
            </ol>
          </div>
          
        </div>
 @endsection