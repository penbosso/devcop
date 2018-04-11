
@extends('layouts.app')

@section('content')
<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="fas fa-building"></i> Companies <a class="pull-right btn btn-primary btn-sm" href="/companies/create">Create new</a><a  href="#joindiv" data-toggle="collapse" class=" pull-right btn btn-primary btn-sm" href="/companies/#">Join company</a> </div>
        <div class="panel-body">
        
        <ul class="lsist-group">
        @foreach($admins as $company)
            <li class="list-group-item"><a href="/companies/{{$company->id}}">{{$company->name}}</a> <em class="pull-right text-success">Admin</em></li>
        @endforeach
        @foreach($managers as $company)
            <li class="list-group-item"><a href="/companies/{{$company->id}}">{{$company->name}}</a> <em class="pull-right text-info">Manager</em></li>
        @endforeach
        @foreach($members as $company)
            <li class="list-group-item"><a href="/companies/{{$company->id}}">{{$company->name}}</a> </li>
        @endforeach
        </ul>
        </div>
    </div> 
   <div class="collapse col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3" id="joindiv"> 
        <h1>Join company</h1>
        <!-- Example row of columns -->
     <div class="row col-sm-12 col-md-12 col-lg-12 panel panel-primary">
        <form method="post" action="{{ route('companies.join') }}">
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
                <input type="submit" class="btn btn-primary" value="submit" />
            </div>
        </form>
     </div>
    </div>     
</div>
@endsection