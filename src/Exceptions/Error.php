<?php

namespace Modulus\Upstart\Exceptions;

trait Error
{
  /**
   * Boot exception
   *
   * @return void
   */
  public function boot()
  {
    $args = debug_backtrace();

    foreach (end($args) as $key => $value) {
      $this->{$key} = $value;
    }
  }
}
