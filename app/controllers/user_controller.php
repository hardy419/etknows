<?php

class user_controller extends base_controller
{
    function __construct()
    {
        parent::__construct();
    }
    function __destruct()
    {
        parent::__destruct();
    }

    public function index()
    {
        $this->login ();
    }

    public function login()
    {
        global $Hardy_config;
        
        $this->model = Hardy_get_class('user', 'model');
        $this->model->connect();
        
        $this->data['message'] = $this->model->login ($_POST["user"], $_POST["password"]);
        if (is_array ($this->data['message'])) {
            $uid = $this->data['message']['id'];
            // Create a session
            $sessionID = "".hash('sha1', $_POST["password"].time());
            // Set cookie..
            setcookie($Hardy_config['project_name'], $uid, time()+$Hardy_config['cookie_expire_time']);
            setcookie($Hardy_config['project_name'].'_session', $sessionID);
            // Find the user in the DB and save/replace the sessionID
            date_default_timezone_set ('PRC');
            $datetime = date("Y-m-d H:i:s");
            $this->model->update_session($uid, $sessionID, $datetime);
            
            $this->data['message'] = $this->success_msg;
            header ('Location: '.$Hardy_config['base_url']);
        }
        $this->model->close ();
        
        $this->data['retUrl'] = $Hardy_config['base_url'];

        require $Hardy_config['view_dir'].'message_view.php';
    }

    public function register()
    {
        global $Hardy_config;
        
        if(isset($_POST['register_name']))
        {
            $this->model = Hardy_get_class('user', 'model');
            $this->model->connect();
            
            if($this->model->check_existence($_POST['register_name']))
            {
                $this->data['message'] = '该用户名已存在！';
                $this->data['retUrl'] = $Hardy_config['base_url'].'?r=user/register';
            }
            elseif($_POST['register_password'] !== $_POST['register_password_again'])
            {
                $this->data['message'] = '两次输入的密码不一致！';
                $this->data['retUrl'] = $Hardy_config['base_url'].'?r=user/register';
            }
            else
            {
                $this->model->register ($_POST['register_name'],
                                        $_POST['register_password'],
                                        $_POST['register_password_again'],
                                        1,
                                        '',
                                        '',
                                        '',
                                        '');
                $this->data['message'] = '感谢你的注册，你现在可以使用注册的用户名登录BBS！';
                $this->data['retUrl'] = $Hardy_config['base_url'];
            }
            
            $this->model->close();
            
            require $Hardy_config['view_dir'].'message_view.php';
            return;
        }
        
        $this->data['rootUrl'] = $Hardy_config['base_url'];

        require $Hardy_config['view_dir'].'register_view.php';
    }

    public function logout()
    {
        global $Hardy_config;
        
        setcookie($Hardy_config['project_name'], null);
        setcookie($Hardy_config['project_name'].'_session', null);
        $this->data['message'] = '你已经成功登出！';
        $this->data['retUrl'] = $Hardy_config['base_url'];

        require $Hardy_config['view_dir'].'message_view.php';
    }
}

?>