<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Project;
use App\User;

class UserController extends Controller
{

    public function profile($username)
    {
      $id = Auth::user()->id;
      $user = User::where('name', $username)->get();
      $project = Project::where('owner',$id)->get();
      return view('users.profile', compact('user', 'project'));
    }

    public function project($project_name)
    {
        $project = Project::whereSlug($project_name)->firstOrFail();

        return view('project_view')->withProject($project);
    }

}
