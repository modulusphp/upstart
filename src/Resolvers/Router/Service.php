<?php

namespace Modulus\Upstart\Resolvers\Router;

use Modulus\Http\Route;
use Modulus\Upstart\Application;

class Service
{
  /**
   * This namespace is applied to your controller routes.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */
  protected $namespace = 'App\Http\Controllers';

  /**
   * Redirect route after authentication
   *
   * @var string
   */
  public const HOME = '/home';

  /**
   * Application router
   *
   * @var Route $route
   */
  protected $route;

  /**
   * Create a new service
   *
   * @param Application $app
   * @return void
   */
  public function __construct()
  {
    $this->route = new Route;
  }

  /**
   * Get controller base namespace
   *
   * @return string
   */
  public function getNamespace() : string
  {
    return $this->namespace;
  }

  /**
   * Start resolver
   *
   * @return void
   */
  public function start()
  {
    $this->boot();
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
}
