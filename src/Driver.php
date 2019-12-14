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

  /**
   * Register a new driver
   *
   * @param string $name Name of the driver
   * @param string $driver Driver class
   */
  public function register(string $name, string $driver)
  {
    if (!class_exists($driver)) throw new Exception('Driver does not exist');

    $this->base::register($name, $driver);
  }
}
