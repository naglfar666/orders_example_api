<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
  /**
   * Create user
   *
   * @return void
   */
  public function test_create()
  {
      $data = [
        'surname' => 'asd',
        'name' => 'xzc'
      ];

      $this->json('POST','/api/user/add', $data)
        ->assertStatus(200)
        ->assertJson(['type' => 'success']);
  }
  /**
   * Updating user
   *
   * @return void
   */
  public function test_update()
  {
    $User = new User();
    $User->surname = 'asdq';
    $User->name = 'zxc';
    $User->date_add = time();
    $User->save();

    $this->json('POST', '/api/user/edit', [
      'id' => $User->id,
      'surname' => 'ytrw',
      'name' => 'cxvxc'
    ])
      ->assertStatus(200)
      ->assertJson(['type' => 'success']);
  }

  /**
   * Listing users
   *
   * @return void
   */
  public function test_list()
  {
    $this->json('GET', '/api/user/list')
      ->assertStatus(200)
      ->assertJson(['type' => 'success']);
  }

  /**
   * Getting single product
   *
   * @return void
   */
   public function test_single()
   {
     $User = new User();
     $User->surname = 'asdq';
     $User->name = 'zxc';
     $User->date_add = time();
     $User->save();

     $this->json('GET', '/api/user/single/'.$User->id)
       ->assertStatus(200)
       ->assertJson(['type' => 'success']);
   }
}
