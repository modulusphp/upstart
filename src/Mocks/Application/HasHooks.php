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

  /**
   * Add service to create list
   *
   * @param string $name
   * @return void
   */
  public static function addToCreateList(string $name)
  {
    Application::$create = array_merge(Application::$create, [$name]);
  }

  /**
   * Add new hook
   *
   * @param array $hook
   * @return void
   */
  public static function setHook(array $hook)
  {
    self::$hooks = array_merge(self::$hooks, $hook);
  }

  /**
   * Check if hook has been registered
   *
   * @param string $name
   * @return bool
   */
  public static function hasHook(string $name)
  {
    return isset(array_keys(self::$hooks)[$name]);
  }

  /**
   * Get all registered hooks
   *
   * @return array
   */
  public function getHooks() : array
  {
    return Application::$hooks;
  }

  /**
   * Check if property should be created
   *
   * @param string $property
   * @return bool
   */
  private static function shouldCreate($property) : bool
  {
    return isset(Application::$create[$property]);
  }
}
