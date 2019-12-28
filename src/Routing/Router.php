<?php

namespace Modulus\Upstart\Routing;

use Modulus\Http\Middleware as HttpMiddleware;

class Router
{
  /**
   * Get middleware from controller
   *
   * @param callback $callback
   * @return array
   */
  private static function getMiddleware($callback) : array
  {
    if (is_array($callback) && isset($callback[0]->middleware)) {
      $method = $callback[1];

      if ($callback[0]->middleware instanceof HttpMiddleware) {
        $middleware = $callback[0]->middleware;

        if (count($middleware->only) > 0 && in_array($method, $middleware->only)) {
          $all = $middleware->all;
        } else if (count($middleware->except) > 0 && !in_array($method, $middleware->except)) {
          $all = $middleware->all;
        } else if (count($middleware->only) == 0 && count($middleware->except) == 0) {
          $all = $middleware->all;
        }
      }
    }

    return $all ?? [];
  }
}
