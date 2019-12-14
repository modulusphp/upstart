<?php

namespace Modulus\Upstart;

use Exception;

class Driver
{
  /**
   * Application base
   *
   * @var mixed
   */
  protected $base;

  /**
   * Instantiate Driver
   *
   * @param string $class
   * @return void
   */
  public function __construct(string $class)
  {
    $this->base = $class;
  }
}
