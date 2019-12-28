<?php

namespace Modulus\Upstart\Routing;

use AtlantisPHP\Swish\Route;
use Modulus\Upstart\Application;
use AtlantisPHP\Swish\SwishHandler;
use Modulus\Http\Exceptions\BadRequestHttpException;
use Modulus\Http\Middleware as HttpMiddleware;
use Modulus\Http\Exceptions\NotFoundHttpException;

class Router
{
  /**
   * Start the router resolver
   *
   * @param Application $app
   * @return 
   */
  public static function make(Application $app)
  {
    self::prepare($app);

    $app->services
        ->getRouterResolver()
        ->start();
  }

  /**
   * Prepare the router
   *
   * @param Application $app
   * @return void
   */
  private static function prepare($app)
  {
    SwishHandler::setNamespace($app->services->getRouterResolver()->getNamespace());

    SwishHandler::fail(function ($isAjax, $code) {
      if ($code == 404) throw new NotFoundHttpException($code);

      throw new BadRequestHttpException($code);
    });

    SwishHandler::before(function($route, $callback) use ($app) {
      $route->variables = (new Reflect($app))->handle($callback, $route->variables, $route);

      /** get all registered middleware */
      foreach (Route::$routes as $key => $value) {
        if ($value['id'] == $route->id) $route->middleware = array_merge($value['middleware'], self::getMiddleware($callback));
      }

      $request = Reflect::$request ?? $app->getRequest();
      $request->route = $route;

      Middleware::setFoundation($app->services->getHttpFoundation())
                ->run($request, $route, substr($route->file, 0, strlen($route->file) - 4));

      return $route->variables;
    });

    SwishHandler::after(function($route) use ($app) {
      $app->setResponse($route->response);
    });
  }

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
