<?php

namespace Modulus\Upstart\Concepts;

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

    Handler::register($client);

    return $client;
  }
}
