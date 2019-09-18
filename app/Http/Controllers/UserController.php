<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\ResponseBuilder;

class UserController extends Controller
{

  /**
   * Builder class for the response
   *
   * @var ResponseBuilder|null
   */
  private $ResponseBuilder = null;

  public function __construct()
  {
    $this->ResponseBuilder = new ResponseBuilder();
  }

  /**
   * Getting single User info
   *
   * @param integer $id - Id of user
   *
   * @return Response|array
   */
  public function single($id)
  {
    $User = \App\User::find($id);

    if (!$User) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('User not found')
          ->build()
      , 400);
    }

    return $this->ResponseBuilder
            ->ok()
            ->setData($User)
            ->build();
  }

  /**
   * Getting list of users
   *
   * @return array
   */
  public function list()
  {
    return $this->ResponseBuilder
            ->ok()
            ->setData(\App\User::all())
            ->build();
  }

  /**
   * Adding new user
   *
   * @param Request $request
   *
   * @return array
   */
  public function add(Request $request)
  {
    $request->validate([
      'name' => 'required|max:255',
      'surname' => 'required|max:255'
    ]);

    $User = new \App\User();
    $User->name = $request->input('name');
    $User->surname = $request->input('surname');
    $User->date_add = time();
    $User->save();

    return $this->ResponseBuilder
            ->ok()
            ->setData($User)
            ->build();
  }

  /**
   * Editing the user
   *
   * @param Request $request
   *
   * @return array
   */
  public function edit(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
      'name' => 'required|max:255',
      'surname' => 'required|max:255'
    ]);

    $User = \App\User::find($request->input('id'));

    if (!$User) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('User not found')
          ->build()
      , 400);
    }

    $User->name = $request->input('name');
    $User->surname = $request->input('surname');
    $User->save();

    return $this->ResponseBuilder
            ->ok()
            ->setData($User)
            ->build();
  }

  /**
   * Removing user
   *
   * @param integer $id - Id of user
   *
   * @return Response|array
   */
  public function delete($id)
  {
    $User = \App\User::find($id);

    if (!$User) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('User not found')
          ->build()
      , 400);
    }

    $User->delete();
    
    return $this->ResponseBuilder
            ->ok()
            ->build();
  }

}
