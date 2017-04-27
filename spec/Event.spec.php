<?php
use Ramata\Event\Emitter;

describe(Emitter::class,function(){
  beforeEach(function(){
      $reflexion = new ReflectionClass(Emitter::getInstance());
      $property = $reflexion->getProperty('_instance');
      $property->setAccessible(true);
      $property->setValue(null,null);
      $property->setAccessible(false);
    });
    given('emitter',function(){
      return Emitter::getInstance();
    });
    it('should be a singlton',function(){
      $instance = Emitter::getInstance();
      expect($instance)->toBeAnInstanceOf(Emitter::class);
      expect($instance)->toBe(Emitter::getInstance());
    });
    describe('on',function(){

    });
});
