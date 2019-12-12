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
}
