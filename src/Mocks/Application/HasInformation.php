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
}
