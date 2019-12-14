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
}
