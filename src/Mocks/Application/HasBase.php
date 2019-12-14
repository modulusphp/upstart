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
   * Application has started
   *
   * @var bool $started
   */
  private $started = false;

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

  /**
   * Return root
   *
   * @param string|null $path
   * @return string
   */
  public function root(string $path = null)
  {
    return $this->root . ($path ? ltrim($path, '/') : '');
  }

  /**
   * Return root
   *
   * @param string|null $path
   * @return string
   */
  public function getRoot(string $path = null)
  {
    return $this->root . ($path ? ltrim($path, '/') : '');
  }
}
