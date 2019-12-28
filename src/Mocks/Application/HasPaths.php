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
   * Get bootstrap path
   *
   * @param string|null $path Path to file or subdirectory
   * @return string 
   */
  public function getBootstrapPath(string $path = null)
  {
    return $this->getPath('bootstrap', $path);
  }

  /**
   * Get config path
   *
   * @param string|null $path Path to file or subdirectory
   * @return string 
   */
  public function getConfigPath(string $path = null)
  {
    return $this->getPath('config', $path);
  }

  /**
   * Get database path
   *
   * @param string $path
   * @return string
   */
  public function getDatabasePath(string $path = null)
  {
    return $this->getPath('database', $path);
  }

  /**
   * Get resources path
   *
   * @param string $path
   * @return string
   */
  public function getResourcesPath(string $path = null)
  {
    return $this->getPath('resources', $path);
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
