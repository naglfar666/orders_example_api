<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

  /**
   * OneToOne connection with App\Product
   *
   * @return Product
   */
  public function product()
  {
    return $this->hasOne('App\Product','id','product_id');
  }

  /**
   * OneToOne connection with App\User
   *
   * @return User
   */
  public function user()
  {
    return $this->hasOne('App\User','id','user_id');
  }

  /**
   * Get orders joining Product and User with pagination and filters
   *
   * @param Request $request - Instance of Request object
   *
   * @return array
   */
  public function getWithPaginationAndFilters($request)
  {
    $Data = DB::table($this->table)
            ->leftJoin('product','product.id','=',$this->table.'.product_id')
            ->leftJoin('user','user.id','=',$this->table.'.user_id')
            ->select(
              'product.title AS product_title',
              'product.discount AS product_discount',
              'product.id AS product_id',
              'user.surname AS user_surname',
              'user.name AS user_name',
              'user.id AS user_id',
              $this->table.'.id AS id',
              $this->table.'.date_add AS date_add'
            );

    if ($request->filterDate == 'day') {
      $Data->where($this->table.'.date_add', '>=', strtotime(date('Y-m-d')));
    } else if ($request->filterDate == 'week') {
      $Data->where($this->table.'.date_add', '>=', strtotime(date('Y-m-d').' - 7 days'));
    }

    if ($request->filterUser) {
      $Data->where($this->table.'.user_id', '=', $request->filterUser);
    }

    if ($request->filterProduct) {
      $Data->where($this->table.'.product_id', '=', $request->filterProduct);
    }

    return $Data->paginate(5);
  }
}
