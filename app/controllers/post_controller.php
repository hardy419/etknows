<?php

class post_controller extends base_controller
{
    public function index()
    {
        global $Hardy_config;

        // Retrieve posts
        if (isset ($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
        }
        else {
            $keyword = null;
        }
        $this->model = Hardy_get_class('post', 'model');
        $this->data['data'] = $this->model->get_posts($keyword);
        $this->data['rootUrl'] = $Hardy_config['base_url'];

        // Rendering
        require $Hardy_config['view_dir'].'post_view.php';
    }

    public function post()
    {
        global $Hardy_config;

        if (empty ($_POST['content']) && !isset ($_FILES['file-audio']) && !isset ($_FILES['file-pic'])) {
            echo '请输入内容';
            return;
        }
        if (empty ($_POST['subject']) && !isset ($_GET['pid']) && !isset ($_GET['cid'])) {
            echo '请输入标题';
            return;
        }

        $arr = array(
          'msg'=>'提交成功'
        );

        $file_pic = '';
        $file_audio = '';

        // Retrieve user info
        if (isset ($_COOKIE[$Hardy_config['project_name']])) {
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
        if (!isset ($_GET['pid']) && !isset ($_GET['cid'])) {
            if(isset($_POST['content'])) {
                $this->model->new_post(
                    $_POST['subject'],
                    $file_pic,
                    $file_audio,
                    $_POST['content'],
                    (null !== $this->data['user_info']) ? $this->data['user_info']['username'] : '匿名',
                    (null !== $this->data['user_info']) ? $this->data['user_info']['id'] : 0
                );
            }
        }
        else {
            $post_id = isset ($_GET['pid']) ? $_GET['pid'] : 0;
            $comment_id = isset ($_GET['cid']) ? $_GET['cid'] : 0;
            if(isset($_POST['content'])) {
                $this->model->new_comment(
                    $post_id,
                    $comment_id,
                    $_POST['subject'],
                    $file_pic,
                    $file_audio,
                    $_POST['content'],
                    (null !== $this->data['user_info']) ? $this->data['user_info']['username'] : '匿名',
                    (null !== $this->data['user_info']) ? $this->data['user_info']['id'] : 0
                );
            }
        }

        // Return json result
        echo $arr['msg'];//echo json_encode ($arr);
    }
}

?>