<?php

namespace Modulus\Upstart\Routing;

use Modulus\Utility\Groupable;
use Illuminate\Database\Eloquent\Model;

trait RouteBinding
{
  /**
   * Run route model binding for models
   *
   * @param Model $model
   * @param mixed $where
   * @param mixed $value
   * @param mixed $querymap
   * @return void
   */
  private function modelVision(Model $model, $where, $value, $name, $querymap = null) : Model
  {
    if (isset($this->bindings['model'][$this->getQueryMap($where)])) {
      return (new $this->bindings['model'][$this->getQueryMap($where)])->persist($model, $this->getField($where), $value, $name);
    }

    return $model->where($where, $value)->first() ?? $model;
  }

  /**
   * Run route model binding for groupables
   *
   * @param Groupable $group
   * @param mixed $where
   * @param mixed $value
   * @param mixed $querymap
   * @return void
   */
  private function groupableVision(Groupable $group, $where, $value, $name, $querymap = null) : Groupable
  {
    if (isset($this->bindings['groupable'][$this->getQueryMap($where)])) {
      return (new $this->bindings['groupable'][$this->getQueryMap($where)])->persist($group, $this->getField($where), $value, $name);
    }

    return $group;
  }

  /**
   * Get query map
   *
   * @param string $where
   * @return string
   */
  private function getQueryMap($where)
  {
    return strpos($where, '__') !== false ? explode('__', $where)[1] : $where;
  }

  /**
   * Get field
   *
   * @param string $where
   * @return string
   */
  private function getField($where)
  {
    return strpos($where, '__') !== false ? explode('__', $where)[0] : $where;
  }
}
