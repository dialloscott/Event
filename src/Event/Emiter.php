<?php
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
      var_dump($args);
    }
    private function eventExist($event)
    {
      return array_key_exists($event,$this->listener);
    }

}
