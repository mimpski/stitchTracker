<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use DB;
//use App\Http\Requests;
use Request;
use Auth;
use App\Project;
use App\User;
use Redirect;

class UserController extends Controller
{

    public function profile($username){
        $profileid = DB::table('users')->select('id')->where('name', '=', $username)->first();
        $userid = get_object_vars($profileid);
        $profile = User::where('name', $username)->get();
        $project = Project::where('owner', $userid)->get();
        return view('users.profile', compact('profile', 'project'));
    }

    public function dashboard($username){
        $profileid = DB::table('users')->select('id')->where('name', '=', $username)->first();
        $userid = get_object_vars($profileid);
        // Get followers projects
        $feed = DB::select( DB::raw("select f.follow_id, p.* from projects p, followers f where f.user_id = $userid[id] and p.owner = f.follow_id;") ); // Need to limit and order this by eventually
        $feed = collect($feed);
        $project = Project::where('owner', $userid)->get();
        return view('users.dashboard', compact('project', 'feed'));
    }

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
        $project = Project::where('slug', $project_name)->where('owner', $userid)->get();
        return view('projects.view', compact('user', 'project'));
    }

}
