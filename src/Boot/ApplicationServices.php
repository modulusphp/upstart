<?php

namespace Modulus\Upstart\Boot;

use Modulus\Upstart\BootableService;
use Modulus\Upstart\Concepts\CoreServices;

class ApplicationServices extends BootableService
{
  /**
   * Http foundation service
   *
   * @var string $httpClass
   */
  protected $httpClass;

  /**
   * Handler service
   *
   * @var string $handler
   */
  protected $handler;

  /**
   * Router service
   *
   * @var string $routerResolver
   */
  protected $routerResolver;

  /**
   * App service
   *
   * @var string $appServiceResolver
   */
  protected $appServiceResolver;

  /**
   * Build up services
   *
   * @param array $services
   * @return void
   */
  public function __construct(array $services = [])
  {
    $this->httpClass          = isset($services['httpFoundation']) ? $services['httpFoundation'] : null;
    $this->handler            = isset($services['handler']) ? $services['handler'] : null;
    $this->routerResolver     = isset($services['routerResolver']) ? $services['routerResolver'] : null;
    $this->appServiceResolver = isset($services['appServiceResolver']) ? $services['appServiceResolver'] : null;
  }

  /**
   * {@inheritDoc}
   */
  protected function boot()
  {
    return $this->hook('services', new CoreServices(
      $this->app, $this->httpClass, $this->handler, $this->routerResolver, $this->appServiceResolver
    ));
  }
}
