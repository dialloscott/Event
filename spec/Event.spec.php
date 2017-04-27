<?php
use Ramata\Event\Emitter;
use Kahlan\Plugin\Double;

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
    describe('::on',function(){
      it('it should trigger event',function(){
        $listener = Double::instance();
        $comment = ['name' => 'Lamine'];
        expect($listener)->toReceive('newComment')->times(3)->with($comment);
        $this->emitter->on('comment.created',[$listener,'newComment']);
        $this->emitter->emit('comment.created',$comment);
        $this->emitter->emit('comment.created',$comment);
        $this->emitter->emit('comment.created',$comment);

      });
    });

});
