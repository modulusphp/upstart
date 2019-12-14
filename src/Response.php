<?php

namespace Modulus\Upstart;

use Exception;
use Modulus\Http\Rest;
use Modulus\Utility\View;
use Modulus\Http\Redirect;
use Modulus\Utility\Groupable;

class Response
{
  /**
   * Handle application errors
   *
   * @param Exception $exception
   * @return mixed
   */
  public static function handle($exception)
  {
    return app('services')->getHandler()->render(app()->getRequest(), $exception);
  }

  /**
   * Prepare exception
   *
   * @param \Throwable $exception
   * @return \Throwable
   */
  public static function prepare($exception)
  {
    return app('services')->getHandler()->prepare($exception);
  }

  /**
   * Get application response
   *
   * @param mixed $response
   * @return mixed
   */
  public static function build($response, $console = false)
  {
    /** Convert to collection */
    if ($response instanceof Groupable) {
      $response = $response->all();
    }

    /** Convert to array */
    if (method_exists($response, 'toArray')) {
      $response = $response->toArray();
    }

    if ($console) return $response;

    /** Create a rest response */
    if (
      is_string($response) ||
      is_int($response) ||
      is_float($response) ||
      is_double($response) ||
      is_array($response)
    ) return is_array($response) ? Rest::response()->json($response)->send() : Rest::response($response)->send();

    if (is_bool($response)) return Rest::response($response ? 'true' : 'false')->send();

    if ($response instanceof Rest) return $response->send();

    /** Create a redirect */
    if ($response instanceof Redirect) return $response->send();

    /** Create a view page */
    if (Response::isView($response)) return;

    /** Avoid "Segmentation fault (core dumped)" */
    echo ' ';

    /** Return nothing */
    return null;
  }

  /**
   * Render a view
   *
   * @param mixed $response
   * @return bool
   */
  public static function isView($response) : bool
  {
    if ($response instanceof View) {
      $response->render();

      return true;
    }

    return false;
  }
}
