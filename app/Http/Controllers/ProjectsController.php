<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\User;
use App\Role;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
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
            // creater
            $projects = Project::where('user_id',Auth::user()->id)->get();

             //  administrator
            $company_id = Role::select('company_id')->where('user_id',Auth::user()->id)
                              ->where('name','admin')->get();
            $admins = Project::whereIn('company_id',$company_id)->get();

            // manager
            $company_id = Role::select('company_id')->where('user_id',Auth::user()->id)
                              ->where('name','manager')->get();
            $managers = Project::whereIn('company_id',$company_id)->get();

            // memeber
            $company_id = Role::select('company_id')->where('user_id',Auth::user()->id)
                              ->where('name','member')->get();
            $members = Project::whereIn('company_id',$company_id)->get();

            return view('projects.index',['admins'=>$admins,'managers'=>$managers, 'members'=>$members]);

            // return view('projects.index',['projects'=>$projects]);
        }
        return view('Auth.login');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id=null)
    {   
        $companies = null;
        if(!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        return view('projects.create',['company_id'=>$company_id,'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),
                'user_id' => $request->user()->id
            ]);
            

            if($project){
                return redirect()->route('projects.show',['project'=>$project->id])
                ->with('success','project created suscessfully');
            }
        }

       return back()->with('errors', 'Error creating new project');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
                // set temportary role for user table
        $user_id = Auth::user()->id;
        $company_id = $project->company_id;
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
            return view('projects.show',['project'=>$project, 'comments'=>$comments,'tasks'=>$tasks,'role'=>$role]);
        }
        else{
            dd('setting role failed');
        }
        // dd($tasks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $project = Project::find($project->id);
        return view('projects.edit',['project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //save data
        $projectUpdate = Project::where('id',$project->id)
                                ->update([
                                    'name'=> $request->input('name'), 
                                    'description'=> $request->input('description')
                                    ]);
        if($projectUpdate){
            return redirect()->route('projects.show',['comany'=>$project->id])
                ->with('success', 'project updated successfully');
        }
        //redirect
        return back()->withImput();
    }
    public function adduser(Request $request)
    {
        // takes a project and add a user to it
        $project = Project::find($request->input('project_id'));

        if(Auth::user()->id == $project->user_id){
            $user = User::where('email',$request->input('email'))->first();

            //check if user and project already exit
            $projectUser = ProjectUser::where('user_id', $user->id)
                                        ->where('project_id', $project->id)
                                        ->first();
            if($projectUser){
                return redirect()->route('projects.show',['project'=>$project->id])
                ->with('success', $request->input('email').' is already a member of this project');
            }    
            
            if($user && $project){
                $project->users()->attach($user->id);
                return redirect()->route('projects.show',['project'=>$project->id])
                ->with('success', $request->input('email').' was added to the project successfully');
            }
        }
        return redirect()->route('projects.show',['project'=>$project->id])
        ->with('errors', $request->input('email').' Error adding to the project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // dd($project); 
        $findproject = Project::find($project->id);
        if($findproject->delete()){
            //redirect
            return redirect()->route('projects.index')
            ->with('success','project deleted');
        }

        return back()->with('errors','project could not be deleted');
    }
}
