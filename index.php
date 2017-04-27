<?php
use Ramata\Event\Emitter;
require "vendor/autoload.php";

$emiter = Emitter::getInstance();
$comment = 'lorem';
$emiter->on('comment.created',function($comment){
  echo $comment;
},1);
$emiter->on('comment.created',function($comment){
  echo PHP_EOL.$comment.'lamiddd';
},5000);

$emiter->emit('comment.created',$comment);
