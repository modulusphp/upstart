<?php

namespace Modulus\Upstart\Mocks\Application;

use Modulus\Upstart\Application;
use Modulus\Upstart\Exceptions\ApplicationHasStartedException;

trait HasBase
{
  /**
   * Root directory
   *
   * @var string $root
   */
  private $root;

  /**
   * Application has started
   *
   * @var bool $started
   */
  private $started = false;

  /**
   * Application key
   *
   * @var string $key
   */
  private static $key;

  /**
   * Create application
   *
   * @param string $root
   * @return void
   */
  public function __construct(string $root)
  {
    $this->root = rtrim($root, '/') . '/';

    define('APP_ROOT', $this->root);
  }

  /**
   * Set application $key
   *
   * @param string $key
   * @return bool
   */
  public function setKey($key) : bool
  {
    return Application::$key ? false : Application::$key = $key;
  }

  /**
   * Get application key
   *
   * @return string
   */
  public function key(bool $raw = true)
  {
    return $raw ? $this->decodedKey() : Application::$key;
  }

  /**
   * Get application key
   *
   * @return string
   */
  public function getKey(bool $raw = true)
  {
    return $this->key($raw);
  }

  /**
   * Get decoded application key
   *
   * @return string|null
   */
  private function decodedKey()
  {
    if (is_string(Application::$key) && str_contains(Application::$key, [':'])) {
      $hash   = explode(':', Application::$key)[0];
      $secret = explode(':', Application::$key)[1];

      return $hash == 'base64' ? base64_decode($secret) : $secret;
    }

    return Application::$key;
  }

  /**
   * Start and run application
   *
   * @throws ApplicationHasStartedException
   * @return mixed
   */
  public function run()
  {
    if ($this->started) throw new ApplicationHasStartedException;

    $this->withServices();

    $this->started = true;
  }
}
