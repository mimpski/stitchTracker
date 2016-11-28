<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{

  protected $table = 'projects';
  protected $dates = ['start_date', 'end_date'];

  public function setNameAttribute($value){
    $this->attributes['name'] = $value;

    if (! $this->exists) {
      $this->attributes['slug'] = str_slug($value);
    }
  }

}
