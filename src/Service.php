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
}
