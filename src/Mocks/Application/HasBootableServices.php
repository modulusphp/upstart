<?php

namespace Modulus\Upstart\Mocks\Application;

use Modulus\Directives\Using;
use Modulus\Utility\Accessor;
use Modulus\Directives\Partial;
use Modulus\Upstart\Application;
use Modulus\Upstart\Routing\Router;
use Modulus\Upstart\BootableService;
use Modulus\Upstart\Boot\ApplicationServices;
use Modulus\Upstart\Boot\EnvironmentVariables;

trait HasBootableServices
{
  /**
   * A list of all bootable services
   *
   * @var array $bootable
   */
  protected $bootable = [];

  /**
   * Configure service
   *
   * @param BootableService $service
   * @return Application $this
   */
  public function make(BootableService $service) : Application
  {
    $this->bootable[] = $service; 

    return $this;
  }
}
