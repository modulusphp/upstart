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

  /**
   * Make exception
   *
   * @return Exception
   */
  public final function make()
  {
    foreach ($this->trace as $property => $value) {
      if ($this->reflected->hasProperty($property)) {
        $prop = $this->reflected->getProperty($property);
        $prop->setAccessible(true);
        $prop->setValue($this->exception, $value);
      }
    }

    return $this->exception;
  }

  /**
   * Get reflected exception
   *
   * @param Exception $exception
   * @return ReflectionObject
   */
  private function getObject($exception)
  {
    return new ReflectionObject($exception);
  }
}
