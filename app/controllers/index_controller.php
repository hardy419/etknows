<?php

class index_controller extends base_controller
{
    public function index()
    {
        global $Hardy_config;
        
        // Retrieve user name
        if (isset ($_COOKIE[$Hardy_config['project_name']])) {
            $this->model = Hardy_get_class('user', 'model');
            $this->model->connect();
            $user_info = $this->model->get_user ($_COOKIE[$Hardy_config['project_name']]);
            $this->data['user'] = $user_info['username'];
            $this->model->close();
        }

        // File uploading
        $file_pic = '';
        $file_audio = '';

        // New post
        $this->model = Hardy_get_class('post', 'model');
        $this->model->connect();
        if(isset($_POST['content'])) {
            $this->model->new_post(
                $_POST['subject'],
                $file_pic,
                $file_audio,
                $_POST['content'],
                isset($this->data['user']) ? $this->data['user'] : '匿名',
                isset($this->data['user']) ? $_COOKIE[$Hardy_config['project_name']] : 0
            );
        }

        // Retrieve posts
        $this->data['data'] = $this->model->get_posts();
        $this->data['rootUrl'] = $Hardy_config['base_url'];
        $this->model->close();

        // Rendering
        require $Hardy_config['view_dir'].'main_view.php';
    }

    public function message ($msg, $retUrl)
    {
        global $Hardy_config;
        $this->data['message'] = $msg;
        $this->data['retUrl'] = $retUrl;
        require $Hardy_config['view_dir'].'message_view.php';
    }
}

?>