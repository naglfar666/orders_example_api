<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\ResponseBuilder;

class ProductController extends Controller
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
   * Getting list of products
   *
   * @return array
   */
  public function list()
  {
    return $this->ResponseBuilder
            ->ok()
            ->setData(\App\Product::all())
            ->build();
  }

  /**
   * Adding new product
   *
   * @param Request $request
   *
   * @return array
   */
  public function add(Request $request)
  {
    $request->validate([
      'title' => 'required|max:255',
      'discount' => 'required_if:useDiscount,1|regex:/^\d+(\.\d{1,2})?$/',
      'discount_quantity' => 'required_if:useDiscount,1|numeric|not_in:0',
      'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
    ]);

    $Product = new \App\Product();
    $Product->title = $request->input('title');
    $Product->discount = ($request->input('useDiscount') === true) ? $request->input('discount') : 0;
    $Product->discount_quantity = ($request->input('useDiscount') === true) ? $request->input('discount_quantity') : 0;
    $Product->price = $request->input('price');
    $Product->date_add = time();
    $Product->save();

    return $this->ResponseBuilder
            ->ok()
            ->setData($Product)
            ->build();

  }

  /**
   * Editing the product
   *
   * @param Request $request
   *
   * @return array
   */
  public function edit(Request $request)
  {
    $request->validate([
      'id' => 'required|numeric',
      'title' => 'required|max:255',
      'discount' => 'required_if:useDiscount,1|regex:/^\d+(\.\d{1,2})?$/',
      'discount_quantity' => 'required_if:useDiscount,1|numeric|not_in:0',
      'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
    ]);

    $Product = \App\Product::find($request->input('id'));

    if (!$Product) {
      return response(
        $this->ResponseBuilder
          ->error()
          ->setText('Product not found')
          ->build()
      , 400);
    }

    $Product->title = $request->input('title');
    $Product->discount = ($request->input('useDiscount') === true) ? $request->input('discount') : 0;
    $Product->discount_quantity = ($request->input('useDiscount') === true) ? $request->input('discount_quantity') : 0;
    $Product->price = $request->input('price');
    $Product->save();

    return $this->ResponseBuilder
            ->ok()
            ->setData($Product)
            ->build();
  }
}
