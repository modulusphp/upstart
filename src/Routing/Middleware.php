<?php

namespace Modulus\Upstart\Routing;

use Modulus\Http\Kernel;

class Middleware
{
  /**
   * @var Kernel $httpFoundation
   */
  private $httpFoundation;

  /**
   * Set application http foundation
   *
   * @var Kernel $httpFoundation
   * @return Middleware
   */
  public static function setFoundation(Kernel $httpFoundation)
  {
    $middlware = new self;

    $middlware->httpFoundation = $httpFoundation;

    return $middlware;
  }

  /**
   * Run middleware
   *
   * @param \Modulus\Http\Request $request
   * @param object $route
   * @param string $group
   * @param array $all
   * @return void
   */
  public function run($request, object $route, string $group, array $all = [])
  {
    foreach ($route->middleware as $value) {
      if (isset($this->httpFoundation->getRouteMiddleware()[explode(':', $value)[0]]) || class_exists($value)) $all[] = $value;
    }

    $first      = isset($this->httpFoundation->getMiddlewareGroup()[isset($route->middleware[0]) ? $route->middleware[0] : null]) ? true : null;
    $middlwares = $first ? array_merge($this->httpFoundation->getMiddlewareGroup()[$route->middleware[0]] ?? [], $all) : $all;
    $middlwares = array_merge($this->httpFoundation->getMiddleware(), $middlwares);

    foreach($middlwares as $middleroute) {
      $attributes = [];

      if (isset($this->httpFoundation->getRouteMiddleware()[explode(':', $middleroute)[0]])) {
        $route = explode(':', $middleroute);

        if (count($route) > 1) $attributes = explode(',', explode(':', $middleroute)[1]);

        $middleroute = $this->httpFoundation->getRouteMiddleware()[explode(':', $middleroute)[0]];
      }

      if ((new $middleroute)->handle($request, true, $attributes) == false) exit;
    }
  }
}
