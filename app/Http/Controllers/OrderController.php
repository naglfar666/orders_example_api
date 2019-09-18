<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\ResponseBuilder;

class OrderController extends Controller
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
   * Getting single Order info
   *
   * @param integer $id - Id of Product
   *
   * @return Response|array
   */
  public function single($id)
  {
    $Order = \App\Order::find($id);

    if (!$Order) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('Order not found')
          ->build()
      , 400);
    }

    return $this->ResponseBuilder
            ->ok()
            ->setData($Order)
            ->build();
  }

  /**
   * Getting list of orders
   *
   * @return array
   */
  public function list(Request $request)
  {
    $Order = new \App\Order();
    return $this->ResponseBuilder
            ->ok()
            ->setData($Order->getWithPaginationAndFilters($request))
            ->build();
  }

  /**
   * Adding new order
   *
   * @param Request $request
   *
   * @return array
   */
  public function add(Request $request)
  {
    $request->validate([
      'user_id' => 'required|numeric',
      'product_id' => 'required|numeric',
      'quantity' => 'required|numeric|not_in:0'
    ]);

    $User = \App\User::find($request->input('user_id'));

    if (!$User) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('User not found')
          ->build()
      , 400);
    }

    $Product = \App\Product::find($request->input('product_id'));

    if (!$Product) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('Product not found')
          ->build()
      , 400);
    }

    $Order = new \App\Order();
    $Order->user_id = $request->input('user_id');
    $Order->product_id = $request->input('product_id');
    $Order->quantity = $request->input('quantity');
    $Order->discount = $Product->discount;
    $Order->price = \App\Utils\Price::buildDiscount($Product, $request->input('quantity'));
    $Order->date_add = time();
    $Order->save();

    return $this->ResponseBuilder
            ->ok()
            ->setData($Order)
            ->build();

  }

  /**
   * Editing the order
   *
   * @param Request $request
   *
   * @return array
   */
  public function edit(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
      'user_id' => 'required|numeric',
      'product_id' => 'required|numeric',
      'quantity' => 'required|numeric|not_in:0'
    ]);

    $User = \App\User::find($request->input('user_id'));

    if (!$User) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('User not found')
          ->build()
      , 400);
    }

    $Product = \App\Product::find($request->input('product_id'));

    if (!$Product) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('Product not found')
          ->build()
      , 400);
    }

    $Order = \App\Order::find($request->input('id'));
    $Order->user_id = $request->input('user_id');
    $Order->product_id = $request->input('product_id');
    $Order->quantity = $request->input('quantity');
    $Order->discount = $Product->discount;
    $Order->price = \App\Utils\Price::buildDiscount($Product, $request->input('quantity'));
    $Order->date_add = time();
    $Order->save();

    return $this->ResponseBuilder
            ->ok()
            ->setData($Order)
            ->build();

  }

  /**
   * Removing order
   *
   * @param integer $id - Id of Product
   *
   * @return Response|array
   */
  public function delete($id)
  {
    $Order = \App\Order::find($id);

    if (!$Order) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('Order not found')
          ->build()
      , 400);
    }

    $Order->delete();

    return $this->ResponseBuilder
            ->ok()
            ->build();
  }
}
