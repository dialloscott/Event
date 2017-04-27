<?php
namespace Ramata\Event;
use Ramata\Event\Exceptions\DoubleEventException;

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
       $this->checkIfDoubleCallable($event,$callable);
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
    public function addSubscriber($subscriber)
    {
      foreach ($subscriber->subscribe() as $event => $method) {
        $this->on($event,[$subscriber,$method]);
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
    private function checkIfDoubleCallable($event,$callable)
    {
       foreach($this->listener[$event] as $listener){
          if($listener->callback == $callable){
            throw new DoubleEventException();
          }
       }
    }


}
