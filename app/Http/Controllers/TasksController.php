<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use App\Company;
use App\Role;
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

            // foreach ($tasks as $task){
            //     $taskproject = Project::find($task->project_id);
            // }
            // dd($taskproject);

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
       
        // $companies = Company::where('user_id', Auth::user()->id)->get();
        $projects = Project::where('user_id', Auth::user()->id)->get();
       
        return view('tasks.create',['projects'=>$projects]);
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
                return redirect()->route('tasks.show',['tasks'=>$task])
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
        $task = Task::find($task->id);
        $comments = $task->comments;
        $project = Project::find($task->project_id);
        $company = Company::find($project->company_id);
        
       // set temportary role for user table
        $user_id = Auth::user()->id;
        $company_id = $company->id;
        $role_name = Role::select('name')->where('user_id',$user_id)->where('company_id',$company_id)->first();
        $role_name = $role_name->name;

        if($role_name =='admin'){
           $role = 1;

        }
        elseif($role_name =='manager'){
            $role =2;
        }
        else{
            $role = 3;
        }


        if($role){    
            $project = Project::find($project->id);
            $comments = $project->comments;
            $tasks = $project->tasks;
            
            return view('tasks.show',['project'=>$project, 'comments'=>$comments,'company'=>$company, 'task'=>$task, 'role'=>$role]);
        }
        else{
            dd('setting role failed');
        }

        
        // dd($tasks);
        
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
        // dd($task);

        $project_id =$task->project_id;
        $taskUpdate = Task::where('id',$task->id)
                                ->update([
                                    'status'=> $request->input('status')
                                    ]);
                                    // dd($taskUpdate);
        if($taskUpdate){
            return redirect()->route('projects.show',['project'=>$project_id])
                ->with('success', 'task completed');
        }
        //redirect
        return back()->withImput();
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
