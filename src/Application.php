<?php

namespace Modulus\Upstart;

use Countable;
use IteratorAggregate;
use Modulus\Upstart\Boot\{
  PluginHandler,
  EnvironmentVariables,
  ApplicationConfigHandler
};
use Modulus\Upstart\Mocks\Application\{
  HasBase,
  HasHooks,
  HasPaths,
  HasConsole,
  HasResponse,
  HasPrototyping,
  HasInformation,
  HasBootableServices
};

class Application implements Countable, IteratorAggregate
{
  use HasBase;
  use HasHooks;
  use HasPaths;
  use HasConsole;
  use HasResponse;
  use HasPrototyping;
  use HasInformation;
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
   * @param string $root Application root directory
   * @param array $options Application options
   * @return Application
   */
  public static function boot(string $root, array $options = []) : Application
  {
    $app = (Application::$app ?? Application::$app = new Application($root));

    $app->make(new EnvironmentVariables(APP_ROOT, $options['env'] ?? null))
        ->make(new ApplicationConfigHandler(APP_ROOT, $options['autocache'] ?? false))
        ->make(new PluginHandler);

    return $app;
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
