<?php

namespace Modulus\Upstart\Mocks\Application;

use Modulus\Http\Request;

trait HasResponse
{
  /**
   * Application response
   *
   * @var mixed
   */
  private $response;

  /**
   * Application $error
   *
   * @var mixed
   */
  private $error;

  /**
   * Application request
   *
   * @var Request
   */
  private $request;

  /**
   * Set application response
   *
   * @param mixed $response
   * @return void
   */
  public function setResponse($response)
  {
    $this->response = $response;
  }
}
