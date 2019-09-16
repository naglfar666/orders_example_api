<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\ResponseBuilder;

class UserController extends Controller
{

  /**
   * Getting user's profile info
   *
   * @param integer $id - Id of user
   *
   * @return Response|array
   */
  public function profile($id)
  {
    $user = \App\User::find($id);

    $ResponseBuilder = new ResponseBuilder();

    if (!$user) {
      return response(
        $ResponseBuilder
          ->error()
          ->setText('User not found')
          ->build()
      , 400);
    }

    return $ResponseBuilder
            ->ok()
            ->setData($user)
            ->build();
  }

  /**
   * Getting list of users
   *
   * @return array
   */
  public function list()
  {
    $ResponseBuilder = new ResponseBuilder();

    return $ResponseBuilder
            ->ok()
            ->setData(\App\User::all())
            ->build();
  }
  
}
