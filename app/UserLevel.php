<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
  public function posts(){
    return $this->hasMany('App\User');
  }
}
