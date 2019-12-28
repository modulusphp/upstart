<?php

namespace Modulus\Upstart\Mocks\Application;

trait HasPaths
{
  /**
   * Return root
   *
   * @param string|null $path
   * @return string
   */
  public function root(string $path = null)
  {
    return $this->root . ($path ? ltrim($path, '/') : '');
  }

  /**
   * Return root
   *
   * @param string|null $path
   * @return string
   */
  public function getRoot(string $path = null)
  {
    return $this->root . ($path ? ltrim($path, '/') : '');
  }
}
