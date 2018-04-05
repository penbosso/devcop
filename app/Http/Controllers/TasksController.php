<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check()){
            $tasks = Task::where('user_id',Auth::user()->id)->get();
            return view('tasks.index',['tasks'=>$tasks]);
        }
        return view('Auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        //
        if(Auth::check()){
            $task = Task::create([
                'name' => $request->input('name'),
                'days' => $request->input('days'),
                'hours' => $request->input('hours'),
                'project_id' => $request->input('project_id'),
                'user_id' => $request->user()->id
            ]);
            

            if($task){
                return redirect()->route('projects.show',['tasks'=>$task])
                ->with('success','task created suscessfully');
            }
        }

       return back()->with('errors', 'Error creating new task');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $findtask = Task::find($task->id);
        if($findtask->delete()){
            //redirect
            return redirect()->route('projects.show')
            ->with('success','task deleted');
        }

        return back()->with('error','task could not be deleted');
    }
}
