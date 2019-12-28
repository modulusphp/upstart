<?php

namespace Modulus\Upstart\Mocks\Application;

use AtlantisPHP\Swish\Route;
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
   * Boot all bootable services
   *
   * @return void
   */
  private function withServices()
  {
    /** @var Application $this */

    foreach ($this->bootable as $service) {

      if ($service instanceof ApplicationServices) {
        $service->is_hook($service->start($this), $this);

        $this->withDirectives()
              ->withView()
              ->withAliases()
              ->withRouter()
              ->bootApp()
              ->dispatchRoutes()
              ->addCommands();

      } else if ($service instanceof BootableService) {
        $service->is_hook($service->start(), $this);

        if ($service instanceof EnvironmentVariables)
          $this->setKey($this->env['APP_KEY']);

      }
    }

    /** Boot cli if app is being called from craftsman */
    if ($this->isConsole()) $this->kernel->run();
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

  /**
   * Create application aliases
   *
   * @return Application
   */
  private function withAliases()
  {
    $aliases = $this->config && isset($this->config['app']['aliases']) ? $this->config['app']['aliases'] : [];

    foreach($aliases as $alias => $class) {
      class_alias($class, $alias);
    }

    return $this;
  }

  /**
   * Make application router
   *
   * @return Application
   */
  private function withRouter()
  {
    /** @var \Modulus\Upstart\Plugin\Base $plugin*/

    foreach($this->plugins as $plugin) {
      $plugin->setRouter(new Route)
            ->bootRouter();
    }

    Router::make($this);

    return $this;
  }

  /**
   * Start application services
   *
   * @return Application
   */
  private function bootApp()
  {
    $this->services->getAppServiceResolver()->start();

    /** @var \Modulus\Upstart\Plugin\Base $plugin*/

    foreach($this->plugins as $plugin) {
      $plugin->start($this);
    }

    return $this;
  }

  /**
   * Load routes
   *
   * @return Application
   */
  private function dispatchRoutes()
  {
    if (!$this->isConsole()) Route::dispatch();

    return $this;
  }

  /**
   * Load plugin commands
   *
   * @return Application
   */
  private function addCommands()
  {
    /** @var Application $this */
    
    if (!$this->isConsole()) return $this;
    
    /** @var \Modulus\Upstart\Plugin\Base $plugin*/

    foreach($this->plugins as $plugin) {
      if ($plugin->getCommands()) $this->kernel->load($plugin->getCommands(), true);
    }

    return $this;
  }
}
