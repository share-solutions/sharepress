<?php

/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/04/2017
 * Time: 12:53
 */
namespace share\SharePress\Stores;

//use share\SharePress\Traits\GlobalizedTrait;

class Logger implements ILogger {
    //use GlobalizedTrait;

    private $model;
    public function __construct($model) {
        $this->model = $model;
    }

    // develop repo like get methods
    public function add ($data) {
        call_user_func_array(array($this->model, 'create'), [[
            'log' => $data
        ]]);
    }
}