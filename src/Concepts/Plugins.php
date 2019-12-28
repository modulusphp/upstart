<?php

namespace Modulus\Upstart\Concepts;

use Iterator;
use Countable;

class Plugins implements Countable, Iterator
{
  /**
   * A list of registered plugins
   *
   * @var array $registered
   */
  protected $registered;

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
}
