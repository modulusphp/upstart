<?php

namespace Modulus\Upstart\Exceptions;

use Exception;
use ReflectionObject;

class BuildException
{
  /**
   * @var Exception $exception
   */
  protected $exception;

  /**
   * @var ReflectionObject $reflected
   */
  protected $reflected;

  /**
   * @var array $trace
   */
  protected $trace;

  /**
   * Instantiate class
   *
   * @param Exception $exception
   * @param int|null $search
   * @return void
   */
  public function __construct($exception, ?int $search = 0)
  {
    $this->exception = $exception;
    $this->reflected = $this->getObject($exception);
    $this->trace     = $exception->getTrace()[$search];
  }
}
