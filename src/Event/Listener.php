<?php

namespace Ramata\Event;

class Listener {

  public $callback;

  public function __construct(callable $callback,int $priority)
  {
    $this->callback = $callback;
    $this->priority = $priority;
  }
  public function handler(array $args)
  {
    return call_user_func_array($this->callback,$args);
  }
}
