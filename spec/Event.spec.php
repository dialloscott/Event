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
      it('should trigger in right order',function(){
        $listener = Double::instance();
        expect($listener)->toReceive('onNewComment')->once()->ordered;
        expect($listener)->toReceive('onNewComment2')->once()->ordered;

        $this->emitter->on('comment.created',[$listener,'onNewComment2'],1);
        $this->emitter->on('comment.created',[$listener,'onNewComment'],2000);
        $this->emitter->emit('comment.created');

      });
    });
  describe('::once',function(){
     it('should trigger event once', function(){
         $listener = Double::instance();
         expect($listener)->toReceive('onNewComment')->once();

         $this->emitter->once('comment.created',[$listener,'onNewComment']);
         $this->emitter->emit('comment.created');
     });
  });
  describe('::stopPropagation',function(){
    it('it should stop the next listener',function(){
      $listener = Double::instance();
      expect($listener)->toReceive('onNewComment')->once();
      expect($listener)->not->toReceive('onNewComment2')->once();
      $this->emitter->once('comment.created',[$listener,'onNewComment'])->stopPropagation();
      $this->emitter->once('comment.created',[$listener,'onNewComment2']);
      $this->emitter->emit('comment.created');

    });
  });

});
