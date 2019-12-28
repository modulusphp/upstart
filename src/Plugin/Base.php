<?php

namespace Modulus\Upstart\Plugin;

use Exception;
use Modulus\Upstart\Driver;
use Modulus\Upstart\Application;

class Base
{
  use HasRouter;
  use HasScheduler;

  /**
   * Extendable class
   *
   * @param string $class
   * @return Driver
   */
  public function base(string $class) : Driver
  {
    if (!class_exists($class)) throw new Exception('Class does not exist');

    if (!method_exists($class, 'register')) throw new Exception('Base class doesn\'t allow driver registrations');

    return new Driver($class);
  }
}
