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
}
