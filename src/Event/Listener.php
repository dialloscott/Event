<?php

namespace Ramata\event;

class Listener {

  public $callback;

  public function __construct(callable $callback)
  {
    $this->callback = $callback;
  }
}
