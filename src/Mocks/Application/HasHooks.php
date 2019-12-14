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
   * Get registered hook
   *
   * @param string $property
   * @return mixed
   */
  public function __get(string $property)
  {
    return isset(Application::$hooks[$property]) ? (Application::shouldCreate($property) ? new Application::$hooks[$property] : Application::$hooks[$property]) : null;
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

  /**
   * Get total count of hooks
   *
   * @return int
   */
  public function count() : int
  {
    return count(Application::$hooks);
  }
}
