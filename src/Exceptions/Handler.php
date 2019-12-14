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
   * Prepare the exception
   *
   * @param \Exception $exception
   * @return \Exception $exception
   */
  public function prepare($exception)
  {
    if ($exception instanceof ModelNotFoundException) {
      return (new BuildException($exception, ends_with($exception->getMessage(), '].') ? 0 : 3))->make();
    }

    return $exception;
  }

  /**
   * Get exception view
   *
   * @param mixed $exception
   * @return string
   */
  private function getView($exception)
  {
    if (method_exists($exception, 'getView')) {
      $view = $exception->getView();

      if (is_string($view)) return $view;
    }

    return 'app.errors.default';
  }

  /**
   * Get error message
   *
   * @param mixed $exception
   * @return string
   */
  private function getMessage($exception)
  {
    $message = $exception instanceof BaseException ? $exception->getMessage() : self::ERROR_500_MESSAGE;

    if (in_array($message, ['', null])) return self::ERROR_500_MESSAGE;
    
    return $message;
  }

  /**
   * Get exception status code
   *
   * @param mixed $exception
   * @return int
   */
  private function getStatusCode($exception)
  {
    if (method_exists($exception, 'getStatusCode')) {
      $code = $exception->getStatusCode();

      if (in_array($code, array_keys(Status::CODE))) return $code;
    }

    return 500;
  }

  /**
   * Get exception status code
   *
   * @param mixed $exception
   * @return string
   */
  private function getTitle($exception)
  {
    if (method_exists($exception, 'getTitle')) {
      $title = $exception->getTitle();

      if (!in_array($title, ['', null])) return $title;
    }

    return self::ERROR_500_TITLE;
  }

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
