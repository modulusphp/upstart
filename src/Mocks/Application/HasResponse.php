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
}
