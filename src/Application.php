<?php

namespace Modulus\Upstart;

use Countable;
use IteratorAggregate;

class Application implements Countable, IteratorAggregate
{
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
