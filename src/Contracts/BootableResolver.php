<?php

namespace Modulus\Upstart\Contracts;

interface BootableResolver
{
  /**
   * Boot service
   *
   * @return void
   */
  public function boot(): void;
}
