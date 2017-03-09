<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

  public function getPublicProfile($id){
    $user = User::find($id);
    return view('users.public_profile')->withUser($user); 
  }

}
