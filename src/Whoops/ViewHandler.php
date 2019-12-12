<?php

namespace Modulus\Upstart\Whoops;

use Whoops\Handler\Handler;
use Whoops\Handler\PlainTextHandler;

class ViewHandler extends PlainTextHandler
{
  /**
   * @var bool
   */
  private $addPreviousToOutput = true;

  /**
   * {@inheritDoc}
   */
  public function generateResponse()
  {
    $exception = $this->getException();
    $message = $this->getExceptionOutput($exception);

    if ($this->addPreviousToOutput) {
      $previous = $exception->getPrevious();
      while ($previous) {
        $message .= PHP_EOL . PHP_EOL . "Caused by" . PHP_EOL . $this->getExceptionOutput($previous);
        $previous = $previous->getPrevious();
      }
    }

    return $message . $this->getTraceOutput() . PHP_EOL;
  }

  /**
   * {@inheritDoc}
   */
  private function getTraceOutput()
  {
    return '';
    if (! $this->addTraceToOutput()) {
      return '';
    }

    $inspector = $this->getInspector();
    $frames = $inspector->getFrames();

    $response = PHP_EOL . "Stack trace:" . PHP_EOL;

    $line = 1;
    foreach ($frames as $frame) {
      /** @var Frame $frame */
      $class = $frame->getClass();

      $template = "\n%3d. %s->%s() %s:%d%s";
      if (! $class) {
        // Remove method arrow (->) from output.
        $template = "\n%3d. %s%s() %s:%d%s";
      }

      $response .= sprintf(
        $template,
        $line,
        $class,
        $frame->getFunction(),
        $frame->getFile(),
        $frame->getLine(),
        $this->getFrameArgsOutput($frame, $line)
      );

      $line++;
    }

    return $response;
  }

  /**
   * Get the exception as plain text.
   * @param \Throwable $exception
   * @return string
   */
  private function getExceptionOutput($exception)
  {
    return sprintf(
      "%s: %s in file %s on line %d",
      get_class($exception),
      $exception->getMessage(),
      $exception->getFile(),
      $exception->getLine()
    );
  }
  
  /**
   * {@inheritDoc}
   */
  private function canOutput()
  {
    return !$this->loggerOnly();
  }

  /**
   * {@inheritDoc}
   */
  public function handle()
  {
    $response = $this->generateResponse();

    if ($this->getLogger()) {
      $this->getLogger()->error($response);
    }

    if (!$this->canOutput()) {
      return Handler::DONE;
    }

    // echo $response;

    return Handler::QUIT;
  }

  /**
   * {@inheritDoc}
   */
  public function contentType()
  {
    return 'text/html';
  }
}