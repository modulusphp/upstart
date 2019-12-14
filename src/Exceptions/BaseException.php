<?php

namespace Modulus\Upstart\Exceptions;

use Exception;

class BaseException extends Exception
{
  use Error;

  /**
   * Application Status Code
   *
   * @var int
   */
  protected $statusCode = 500;
}
