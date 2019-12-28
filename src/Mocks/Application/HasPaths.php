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

  /**
   * Common path
   *
   * @param string $name
   * @param string $path
   * @return string
   */
  private function getPath(string $name, string $path = null)
  {
    return $this->getRoot($name) . '/' . ($path ? ltrim($path, '/') : '');
  }
}
