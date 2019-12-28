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
   * Application container
   *
   * @var Application $app
   */
  protected $app;

  /**
   * Boot plugin
   *
   * @return void
   */
  protected function boot() : void
  {
    //
  }

  /**
   * Start plugin
   *
   * @return void
   */
  public function start(Application $app) : void
  {
    $this->app = $app;

    $this->boot();
  }

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
