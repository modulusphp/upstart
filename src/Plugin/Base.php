<?php

namespace Modulus\Upstart\Plugin;

use Exception;
use Modulus\Upstart\Driver;
use Modulus\Upstart\Application;

class Base
{
  use HasRouter;
  use HasScheduler;

  /**
   * Application container
   *
   * @var Application $app
   */
  protected $app;

  /**
   * Path containing craftsman commands
   *
   * @var string $commands
   */
  protected $commands;

  /**
   * Path containing database migrations
   *
   * @var string $migrations
   */
  protected $migrations;

  /**
   * Build plugin
   *
   * @return void
   */
  public function __construct()
  {
    $this->configureNamespace();
  }

  /**
   * Boot plugin
   *
   * @return void
   */
  protected function boot() : void
  {
    //
  }

  /**
   * Get path containing craftsman commands
   *
   * @return null|string
   */
  public function getCommands() : ?string
  {
    return is_string($this->commands) && is_dir($this->commands) ? $this->commands : null;
  }

  /**
   * Get path containing database migrations
   *
   * @return null|string
   */
  public function getMigrations() : ?string
  {
    return is_string($this->migrations) && is_dir($this->migrations) ? $this->migrations : null;
  }

  /**
   * Start plugin
   *
   * @return void
   */
  public function start(Application $app) : void
  {
    $this->app = $app;

    $this->boot();
  }

  /**
   * Extendable class
   *
   * @param string $class
   * @return Driver
   */
  public function base(string $class) : Driver
  {
    if (!class_exists($class)) throw new Exception('Class does not exist');

    if (!method_exists($class, 'register')) throw new Exception('Base class doesn\'t allow driver registrations');

    return new Driver($class);
  }
}
