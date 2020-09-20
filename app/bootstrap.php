<?php
    require_once 'config/config.php';

    require_once 'utils/helper.php';

    //Auto load core libraries
    spl_autoload_register(function($className){
        require_once 'libraries/'. $className .'.php';
    });