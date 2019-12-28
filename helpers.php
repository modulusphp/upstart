<?php

use Modulus\Upstart\Application;

if (!function_exists('app')) {
  /**
   * Application
   *
   * @param string|null $service Service name
   * @return Application|mixed|null
   */
  function app(string $service = null) {
    $app = Application::get();

    if ($app && $service) return $app->{$service};

    return $app;
  }
}

if (!function_exists('bootstrap_path')) {
  /**
   * Get bootstrap path
   *
   * @param string|null $path Path to file or subdirectory
   * @return string 
   */
  function bootstrap_path($path = null) {
    return Application::get()->getBootstrapPath($path);
  }
}

if (!function_exists('config_path')) {
  /**
   * Get bootstrap path
   *
   * @param string|null $path Path to file or subdirectory
   * @return string 
   */
  function config_path($path = null) {
    return Application::get()->getConfigPath($path);
  }
}

if (!function_exists('database_path')) {
  /**
   * Get database path
   *
   * @param string|null $path Path to file or subdirectory
   * @return string 
   */
  function database_path($path = null) {
    return Application::get()->getDatabasePath($path);
  }
}

if (!function_exists('resources_path')) {
  /**
   * Get resources path
   *
   * @param string|null $path Path to file or subdirectory
   * @return string 
   */
  function database_path($path = null) {
    return Application::get()->getResourcesPath($path);
  }
}

if (!function_exists('storage_path')) {
  /**
   * Get storage path
   *
   * @param string|null $path Path to file or subdirectory
   * @return string 
   */
  function database_path($path = null) {
    return Application::get()->getStoragePath($path);
  }
}

if (!function_exists('public_path')) {
  /**
   * Get public path
   *
   * @param string|null $path Path to file or subdirectory
   * @return string 
   */
  function database_path($path = null) {
    return Application::get()->getPublicPath($path);
  }
}
