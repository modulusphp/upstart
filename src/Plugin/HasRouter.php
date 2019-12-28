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
