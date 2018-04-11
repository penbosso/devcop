
@extends('layouts.app')

@section('content')
<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="fas fa-building"></i> Companies <a class="pull-right btn btn-primary btn-sm" href="/companies/create">Create new</a><a class="pull-right btn btn-primary btn-sm" href="/companies/#">Join company</a> </div>
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
</div>
@endsection