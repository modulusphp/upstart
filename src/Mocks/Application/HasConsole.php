<?php

namespace Modulus\Upstart\Mocks\Application;

use Exception;
use Modulus\Console\Kernel;

trait HasConsole
{
  /**
   * Application console
   *
   * @var Kernel
   */
  public $kernel;

  /**
   * Set application console
   *
   * @param Kernel $kernel
   * @return mixed
   */
  public function console(string $kernel)
  {
  if (class_exists($kernel)) {
    return $this->kernel = $kernel::console();
  }

    throw new Exception('Kernel does not exist');
  }

  /**
   * Check if application is in cli mode
   *
   * @return bool
   */
  public function isConsole() : bool
  {
    return (strtolower(php_sapi_name()) === 'cli');
  }
}