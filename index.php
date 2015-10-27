<?php

ob_start();

error_reporting(E_ALL);

require './config.php';
require './Hardy/functions.php';

require './Hardy/base_controller.php';

$Hardy_database_handler = $Hardy_config['database'].'_handler';
require './Hardy/database/'.$Hardy_database_handler.'.php';

// Check session
if (isset ($_COOKIE[$Hardy_config['project_name']])) {
    $model = Hardy_get_class('user', 'model');
    $model->connect();
    $user_info = $model->get_user ($_COOKIE[$Hardy_config['project_name']]);
    if (null == $user_info || $_COOKIE[$Hardy_config['project_name'].'_session'] != $user_info['sid']) {
        // Session ID mismatch
        $controller = Hardy_get_class('index', 'controller');
        $controller->message ('警告: 会话ID不匹配, 有可能账号在其他地方登录, 请重新登录', $Hardy_config['base_url']);
        setcookie($Hardy_config['project_name'], null);
        setcookie($Hardy_config['project_name'].'_session', null);
        ob_end_flush();
        $model->close();
        die ();
    }
    $model->close();
}

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