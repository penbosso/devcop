<?php

namespace App\Http\Controllers;

use App\Company;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //S
        if(Auth::check()){         
            // companies created
            // $companies = Company::where('user_id',Auth::user()->id)->get();
            // $owned = Company::where('user_id',Auth::user()->id)->get();

            // companies administrator
            $company_id = Role::select('company_id')->where('user_id',Auth::user()->id)
                              ->where('name','admin')->get();
            $admins = Company::whereIn('id',$company_id)->get();

            //companies manager
            $company_id = Role::select('company_id')->where('user_id',Auth::user()->id)
                              ->where('name','manager')->get();
            $managers = Company::whereIn('id',$company_id)->get();

            //companies memeber
            $company_id = Role::select('company_id')->where('user_id',Auth::user()->id)
                              ->where('name','member')->get();
            $members = Company::whereIn('id',$company_id)->get();

            return view('companies.index',['admins'=>$admins,'managers'=>$managers, 'members'=>$members]);
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
        return view('companies.create');
    }

    public function join(Request $request)
    {   
        $code = $request->input('code');
        $user_id = Auth::user()->id;
        // dd($code);
        $company = Company::select('id','name')->where('code',$code)->first();
        // dd($company);
        if($company == null){
            
            return back()->with("success", "incorrect company code ");
            
        }

        $company_id = $company->id;

        $role = Role::select('id')->where('user_id',$user_id)
                              ->where('company_id',$company_id)->first();

        if($role = null){
            dd($role);
            return redirect()->route('companies.index')
                ->with('success','You are already a member of '.$company->name);
        }
        elseif($company_id){
            $role = Role::create([
                'user_id' =>$user_id,
                'company_id' =>$company_id,
                'name' =>'member' 
                ]);

                return redirect()->route('companies.index')
                ->with('success',' You have successfully join '.$company->name);
            
        }

        return redirect()->route('companies.index')
                ->with('errors','Could not join company');

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
            $company = Company::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => $request->user()->id,
                'code' => $request->input('code')
            ]);
            Role::create([
                'user_id' => $request->user()->id,
                'company_id' => $company->id,
                'name' =>'admin'
            ]);

            if($company){
                return redirect()->route('companies.show',['company'=>$company->id])
                ->with('success','Company created suscessfully');
            }
        }

       // return back()->withInput()->with('errors', 'Error creating new company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
        // set temportary role for user table
        $user_id = Auth::user()->id;
        $company_id = $company->id;
        $role_name = Role::select('name')->where('user_id',$user_id)->where('company_id',$company_id)->first();
        $role_name = $role_name->name;

        // if($role_name =='admin'){
        //    $role = User::where('id',$user_id)->update(['temp_role'=> 1]);

        // }
        // elseif($role_name =='manager'){
        //     $role = User::where('id',$user_id)->update(['temp_role'=> 2]);
        // }
        // else{
        //     $role = User::where('id',$user_id)->update(['temp_role'=> 3]);
        // }
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
            $company = Company::find($company->id);
            $comments = $company->comments;
            return view('companies.show',['company'=>$company,'comments'=> $comments,'role'=>$role]);
        }
        else{
            dd('setting role failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
        $company = Company::find($company->id);
        return view('companies.edit',['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //save data
        $companyUpdate = Company::where('id',$company->id)
                                ->update([
                                    'name'=> $request->input('name'), 
                                    'description'=> $request->input('description')
                                    ]);
        if($companyUpdate){
            return redirect()->route('companies.show',['company'=>$company->id])
                ->with('success', 'Company updated successfully');
        }
        //redirect
        return back()->with("errors","Error in creating company");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        // dd($company); 
        $findCompany = Company::find($company->id);
        if($findCompany->delete()){
            //redirect
            return redirect()->route('companies.index')
            ->with('success','Company deleted');
        }

        return back()->withInput()->with('errors','Company could not be deleted');
    }
}
