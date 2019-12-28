<?php

namespace Modulus\Upstart\Boot;

use Modulus\Upstart\BootableService;
use Modulus\Upstart\Concepts\Plugins;

class PluginHandler extends BootableService
{
  /**
   * {@inheritDoc}
   */
  protected function boot()
  {
    return $this->hook(
      'plugins', new Plugins
    );
  }
}
