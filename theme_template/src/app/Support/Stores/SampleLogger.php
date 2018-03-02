<?php

/**
 * Created by PhpStorm.
 * User: PedroGaspar
 * Date: 10/04/2017
 * Time: 12:53
 */
namespace prevenir\Support\Stores;

use share\SharePress\Stores\ILogger;

class SampleLogger implements ILogger {

    private $model;
    public function __construct($model) {
        $this->model = $model;
    }

    public function add ($data) {
        call_user_func_array(array($this->model, 'create'), [[
            'log' => $data
        ]]);
    }
}