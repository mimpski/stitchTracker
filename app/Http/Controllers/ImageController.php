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

        return redirect()->action('ProjectController@view_project', ['username' => $username, 'project_name' => $project_name]);
 	}
}
