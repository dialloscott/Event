<?php
use Ramata\Event\Emiter;
require "vendor/autoload.php";

$emiter = Emiter::getInstance();
$comment = 'lorem';
$emiter->on('commnet.created',function($comment){
});

$emiter->emit('comment.created',$comment);
