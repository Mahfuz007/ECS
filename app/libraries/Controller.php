<?php

    class Controller{
        //Load Model
        public function model($model){
            //require model file
            require_once '../app/models/' . $model .'.php';

            //instantiate model
            return new $model();
        }

        //Load View
        public function view($view,$data=[]){
            //check whether view exists of not
            if(file_exists('../app/views/' . $view . '.php')){
                //require view file
                require_once '../app/views/' .$view . '.php';
            }else{
                die('View does not exist');
            }
        }

        //Load errors
        public function errors(){
            require_once '../app/views/inc/404.php';
        }
    }