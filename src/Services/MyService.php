<?php

namespace App\Services;
use App\Services\MySecondService;
use Doctrine\ORM\Event\PostFlushEventArgs;

class MyService implements ServiceInterface {

    public function __construct()
    {
        dump('hello from MyService!');
    }



}
