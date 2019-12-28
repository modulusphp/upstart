<?php

namespace Modulus\Upstart\Plugin;

use GO\Scheduler;

trait HasScheduler
{
  /**
   * Start plugin scheduler
   *
   * @param Scheduler $schedule
   * @return void
   */
  protected function schedule(Scheduler $schedule) : void
  {
    //
  }

  /**
   * Start scheduler
   *
   * @param Scheduler $schedule
   * @return void
   */
  public function runScheduler(Scheduler $schedule)
  {
    $this->schedule($schedule);
  }
}
