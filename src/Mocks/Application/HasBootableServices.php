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

  /**
   * Configure view directives
   *
   * @return Application
   */
  private function withDirectives()
  {
    Using::$engine      = $this->config['view']['engine'];
    Using::$views       = $this->config['view']['views'];
    Partial::$views     = $this->config['view']['views'];
    Partial::$extension = $this->config['view']['extension'];

    return $this;
  }

  /**
   * Create view component
   *
   * @return Application
   */
  private function withView()
  {
    Accessor::$viewsExtension = $this->config['view']['extension'];
    Accessor::$viewsEngine    = $this->config['view']['engine'];
    Accessor::$viewsCache     = $this->config['view']['compiled'];
    Accessor::$viewsDirectory = $this->config['view']['views'];

    /** load component */
    if (!$this->kernel) Accessor::requireView();

    return $this;
  }
}
