<?php

namespace Modulus\Upstart\Exceptions;

class ApplicationHasStartedException extends BaseException
{
  /**
   * Throw exception
   *
   * @return void
   */
  public function __construct()
  {
    parent::boot();

    $this->message = 'Application is already running';
  }
}