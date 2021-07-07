<?php
namespace App\Services;


class MySecondService implements ServiceInterface {
    public function __construct(){
        dump('hello from second service');
}

}
