<?php

namespace Modulus\Upstart\Concepts;

use Exception;
use Whoops\Run;
use Whoops\Util\Misc;
use Whoops\Handler\Handler;
use Modulus\Upstart\Response;
use Whoops\Handler\JsonResponseHandler;

use Modulus\Upstart\Whoops\{
  ViewHandler,
  DebugHandler
};

class Whoops
{
  /**
   * Get development handler
   *
   * @param array $config
   * @return PrettyPageHandler $handler
   */
  private static function getDebugHandler(array $config = [])
  {
    $title  = isset($config['title']) ? $config['title'] : 'Oops, something is not working';

    $handler = new DebugHandler;

    /** Set the title of the error page: */
    $handler->setPageTitle($title);

    return $handler;
  }
}
