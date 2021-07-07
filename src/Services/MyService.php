<?php

namespace App\Services;
use App\Services\MySecondService;

class MyService {

    public function __construct($service)
    {
        dump($service);
        $this->secService = $service;
    }




//    public $logger;
//    public $my;

//    public function someAction(){
//        dump($this->logger);
//        dump($this->my);
//    }

//    public function someAction(){
//        dump($this->service->doSomething2());
//    }







    /**
     * @required
     *
     */
//    public function setSecondService(MySecondService $second_service){
//        dump($second_service);
//    }

}
