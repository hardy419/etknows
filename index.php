<?php

ob_start();

error_reporting(E_ALL);

require './config.php';
require './Hardy/functions.php';

$Hardy_database_handler = $Hardy_config['database'].'_handler';
require './Hardy/database/'.$Hardy_database_handler.'.php';

require './Hardy/base_controller.php';

// Routing
if(isset($_GET['r']) && 0 === preg_match ('/[^a-zA-Z0-9\/]/', $_GET['r'])) {
    $r = explode ('/', $_GET['r']);
    if (1 == count($r)) {
        $c = $r[0];
        $a = 'index';
    }
    else if (2 == count($r)) {
        $c = $r[0];
        $a = $r[1];
    }
    else {
        $c = 'index';
        $a = 'index';
    }
}
else {
    $c = 'index';
    $a = 'index';
}

// Execution & Rendering
$controller = Hardy_get_class($c, 'controller');
$controller->$a();

ob_end_flush();

?>