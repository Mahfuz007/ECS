<?php

    // App Core Class 
    // Creates URL and Loads core controllers
    // URL Format - /controller/method/params

    class Core{
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            $url = $this->getUrl();
            if(isset($_GET['url'])){
                //Look in Controller 'Pages loaded';rs for first value
                if(file_exists('../app/controllers/'. ucwords($url[0]) .'.php')){
                    //if exists, set as controller
                    $this->currentController = ucwords($url[0]);
                    //unset 0 index
                    unset($url[0]);
                }
            }

            //Require the controller
            require_once '../app/controllers/'.$this->currentController . '.php';

            //Instantiate controller class
            $this->currentController = new $this->currentController; 

            //Check 2nd part of the url
            if(isset($url[1])){
                //check if method exists in controller
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    
                    //unset index 1
                    unset($url[1]);
                }
            }

            //get params
            $this->params = $url?array_values($url):[];
            
            //call a callback with array of params
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
            

        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
        }
    }