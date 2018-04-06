
@extends('layouts.app')

@section('content')
<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="fas fa-building"></i> Tasks <a class="pull-right btn btn-primary btn-sm" href="/tasks/create">Create new</a> </div>
        <div class="panel-body">
        
        <ul class="lsist-group">
        @foreach($tasks as $task)
            <li class="list-group-item"><a href="/tasks/{{$task->id}}">{{$task->name}}</a>{{-- <em class="small">{{$projects->name}} </em> --}}
            <span class="pull-right">
            @if($task->status==0)
                <b class="text-warning">not completed</b>
            @endif
            @if($task->status==1)
                <b class="text-success">completed</b>
            @endif
            <i >
            
            {{$task->days}} Days</i> <i>{{$task->hours}} Hours</i></span></li>
        @endforeach
        </ul>
        </div>
    </div>
</div>
@endsection