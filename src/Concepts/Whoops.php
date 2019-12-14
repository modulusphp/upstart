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
   * Create whoops concept
   *
   * @param null|array $config
   * @return Run
   */
  public static function create(array $config = null)
  {
    $run     = new Run;
    $handler = self::getWhoopsHandler($config ?? []);

    /** push handler */
    $run->pushHandler($handler);

    /** add special handler for ajax requests */
    if (Misc::isAjaxRequest()) {
      $run->pushHandler(new JsonResponseHandler);
    }

    /** handle exceptions */
    if ($handler instanceof ViewHandler && !config('app.debug')) {
      $run->pushHandler(function ($exception) { Response::handle($exception); });
    }

    /** set application error */
    $run->register();
    $run->handleShutdown();

    return $run;
  }

  /**
   * Get whoops handler
   *
   * @param array $config
   * @return Handler
   */
  private static function getWhoopsHandler(array $config = [])
  {
    return config('app.debug')) ? self::getDebugHandler($config) : self::getProductionHandler();
  }

  /**
   * Get production handler
   *
   * @return ViewHandler
   */
  private static function getProductionHandler()
  {
    return new ViewHandler((new \Modulus\Hibernate\Logging\MonologBase)->log());
  }

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
