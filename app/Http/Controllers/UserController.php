<?php

namespace App\Http\Controllers;

use App\User;
use App\UserLevel;
use Illuminate\Http\Request;

class UserController extends Controller {

  public function getPublicProfile($id){
    $user = User::find($id);
    $level = UserLevel::find($user->level_id)->level;
    return view('users.public_profile')->withUser($user)->with(['level' => $level]); 
  }

}
