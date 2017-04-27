# Creation Des evenement en php
- La premier class emiter {class Emiter}
```<?php
namespace Ramata\Event;
class Emiter{

    /**
    *singlton
    *@var $_intance
    */
    private static $_instance;
    /**
    *@var Listener [][]
    */
    private $listener = [];

    public static function getInstance()
    {
      if(!self::$_instance){
        self::$_instance = new self();
      }
      return self::$_instance;
    }
    public function on(string $event,callable $callable)
    {
       if(!$this->eventExist($event)){
          $this->listener[$event][] = new Listener($callable);
       }
    }
    public function emit(string $event,...$args)
    {
      if($this->eventExist($event)){
        foreach($this->listener[$event] as $event){
          return $event->handler($args);
        }
        return $event;
      }
    }
    private function eventExist($event)
    {
      return array_key_exists($event,$this->listener);
    }

}
```
