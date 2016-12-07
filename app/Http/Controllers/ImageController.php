<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Update;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Redirect;
use Session;
use File;
use Carbon\Carbon;
use DB;
use App\Project;
use App\User;

class ImageController extends Controller {


	/**
	 * Store a newly uploaded resource in storage.
	 *
	 * @return Response
	 */
   public function store(Request $request){
         $image = new Update();
         $this->validate($request, [
             'description' => 'required',
             'filename' => 'required'
         ]);
        //  $image->title = $request->title;
        $username = $request->username;
        $project_name = $request->project_name;
         $image->description = $request->description;
         $image->project_id = $request->id;
 		     if($request->hasFile('filename')) {
             $file = Input::file('filename');
             //getting timestamp
             $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

             $name = $timestamp. '-' .$file->getClientOriginalName();

             $image->filename = $name;

             $file->move(public_path().'/images/updates/'.$username.'/'.$project_name, $name);
         }
         $image->save();



         $user = DB::table('users')->select('id')->where('name' ,  '=' ,  $username)->first();
         $userid = get_object_vars($user); // Turns the above stdClass into a string to use below

         $project = Project::where('slug', $project_name)->where('owner', $userid)->get();
         return view('projects.view', compact('user', 'project', 'username'));
 	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show(){
		// Show lists of the images
    }
}
