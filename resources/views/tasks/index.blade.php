
@extends('layouts.app')

@section('content')
<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="fas fa-building"></i> Tasks <a class="pull-right btn btn-primary btn-sm" href="#">Create new</a> </div>
        <div class="panel-body">
        
        <ul class="lsist-group">
        @foreach($tasks as $task)
            <li class="list-group-item"><a href="#">{{$task->name}}</a>{{-- <em class="small">{{$projects->name}} </em> --}}</li>
        @endforeach
        </ul>
        </div>
    </div>
</div>
@endsection