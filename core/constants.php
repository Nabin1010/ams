<?php

    // Session init method call
    session_start();

    // Legal url constant
    //define('LEGAL_URL', TRUE);

    // Project folder root
    // Site url. example: localhost/ams/
    // Document root. example: C:/xampp/htdocs/ams/
    // Administration panel url. Example: localhost/ams/admin/
    define('PROJECT_NAME', 'AMS');
    define('ROOT_FOLDER', '/ams/');
    define('SITE_URL', $_SERVER['HTTP_HOST'].'/ams/');
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'].'/ams/');
    // define('ADMIN_URL', ROOT_FOLDER.'admin/');
    define('ADMIN_URL', '/ams/admin/');
    // define('LOGIN_PAGE', ROOT_FOLDER.'login.php');
    define('LOGIN_PAGE', '/ams/login.php');
     define('REGISTRATION_PAGE', '/ams/registration.php');
    //
     define('Order-Now', '/ams/admin/index.php');

    // Assets folder url. example: localhost/ams/assets/
    // CSS folder url. example: localhost/ams/assets/css/
    // Fonts folder url. example: localhost/ams/assets/fonts/
    // Image folder url. example: localhost/ams/assets/img/
    // Javascript folder url. example: localhost/ams/assets/
    define('ASSETS_URL', '/ams/assets/');
    define('CSS_URL', ASSETS_URL.'css/');
    define('FONTS_URL', ASSETS_URL.'fonts/');
    define('IMG_URL', ASSETS_URL.'img/');
    define('USER_IMG', IMG_URL.'user/');
     define('PRODUCT_IMG', IMG_URL.'product/');
    define('JS_URL', ASSETS_URL.'js/');
    

    // DB connection variables
    // DB_HOST: MySQL Host name example 'localhost'
    // DB_USER: MySQL User name example 'root'
    // DB_PASS: MySQL Password example ''
    // DB_NAME: MySQL DB name example 'ams'
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'ams_db');

    define('CORE_FUNCTIONS', DOCUMENT_ROOT.'/core/functions.php');
    define('CORE_ACTION', '/ams/core/action.php');
