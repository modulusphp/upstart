<?php

namespace Modulus\Upstart\Boot;

use Modulus\Hibernate\Config\Cache;
use Modulus\Upstart\BootableService;
use Modulus\Hibernate\Config\BaseConfig;

class ApplicationConfigHandler extends BootableService
{
  use Cache;

  /**
   * Set application config path
   *
   * @param string $root
   * @return void
   */
  public function __construct(string $root, bool $autoCache = false)
  {
    $this->config    = $root . 'config';
    $this->bootstrap = $root . 'bootstrap';
    $this->autoCache = $autoCache;
  }

  /**
   * {@inheritDoc}
   */
  protected function boot()
  {
    $config = $this->get();

    BaseConfig::boot($config);

    if (!$this->cacheExists()) {
      $this->save($config);
    }

    return $this->hook('config', $config);
  }
}
