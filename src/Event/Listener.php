<?php

namespace Ramata\Event;

class Listener {

  public $callback;
  public $priority;
  private $once = false;
  private $calls;
  public $stopPropagation = false;

  public function __construct(callable $callback,int $priority)
  {
    $this->callback = $callback;
    $this->priority = $priority;
  }
  public function handler(array $args)
  {
    if($this->once && $this->calls > 0){
      return null;
    }
    $this->calls ++;
    return call_user_func_array($this->callback,$args);
  }
  public function once()
  {
    $this->once = true;
    return $this;
  }
  public function stopPropagation()
  {
    $this->stopPropagation = true;
    return $this;
  }
}
