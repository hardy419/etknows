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

        // Retrieve posts
        $this->model = Hardy_get_class('post', 'model');
        $this->model->connect();
        $this->data['data'] = $this->model->get_posts();
        $this->data['rootUrl'] = $Hardy_config['base_url'];
        $this->model->close();

        // Rendering
        require $Hardy_config['view_dir'].'main_view.php';
    }

    public function post()
    {
        global $Hardy_config;

        $arr = array(
          'msg'=>'提交成功'
        );

        $file_pic = '';
        $file_audio = '';

        $user_info = null;

        // Retrieve user info
        if (isset ($_COOKIE[$Hardy_config['project_name']])) {
            $this->model = Hardy_get_class('user', 'model');
            $this->model->connect();
            $user_info = $this->model->get_user ($_COOKIE[$Hardy_config['project_name']]);
            $this->model->close();

            // File uploading
            $audioname = '';
            $picname = '';
            isset ($_FILES['file-audio']) && $audioname = $_FILES['file-audio']['name'];
            isset ($_FILES['file-pic']) && $picname = $_FILES['file-pic']['name'];
            if ($audioname != "") {
                $type = strstr($audioname, '.');
                if ($type != ".wav" && $type != ".ogg" && $type != ".mp3") {
                    $arr['msg'] = '不支持的音频格式（只支持.wav/.ogg/.mp3）';
                    echo $arr['msg'];//echo json_encode ($arr);
                    return;
                }
                $file = substr ($audioname, 0, strlen($audioname)-strlen($type)) . '_' .
                        date("YmdHis") . '_' .
                        mt_rand(0,9999) .
                        $type;
                $file_audio = "public/upload/". $file;
                move_uploaded_file($_FILES['file-audio']['tmp_name'], $file_audio);
            }
            if ($picname != "") {
                $type = strstr($picname, '.');
                if ($type != ".jpg" && $type != ".jpeg" && $type != ".png" && $type != ".gif") {
                    $arr['msg'] = '不支持的图片格式（只支持.jpg/.png/.gif）';
                    echo $arr['msg'];//echo json_encode ($arr);
                    return;
                }
                $file = substr ($picname, 0, strlen($picname)-strlen($type)) . '_' .
                        date("YmdHis") . '_' .
                        mt_rand(0,9999) .
                        $type;
                $file_pic = "public/upload/". $file;
                move_uploaded_file($_FILES['file-pic']['tmp_name'], $file_pic);
            }
        }

        // New post
        $this->model = Hardy_get_class('post', 'model');
        $this->model->connect();
        if(isset($_POST['content'])) {
            $this->model->new_post(
                $_POST['subject'],
                $file_pic,
                $file_audio,
                $_POST['content'],
                (null !== $user_info) ? $user_info['username'] : '匿名',
                (null !== $user_info) ? $user_info['id'] : 0
            );
        }
        $this->model->close();

        // Return json result
        echo $arr['msg'];//echo json_encode ($arr);
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