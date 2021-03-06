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
   * Get application response
   *
   * @return mixed
   */
  public function getResponse()
  {
    return $this->response;
  }

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

  /**
   * Get application error
   *
   * @return mixed
   */
  public function getError()
  {
    return $this->error;
  }

  /**
   * Set application error
   *
   * @param mixed $error
   * @return void
   */
  public function setError($error)
  {
    $this->error = $error;
  }

  /**
   * Check if error is set
   *
   * @return bool
   */
  public function hasError()
  {
    return $this->error ? true : false;
  }

  /**
   * Get application request
   *
   * @return Request
   */
  public function getRequest()
  {
    return $this->request ?? $this->request = new Request(array_merge($_POST, $_FILES));
  }
}
