<?php

namespace Modulus\Upstart\Boot;

use Modulus\Hibernate\Capsule;
use Modulus\System\{DB, Config};
use Modulus\Upstart\BootableService;

class EloquentHandler extends BootableService
{
  /**
   * {@inheritDoc}
   */
  protected function boot()
  {
    $this->setup(config('database.default'))::start();

    return $this->hook('db', Capsule::class, BootableService::CREATE);
  }

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
