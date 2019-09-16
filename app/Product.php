<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  /**
   * Name of the table
   *
   * @var string
   */
  protected $table = 'product';

  /**
   * Disable standart timestamps
   *
   * @var bool
   */
  public $timestamps = false;
}
