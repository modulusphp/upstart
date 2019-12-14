<?php

namespace Modulus\Upstart;

use Countable;
use IteratorAggregate;
use Modulus\Upstart\Mocks\Application\{
  HasBase,
  HasHooks,
  HasConsole,
  HasResponse,
  HasPrototyping,
  HasBootableServices
};

class Application implements Countable, IteratorAggregate
{
  use HasBase;
  use HasHooks;
  use HasConsole;
  use HasResponse;
  use HasPrototyping;
  use HasBootableServices;

  /**
   * Static application
   *
   * @var Application|null
   */
  protected static $app;

  /**
   * Boot application
   *
   * @param string $root
   * @return Application
   */
  public static function boot(string $root) : Application
  {
    return (Application::$app ?? Application::$app = new self($root));
  }

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
