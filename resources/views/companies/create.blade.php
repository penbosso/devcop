
@extends('layouts.app')

@section('content')
<div class="row col-sm-8  col-md-8 col-lg-8 pull-left" style="background: white;">
  <h1>Create new company</h1>

      <!-- Example row of columns -->
      <div class="row col-sm-12 col-md-12 col-lg-12 panel panel-primary">
        <form method="post" action="{{ route('companies.store') }}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="company-code">Company code<span class="required">*</span></label>
                <input placeholder="Enter company code"
                        id="company-code"
                        required
                        name="code"
                        spellcheck="false"
                        class="form-control"
                        
                        />
            </div>
            
            <div class="form-group">
                <label for="company-name">Name<span class="required">*</span></label>
                <input placeholder="Enter name"
                        id="company-name"
                        required
                        name="name"
                        spellcheck="false"
                        class="form-control"
                        
                        />
            </div>

            <div clas="form-group">
            <label for="company-content">Description</label>
                <textarea placeholder="Enter description"
                        style="resize: vertical"
                        id="company-content"
                        required
                        name="description"
                        rows="5"
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
              
              <li><a href="/companies">My companies</a></a></li>
            </ol>
          </div>
            </ol>
          </div>
          
        </div>
 @endsection
