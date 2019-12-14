<?php

namespace Modulus\Upstart\Boot;

use Dotenv\Dotenv;
use Modulus\Upstart\BootableService;

class EnvironmentVariables extends BootableService
{
  /**
   * DotEnv path
   *
   * @var string $path
   */
  private $path;

  /**
   * DotEnv file name
   *
   * @var string $name
   */
  private $name;

  /**
   * Set env path
   *
   * @param string $path
   * @param string|null $name
   * @return void
   */
  public function __construct(string $path, string $name = null)
  {
    $this->path = $path;
    $this->name = $name;
  }

  /**
   * {@inheritDoc}
   */
  protected function boot()
  {
    $dotenv = Dotenv::create(
      $this->path,
      $this->name
    );

    return $this->hook(
      'env', $dotenv->safeLoad()
    );
  }
}
