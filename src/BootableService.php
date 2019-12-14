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
   * @var \Modulus\Upstart\Application $app
   */
  protected $app;

  /**
   * Boot service
   *
   * @return array|void $this->hook
   */
  protected function boot()
  {
    //
  }

  /**
   * Return a app hookable class
   *
   * @param string $name
   * @param mixed $class
   * @return array
   */
  protected function hook(string $name, $class, ?bool $create = false) : array
  {
    if ($create) Application::addToCreateList($name);

    return [$name => $class];
  }

  /**
   * Create first citizen class
   *
   * @param mixed $hook
   * @param Application $app
   * @return void
   */
  public function is_hook($hook, Application $app)
  {
    if (is_array($hook) && $hook !== []) {
      $name  = array_key_first($hook);
      $class = array_values($hook);

      $app->setHook([$name => is_array($class) ? $class[0] : $class]);
    }
  }

  /**
   * Start service
   *
   * @return array|void
   */
  public function start($app = null)
  {
    $this->app = $app;

    return $this->boot();
  }
}
