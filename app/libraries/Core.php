<?php
    /*
     * Main core class
     * Creates URL and loads core controller
     * */


    class Core{
        protected $currentController = 'PagesController';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
//            print_r($this->getUrl());
            $url = $this->getUrl();

//            checks for the controller from url[0]
            if (file_exists('../app/controllers/'. ucwords($url[0]) .'Controller.php')){
//                if controller exists set current controller
                $this->currentController = ucwords($url[0]).'Controller';
                unset($url[0]);
            }

//            require current controller
            require_once '../app/controllers/'. $this->currentController . '.php';

            //Instatiate the controller
            $this->currentController = new $this->currentController;

//            check for methods from url[1]
            if (isset($url[1])){
                //check to see if method exists in controller
                if (method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //get params
            $this->params = $url ? array_values($url) : [];

            //call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            if (isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }