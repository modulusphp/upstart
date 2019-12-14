<?php

namespace Modulus\Upstart\Boot;

use Modulus\Upstart\BootableService;
use Modulus\Upstart\Concepts\Bugsnag;

class BugsnagHandler extends BootableService
{
  /**
   * {@inheritDoc}
   */
  protected function boot()
  {
    return $this->hook(
      'bugsnag', Bugsnag::create()
    );
  }
}
