<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Order;
use App\Product;
use App\User;

class OrderTest extends TestCase
{
  /**
   * Create order
   *
   * @return void
   */
  public function test_create()
  {

    $Product = new Product();
    $Product->title = 'prods';
    $Product->discount = 10;
    $Product->discount_quantity = 2;
    $Product->price = 11;
    $Product->date_add = time();
    $Product->save();

    $User = new User();
    $User->surname = 'asdq';
    $User->name = 'zxc';
    $User->date_add = time();
    $User->save();

    $data = [
      'product_id' => $Product->id,
      'user_id' => $User->id,
      'quantity' => 2
    ];

    $this->json('POST','/api/order/add', $data)
      ->assertStatus(200)
      ->assertJson(['type' => 'success']);
  }
  /**
   * Updating order
   *
   * @return void
   */
  public function test_update()
  {
    $Product = new Product();
    $Product->title = 'prods';
    $Product->discount = 10;
    $Product->discount_quantity = 2;
    $Product->price = 11;
    $Product->date_add = time();
    $Product->save();

    $User = new User();
    $User->surname = 'asdq';
    $User->name = 'zxc';
    $User->date_add = time();
    $User->save();

    $Order = new \App\Order();
    $Order->user_id = $User->id;
    $Order->product_id = $Product->id;
    $Order->quantity = 5;
    $Order->discount = $Product->discount;
    $Order->price = \App\Utils\Price::buildDiscount($Product, 5);
    $Order->date_add = time();
    $Order->save();

    $this->json('POST', '/api/order/edit', [
      'id' => $Order->id,
      'user_id' => $User->id,
      'product_id' => $Product->id,
      'quantity' => 6
    ])
      ->assertStatus(200)
      ->assertJson(['type' => 'success']);
  }

  /**
   * Listing orders
   *
   * @return void
   */
  public function test_list()
  {
    $this->json('GET', '/api/order/list')
      ->assertStatus(200)
      ->assertJson(['type' => 'success']);
  }

  /**
   * Getting single order
   *
   * @return void
   */
   public function test_single()
   {
     $Product = new Product();
     $Product->title = 'prods';
     $Product->discount = 10;
     $Product->discount_quantity = 2;
     $Product->price = 11;
     $Product->date_add = time();
     $Product->save();

     $User = new User();
     $User->surname = 'asdq';
     $User->name = 'zxc';
     $User->date_add = time();
     $User->save();

     $Order = new \App\Order();
     $Order->user_id = $User->id;
     $Order->product_id = $Product->id;
     $Order->quantity = 5;
     $Order->discount = $Product->discount;
     $Order->price = \App\Utils\Price::buildDiscount($Product, 5);
     $Order->date_add = time();
     $Order->save();

     $this->json('GET', '/api/order/single/'.$Order->id)
       ->assertStatus(200)
       ->assertJson(['type' => 'success']);
   }
}
