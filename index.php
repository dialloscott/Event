<?php
use Ramata\Event\Emiter;
require "vendor/autoload.php";

$emiter = Emiter::getInstance();
$comment = 'lorem';
$emiter->on('comment.created',function($comment){
  echo $comment;
});

$emiter->emit('comment.created',$comment);
