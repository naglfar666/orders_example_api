<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  /**
   * Name of the table
   *
   * @var string
   */
  protected $table = 'user';

  /**
   * Disable standart timestamps
   *
   * @var bool
   */
  public $timestamps = false;
}
