<?php

namespace Modulus\Upstart\Whoops;

use Modulus\Upstart\Response;
use Whoops\Handler\PrettyPageHandler;

class DebugHandler extends PrettyPageHandler
{
  /**
   * {@inheritDoc}
   */
  private $exception;

  /**
   * {@inheritDoc}
   */
  public function setException($exception)
  {
    $this->exception = Response::prepare($exception);
  }

  /**
   * {@inheritDoc}
   */
  protected function getException()
  {
    return $this->exception;
  }
}
