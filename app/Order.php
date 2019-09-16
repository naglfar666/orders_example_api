<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  /**
   * Name of the table
   *
   * @var string
   */
  protected $table = 'order';

  /**
   * Disable standart timestamps
   *
   * @var bool
   */
  public $timestamps = false;
}
