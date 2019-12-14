<?php

namespace Modulus\Upstart\Exceptions;

trait Error
{
  /**
   * Boot exception
   *
   * @return void
   */
  public function boot()
  {
    $args = debug_backtrace();

    foreach (end($args) as $key => $value) {
      $this->{$key} = $value;
    }
  }

  /**
   * Get status code
   *
   * @return int
   */
  public final function getStatusCode()
  {
    return $this->statusCode;
  }

  /**
   * Get view
   *
   * @return string
   */
  public final function getView()
  {
    return $this->view;
  }

  /**
   * Get page title
   *
   * @return string
   */
  public final function getTitle()
  {
    return $this->title;
  }

  /**
   * Set view path
   *
   * @param string $view
   * @return self $this
   */
  public function setView(string $view)
  {
    $this->view = $view;

    return $this;
  }
}
