<?php

namespace App\Utils;

use App\Product;

class Price
{

  /**
   * Get price with discount
   *
   * @param Product $product - Instance of Product object
   * @param integer $quantity - Quantity of the product
   *
   * @return double|integer
   */
  public static function buildDiscount(Product $product, $quantity)
  {
    $discount_sum = 0;
    if ($product->discount > 0) {
      if ($quantity >= $product->discount_quantity) {
        $discount_sum = $product->price * ($product->discount / 100) * $quantity;
      }
    }
    return round($product->price * $quantity - $discount_sum, 2);
  }
}
