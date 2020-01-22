<?php
/*
 * This is the main controller
 * Loads the models and views
 */

class Controller{
//    Load model
    public function model($model){
//        require the model
        require_once '../app/models/'. $model .'.php';
//        create new model object
        return new $model;
    }

//    load views
    public function view($view, $data = [], $varName = 'data'){
//        naming variable dynamically
        ${$varName} = $data;
//        check if view exists
        if (file_exists('../app/views/'. $view .'.php')){
            require_once '../app/views/'. $view .'.php';
        }else{
            die($view .' view does not exit');
        }
    }
}