<?php

namespace Modulus\Upstart\Plugin;

use AtlantisPHP\Swish\Route;

trait HasRouter
{
  /**
   * Application router
   *
   * @var Route $router
   */
  protected $router;

  /**
   * Plugin namespace
   *
   * @var string $namespace
   */
  protected $namespace;

  /**
   * Set plugin namespace
   *
   * @param string $namespace
   * @return void
   */
  public function setNamespace(string $namespace)
  {
    $this->namespace = $namespace;
  }

  /**
   * Get plugin namespace
   *
   * @return string|null $namespace
   */
  public function getNamespace()
  {
    return $this->namespace;
  }

  /**
   * Configure namespace
   *
   * @return void
   */
  private function configureNamespace()
  {
    $this->namespace = $this->namespace ? '\\' . $this->namespace : $this->namespace;
  }

  /**
   * Set plugin router
   *
   * @param Route $router
   * @return Base
   */
  public function setRouter(Route $router)
  {
    $this->router = $router;

    return $this;
  }

  /**
   * Register routes
   *
   * @return void
   */
  protected function routes() : void
  {
    //
  }

  /**
   * Start plugin router
   *
   * @return void
   */
  public function bootRouter() : void
  {
    $this->router->group(['namespace' => $this->namespace], function () {
      $this->routes();
    });
  }
}
