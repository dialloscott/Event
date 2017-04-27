<?php
namespace Ramata\Event;
use Ramata\Event\Interfaces\SubscriberInterface;

class Subscriber implements SubscriberInterface {


  public function subscribe()
  {
    return ['comment.created' => 'newComment'];
  }
}
