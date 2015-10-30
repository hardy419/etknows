<?php

class base_controller
{
    protected $data = null;
    protected $model = null;

    function __construct() {
        global $Hardy_config;

        $this->data = array();
        $this->data['user_info'] = null;

        // Check session
        if (isset ($_COOKIE[$Hardy_config['project_name']])) {
            $user_model = Hardy_get_class('user', 'model');
            $user_model->connect();
            $this->data['user_info'] = $user_model->get_user ($_COOKIE[$Hardy_config['project_name']]);
            if (null == $this->data['user_info'] || $_COOKIE[$Hardy_config['project_name'].'_session'] != $this->data['user_info']['sid']) {
                // Session ID mismatch
                Hardy_message ('警告: 会话ID不匹配, 有可能账号在其他地方登录, 请重新登录', $Hardy_config['base_url']);
                setcookie($Hardy_config['project_name'], null);
                setcookie($Hardy_config['project_name'].'_session', null);
                ob_end_flush();
                $user_model->close();
                die ();
            }
            $user_model->close();
        }
    }

    function __destruct() {
    }
}

?>