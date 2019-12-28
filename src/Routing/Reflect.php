<?php

namespace Modulus\Upstart\Routing;

use ReflectionMethod;
use ReflectionFunction;

use Modulus\Http\Request\Base;
use Modulus\Utility\Groupable;

use Illuminate\Database\Eloquent\Model as EloquentModel;


class Reflect
{
  use RouteBinding;

  /**
   * $request
   *
   * @var \Modulus\Http\Request\Base
   */
  public static $request;

  /**
   * Model bindings
   *
   * @var array
   */
  private $bindings;

  /**
   * Build the reflection api
   *
   * @param mixed $app
   * @return void
   */
  public function __construct($app)
  {
    $this->bindings = $app->services->getHttpFoundation()->getRouteModelBinding();
  }

  /**
   * Build reflection
   *
   * @param mixed $callback
   * @param mixed $variables
   * @return void
   */
  public function handle($callback, $variables = [], $route) : array
  {
    $reflection = is_array($callback) ? new ReflectionMethod($callback[0], $callback[1]) : new ReflectionFunction($callback);

    $params     = $reflection->getParameters();
    $variables  = $this->hasRequest($params, $variables);

    return $this->celebrate($params, $variables, $route);
  }

  /**
   * Celebrate method
   *
   * @param mixed $params
   * @param mixed $variables
   * @param mixed $i
   * @param mixed $args
   * @return array
   */
  private function celebrate($params, $variables, $route, $i = 0, $args = []) : array
  {
    foreach($params as $key => $param) {
      $class = '\\' . $param->getType();

      if ($variables != []) {
        $where = array_keys($variables)[$i];
        $value = array_values($variables)[$i];
      }

      if (class_exists($class)) {
        $instance = new $class();
        if ($instance instanceof Base) {
          $request = new $class();

          $args[$where] = $request;

          Reflect::$request = $request;
        }
        else if ($instance instanceof EloquentModel) {
          if (isset($where) && is_integer($where) == false) {
            $model = $this->modelVision(new $class, $where, $value, $param->name);
          } else {
            $model = null;
          }

          if (!isset($where) && $param->allowsNull()) {
            $args[isset($where) ? $where : $key] = null;
          } else {
            $args[isset($where) ? $where : $key] = $model == null ? new $class : $model;
          }
        }
        else if ($instance instanceof Groupable) {
          if (isset($where) && is_integer($where) == false) {
            $model = $this->groupableVision(new $class, $where, $value, $param->name);
          } else {
            $model = null;
          }

          if (!isset($where) && $param->allowsNull()) {
            $args[isset($where) ? $where : $key] = null;
          } else {
            $args[isset($where) ? $where : $key] = $model == null ? new $class : $model;
          }
        }
        else {
          if (!isset($where) && $param->allowsNull()) {
            $args[isset($where) ? $where : $key] = null;
          } else {
            $args[isset($where) ? $where : $key] = new $class(isset($value) ? $value : null);
          }
        }
      }else {
        if (!isset($where) && $param->allowsNull()) {
          $args[isset($where) ? $where : $key] = null;
        } else if (isset($where)) {
          $args[$where] = $value;
        }
      }

      $i++;
    }

    return $args;
  }

  /**
   * Check if the request class exists and insert it if it doesn't
   *
   * @param mixed $params
   * @param mixed $variables
   * @param mixed $i
   * @return array
   */
  private function hasRequest($params, $variables, $i = null) : array
  {
    foreach($params as $key => $param) {
      $class = '\\' . $param->getType();
      if (class_exists($class) && new $class() instanceof Base) {
        $i = $key;
      }
    }

    if ($i !== null) $variables = $this->insert($variables, $i, 'Request');
    return $variables;
  }

  /**
   * Insert item
   *
   * @param mixed $array
   * @param mixed $index
   * @param mixed $val
   * @return array
   */
  private function insert($array, $index, $val) : array
  {
    $size = count($array);
    if (!is_int($index) || $index < 0 || $index > $size) {
      return -1;
    }
    else {
      $temp   = array_slice($array, 0, $index);
      $temp[] = $val;
      return array_merge($temp, array_slice($array, $index, $size));
    }
  }
}
