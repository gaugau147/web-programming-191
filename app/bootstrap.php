<?php 
    // Load Config
    require_once 'config/config.php';

    // Load helper
    require_once 'helpers/url_helper.php';
    require_once 'helpers/section_helper.php';

    // Help to save as pdf
    require_once 'fpdf/fpdf.php';


    // Autoload Core Libraries
    spl_autoload_register(function($className){
        require_once 'libraries/' . $className . '.php';
    });

