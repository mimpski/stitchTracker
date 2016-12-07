<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use DB;
//use App\Http\Requests;
use Request;
use Auth;
use App\Project;
use App\User;
use App\Update;
use Redirect;

class ProjectController extends Controller
{
    public function create_project(){
        $id = Auth::user()->id;
        return view('projects.create', compact('id'));
    }

    public function save_project(Request $request){
        $input = Request::all();
        $id = Auth::user()->id;
        $Project = new Project();
        $Project->name = $input['name'];
        $Project->owner = $id;
        $Project->source = $input['source'];
        $Project->status = $input['status'];
        $Project->start_date = $input['start_date'];
        $Project->slug = $input['slug'];
        $Project->save();
        $id = Auth::user()->id;
        $username = Auth::user()->name;
        $project = Project::where('owner',$id)->get();
        return Redirect::route('my_profile', $username)->with($username);
    }

    public function edit_project($username,$project_name){
        $currentUser = Auth::user()->name;
        if($username != $currentUser){
          echo ('You do not have permission to edit this project!');
        }
        else{
          $id = Auth::user()->id;
          $user = DB::table('users')->select('id')->where('name', '=', $username)->first();
          $userid = get_object_vars($user);
          $project = Project::where('slug', $project_name)->where('owner', '=', $userid)->get();
          return view('projects.edit', compact('id', 'project'));
        }
    }

    public function update_project(Request $request){
        $input = Request::all();
        $id = Request::get('id');
        $Project = Project::where('id',$id)->first();
        $Project->source = $input['source'];
        $Project->status = $input['status'];
        $Project->save();
        $username = Auth::user()->name;
        return Redirect::route('my_profile', $username)->with($username);
    }

    public function view_project($username,$project_name){
        $user = DB::table('users')->select('id')->where('name' ,  '=' ,  $username)->first();
        $userid = get_object_vars($user); // Turns the above stdClass into a string to use below
        $username = $username;
        $project = Project::where('slug', $project_name)->where('owner', $userid)->get();
        return view('projects.view', compact('user', 'project', 'username'));
    }

    public function add_update($username,$project_name){
        $id = Auth::user()->id;
        $user = DB::table('users')->select('id')->where('name' ,  '=' ,  $username)->first();
        $userid = get_object_vars($user); // Turns the above stdClass into a string to use below
        $project = Project::where('slug', $project_name)->where('owner', $userid)->get();
        $username = $username;
        return view('projects.update', compact('user', 'project', 'id', 'username'));
    }


}
