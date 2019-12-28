<?php

namespace Modulus\Upstart\Mocks\Application;

trait HasInformation
{
  /**
   * Composer file
   *
   * @param string $ds Directory Seperator
   * @return string
   */
  private function __composer(string $ds = DIRECTORY_SEPARATOR)
  {
    $upstart = __DIR__ . $ds . '..' . $ds . '..' . $ds . '..' . $ds . 'composer.json';

    return file_exists('composer.json') ? 'composer.json' : $upstart;
  }

  /**
   * Get composer file
   *
   * @return object
   */
  private function info() : object
  {
    return json_decode(file_get_contents($this->__composer()));
  }

  /**
   * Get application name
   *
   * @return string
   */
  public function name()
  {
    return explode('/', $this->info()->name)[1];
  }

  /**
   * Get application description
   *
   * @return string
   */
  public function description()
  {
    return $this->info()->description ?? null;
  }

  /**
   * Get application version
   *
   * @return string
   */
  public function version()
  {
    return $this->info()->version ?? null;
  }
}
