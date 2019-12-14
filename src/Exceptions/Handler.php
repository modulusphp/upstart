<?php

namespace Modulus\Upstart\Exceptions;

use Exception;
use Modulus\Http\Status;
use Modulus\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler
{
  /**
   * Default error 500 message
   *
   * @var string
   */
  protected const ERROR_500_MESSAGE = 'Something went wrong';
}
