<?php

namespace Modulus\Upstart;

use Exception;
use Modulus\Upstart\Driver;
use Modulus\Upstart\Application;

class Service
{
  /**
   * Application container
   *
   * @var Application $app
   */
  protected $app;

  /**
   * Create a new service
   *
   * @param Application $app
   * @return void
   */
  public function __construct(Application $app)
  {
    $this->app = $app;
  }

  /**
   * Build and start service
   *
   * @return void
   */
  protected function boot() : void
  {
    //
  }

  /**
   * Start service
   *
   * @return void
   */
  public function start()
  {
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
