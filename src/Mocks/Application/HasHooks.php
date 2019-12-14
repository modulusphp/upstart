<?php

namespace Modulus\Upstart\Mocks\Application;

use Modulus\Upstart\Application;

trait HasHooks
{
  /**
   * Application hooks
   *
   * @var array $hooks
   */
  private static $hooks = [];

  /**
   * A list of classes / services that should be created when they can called.
   *
   * @var array $create
   */
  private static $create = [];
}
