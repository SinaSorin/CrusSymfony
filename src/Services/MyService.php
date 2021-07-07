<?php

namespace App\Services;
use App\Services\MySecondService;
use Doctrine\ORM\Event\PostFlushEventArgs;

class MyService {

    public function __construct()
    {
        dump('Hello');
    }
    public function postFlush(PostFlushEventArgs $args){
        dump('Hello');
        dump($args);
    }
    public function clear(){
       dump('clear...');
    }


}
