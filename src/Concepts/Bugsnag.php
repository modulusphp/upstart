<?php

namespace Modulus\Upstart\Concepts;

use Exception;
use Bugsnag\Client;
use Bugsnag\Handler;

class Bugsnag
{
  /**
   * Create bugsnag concept
   *
   * @return Client
   */
  public static function create() : Client
  {
    $client = Client::make();

    try {
      Handler::register($client);
    } catch (Exception $e) {
      //
    }

    return $client;
  }
}
