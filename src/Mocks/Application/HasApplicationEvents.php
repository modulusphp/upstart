<?php

namespace Modulus\Upstart\Mocks\Application;

use Bugsnag\Client;
use Modulus\Upstart\Concepts\Bugsnag;

trait HasApplicationEvents
{
  /**
   * Bugsnag service
   *
   * @var Client
   */
  public $bugsnag;

  /**
   * Runs before the application starts
   *
   * @return void
   */
  private function before()
  {
    $this->bugsnag = Bugsnag::create();
  }
}
