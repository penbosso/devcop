
@extends('layouts.app')

@section('content')
<div class="row col-sm-9  col-md-9 col-lg-9 pull-left" style="background: white;">
  <h1>Create new project</h1>

      <!-- Example row of columns -->
      <div class="row col-sm-12 col-md-12 col-lg-12">
        <form method="post" action="{{ route('projects.store') }}">
            {{csrf_field()}}

            <div class="form-group">
                <label for="project-name">Name<span class="required">*</span></label>
                <input placeholder="Enter name"
                        id="project-name"
                        required
                        name="name"
                        spellcheck="false"
                        class="form-control"
                        
                        />
            </div>
            
            
            <div class="form-group">
                <input  type="hidden"
                        class="form-control"
                        name="company_id"
                        value="{{$company_id}}"
                        />
            </div>
          

            @if($companies != null)
            <div class="form-group">
            <label for="project-content">Select Company</label>
              <select name="company_id" class="form-control">
              @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
              @endforeach
              </select>
            </div>
            @endif

            <div class="form-group">
            <label for="project-content">Description</label>
                <textarea placeholder="Enter description"
                        style="resize: vertical"
                        id="project-content"
                        required
                        name="description"
                        rows="S"
                        spellcheck="false"
                        class="form-control autosize-target text-left"
                        >
                            
                        </textarea>
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
              
              <li><a href="/projects">All projects</a></a></li>
            </ol>
          </div>
            </ol>
          </div>
          
        </div>
 @endsection
