<?php

/**
 * Class Controller
 */
class Controller {

    /**
     * @param $model
     * Create new instance of Any Model inside app/models directory.
     * @return mixed
     */
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    /**
     * @param $url
     * Create view for the application
     * @param array $data
     */
    public function view($url, $data = []) {

        require_once '../app/views/' . $url . '.php';

    }
}