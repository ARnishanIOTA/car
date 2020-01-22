<?php
//    Load config
    require_once 'config/config.php';

//    Load helper files
    require_once 'helpers/sessionHelper.php';
    require_once 'helpers/validationHelper.php';

//    autoload core libraries
    spl_autoload_register(function ($class){
            require_once 'libraries/'. $class .'.php';
        }
    );