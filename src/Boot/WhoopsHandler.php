<?php

namespace Modulus\Upstart\Boot;

use Modulus\Upstart\BootableService;
use Modulus\Upstart\Concepts\Whoops;

class WhoopsHandler extends BootableService
{
  /**
   * Whoops config
   *
   * @var array $config
   */
  private $config;

  /**
   * Set whoops config
   *
   * @param array|null $config
   * @return void
   */
  public function __construct(array $config = null)
  {
    $this->config = $config;
  }

  /**
   * {@inheritDoc}
   */
  protected function boot()
  {
    return $this->hook(
      'whoops', Whoops::create($this->config)
    );
  }
}