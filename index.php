<?php
use Ramata\Event\Emitter;
require "vendor/autoload.php";

$emiter = Emitter::getInstance();
$comment = 'lorem';
$emiter->on('comment.created',function($comment){
  echo $comment;
});

$emiter->emit('comment.created',$comment);
