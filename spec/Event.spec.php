<?php
use Ramata\Event\Emiter;
describe('singlton',function(){
    it('should be the seme instance',function(){
      $instance = Emiter::getInstance();
      expect($instance)->toBeAnInstanceOf(Emiter::class);
    });
});
