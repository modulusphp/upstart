<?php

namespace Modulus\Upstart\Boot;

use Modulus\Hibernate\Capsule;
use Modulus\System\{DB, Config};
use Modulus\Upstart\BootableService;

class EloquentHandler extends BootableService
{
  /**
   * Setup Eloquent
   *
   * @return DB
   */
  private function setup(string $default)
  {
    Config::$database = config("database.connections.{$default}");

    return DB::class;
  }
}
