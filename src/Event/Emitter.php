<?php
namespace Ramata\Event;


class Emitter{

    /**
    *singlton
    *@var $_instance
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
    public function on(string $event,callable $callable, int $priority = 0)
    {
       if(!$this->eventExist($event)){
         $this->listener[$event] = [];
       }
       $listener = $this->listener[$event][] = new Listener($callable,$priority);
       $this->sortListener($event);
       return $listener;
    }
    public function once($event,callable $callback,int $priority = 0)
    {
       return $this->on($event,$callback,$priority)->once();
    }

    public function emit(string $event,...$args)
    {
      if($this->eventExist($event)){
        foreach($this->listener[$event] as $listener){
          $listener->handler($args);
          if($listener->stopPropagation){
            break;
          }
        }
        return $listener;
      }
    }
    private function eventExist($event)
    {
      return array_key_exists($event,$this->listener);
    }
    private function sortlistener($event)
    {
      uasort($this->listener[$event],function($a,$b){
        return $a->priority < $b->priority;
      });
    }


}
