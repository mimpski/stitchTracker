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
        $friends = DB::select( DB::raw("select f.follow_id, p.* from users p, followers f where f.user_id = $userid[id] and p.id = f.follow_id;") );
        $friends = collect($friends);
        $project = Project::where('owner', $userid)->get();
        return view('users.dashboard', compact('project', 'feed', 'friends'));
    }

    public function add_following($id){
      $userid = Auth::user()->id;
      $friendid = User::where('id', $id)->get();
      $friendid = $friendid[0]['id'];
      DB::table('followers')->insert(['user_id' => $userid, 'follow_id' => $friendid]);
      return Redirect::back();
    }
    public function remove_following($id){
      $userid = Auth::user()->id;
      $friendid = User::where('id', $id)->get();
      $friendid = $friendid[0]['id'];
      $follow = DB::table('followers')->where('user_id', '=', $userid)->where('follow_id', '=', $friendid)->delete();
      return Redirect::back();
    }

    public function find_friends(){
      $userid = Auth::user()->id;
      $users = DB::select( DB::raw("SELECT p.* FROM users p WHERE p.id NOT IN (select distinct p.id from users p, followers f where f.user_id = $userid and p.id = f.follow_id and p.id != $userid) AND p.id <> $userid;"));
      $users = collect($users);
      $friends = DB::select( DB::raw("select p.* from users p, followers f where f.user_id = $userid and p.id = f.follow_id and p.id != $userid;"));
      $friends = collect($friends);
      return view('users.find-friends', compact('users', 'friends'));
    }

}
