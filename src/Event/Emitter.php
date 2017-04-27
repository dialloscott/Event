<?php
namespace Ramata\Event;


class Emitter{

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
         $this->Listener[$event] =  [];
       }
       $this->listener[$event][] = new Listener($callable);
    }
    public function emit(string $event,...$args)
    {
      if($this->eventExist($event)){
        foreach($this->listener[$event] as $listener){
          return $listener->handler($args);
        }
        return $listener;
      }
    }
    private function eventExist($event)
    {
      return array_key_exists($event,$this->listener);
    }

}
