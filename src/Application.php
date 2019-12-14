<?php

namespace Modulus\Upstart;

use Countable;
use IteratorAggregate;
use Modulus\Upstart\Mocks\Application\{
  HasBase,
  HasHooks
};

class Application implements Countable, IteratorAggregate
{
  use HasBase;
  use HasHooks;

  /**
   * Static application
   *
   * @var Application|null
   */
  protected static $app;

  /**
   * Get application
   *
   * @return Application|null
   */
  public static function get()
  {
    return Application::$app;
  }
}
