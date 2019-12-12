<?php

namespace Modulus\Upstart\Concepts;

class CoreServices
{
  /**
   * @var \App\Http\HttpFoundation $httpFoundation
   */
  protected $httpFoundation;

  /**
   * @var \App\Exceptions\Handler
   */
  protected $handler;

  /**
   * @var \App\Resolvers\RouterResolver
   */
  protected $routerResolver;

  /**
   * @var \App\Resolvers\AppServiceResolver:
   */
  protected $appServiceResolver;

  /**
   * Boot up core services
   *
   * @param \Modulus\Upstart\Application $app
   * @param \App\Http\HttpFoundation $foundation
   * @param \App\Exceptions\Handler $handler
   * @param \App\Resolvers\RouterResolver $routerResolver
   * @param \App\Resolvers\AppServiceResolver $appServiceResolver
   * @return void
   */
  public function __construct($app, $foundation = null, $handler = null, $routerResolver = null, $appServiceResolver = null)
  {
    $this->httpFoundation     = $foundation && class_exists($foundation) ? new $foundation : null;
    $this->handler            = $handler && class_exists($handler) ? new $handler : null;
    $this->routerResolver     = $routerResolver && class_exists($routerResolver) ? new $routerResolver : null;
    $this->appServiceResolver = $appServiceResolver && class_exists($appServiceResolver) ? (new $appServiceResolver($app)) : null;
  }

  /**
   * Get application http foundation
   *
   * @return \App\Http\HttpFoundation
   */
  public function getHttpFoundation()
  {
    return $this->httpFoundation;
  }
}
