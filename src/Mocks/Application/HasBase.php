<?php

namespace Modulus\Upstart\Mocks\Application;

use Modulus\Upstart\Application;
use Modulus\Upstart\Exceptions\ApplicationHasStartedException;

trait HasBase
{
  /**
   * Root directory
   *
   * @var string $root
   */
  private $root;

  /**
   * Create application
   *
   * @param string $root
   * @return void
   */
  public function __construct(string $root)
  {
    $this->root = rtrim($root, '/') . '/';

    define('APP_ROOT', $this->root);
  }
}
