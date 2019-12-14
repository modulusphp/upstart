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

  /**
   * Default error 500 title
   *
   * @var string
   */
  protected const ERROR_500_TITLE = 'Oops, something is not working';

  /**
   * Expects rest
   *
   * @param Request $request
   * @return bool
   */
  private function shouldRest($request) : bool
  {
    if (
      ($request->headers->has('Accept') && str_contains(strtolower($request->headers->accept), ['json', 'javascript'])) ||
      (
        (
          $request->headers->has('Content-Type') &&
          !str_contains(strtolower($request->headers->contenttype), ['json', 'javascript'])
        ) &&
        !isset($request->headers->all()['Accept'])
      ) ||
      $request->isAjax()
    ) {
      return true;
    }

    return false;
  }
}
