<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Update extends Model{

  protected $table = 'updates';
  protected $dates = ['created_at', 'updated_at'];
  protected $fillable = [
      'owner',
      'name',
      'filename',
      'description',
  ];

}
