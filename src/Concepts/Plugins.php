<?php

namespace Modulus\Upstart\Concepts;

use Iterator;
use Countable;
use Modulus\Upstart\Plugin\Base;

class Plugins implements Countable, Iterator
{
  /**
   * A list of registered plugins
   *
   * @var array $registered
   */
  protected $registered;

  /**
   * The iteration position.
   *
   * @var int
   */
  protected $position = 0;

  /**
   * Build up the plugins
   *
   * @return void
   */
  public function __construct()
  {
    $this->registered = $this->getPlugins();
  }

  /**
   * Iterate through plugins and create classes
   *
   * @param array $plugins
   * @return array $plugins
   */
  private function getPlugins(array $plugins = [])
  {
    foreach(config('app.plugins') as $plugin) {
      $plugins = array_merge($plugins, [new $plugin]);
    }

    return $plugins;
  }

  /**
   * Get total count of plugins
   *
   * @return int
   */
  public function count() : int
  {
    return count($this->registered);
  }

  /**
   * Swop plugin for an updated one
   *
   * @param Base $plugin
   * @param int $key
   * @return void
   */
  public function swop(Base $plugin, $key) : void
  {
    $this->registered[$key] = $plugin;
  }
}
