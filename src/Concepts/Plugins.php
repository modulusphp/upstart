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
}
