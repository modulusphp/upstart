<?php

namespace Modulus\Upstart;

use Modulus\Upstart\Application;

class BootableService
{
  /**
   * Instantiate class
   *
   * @var bool
   */
  protected const CREATE = true;

  /**
   * Return class as it is
   *
   * @var bool
   */
  protected const DONT_CREATE = false;

  /**
   * Boot service
   *
   * @return array|void $this->hook
   */
  protected function boot()
  {
    //
  }
}
