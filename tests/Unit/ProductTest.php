<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class ProductTest extends TestCase
{
    /**
     * Create product
     *
     * @return void
     */
    public function test_create()
    {
        $data = [
          'title' => 'asd',
          'price' => 5
        ];

        $this->json('POST','/api/product/add', $data)
          ->assertStatus(200)
          ->assertJson(['type' => 'success']);
    }
    /**
     * Create product with discount
     *
     * @return void
     */
    public function test_create_discount()
    {
      $data = [
        'title' => 'prod',
        'price' => 10,
        'useDiscount' => true,
        'discount' => 5,
        'discount_quantity' => 2
      ];

      $this->json('POST', '/api/product/add', $data)
        ->assertStatus(200)
        ->assertJson(['type' => 'success']);
    }
    /**
     * Updating product with discount to no discount
     *
     * @return void
     */
    public function test_update_discount()
    {
      $Product = new Product();
      $Product->title = 'prods';
      $Product->discount = 10;
      $Product->discount_quantity = 2;
      $Product->price = 11;
      $Product->date_add = time();
      $Product->save();

      $this->json('POST', '/api/product/edit', [
        'id' => $Product->id,
        'title' => 'new_prod',
        'price' => 12,
        'useDiscount' => false
      ])
        ->assertStatus(200)
        ->assertJson(['type' => 'success']);
    }

    /**
     * Listing products
     *
     * @return void
     */
    public function test_list()
    {
      $this->json('GET', '/api/product/list')
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
       $Product = new Product();
       $Product->title = 'prods';
       $Product->discount = 10;
       $Product->discount_quantity = 2;
       $Product->price = 11;
       $Product->date_add = time();
       $Product->save();

       $this->json('GET', '/api/product/single/'.$Product->id)
         ->assertStatus(200)
         ->assertJson(['type' => 'success']);
     }
}
