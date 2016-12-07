<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{

  protected $table = 'projects';
  protected $dates = ['start_date', 'end_date'];
  protected $fillable = [
      'owner',
      'name',
      'start_date',
      'end_date',
      'status',
      'source',
      'slug'
  ];

  public function updates(){
      return $this->hasMany('Update', 'updates', 'project_id', 'project_id')->withTimestamps();
  }

}
