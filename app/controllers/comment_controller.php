<?php

class comment_controller extends base_controller
{
    public function index()
    {
        global $Hardy_config;

        // Retrieve comments on that post
        $post_id = $_GET['pid'];
        $this->model = Hardy_get_class('post', 'model');
        $this->data['post'] = $this->model->get_post_by_id($post_id);
        $this->data['data'] = $this->model->get_comments($post_id);
        $this->data['post_id'] = $post_id;
        $this->data['rootUrl'] = $Hardy_config['base_url'];

        // Rendering
        require $Hardy_config['view_dir'].'comment_view.php';
    }
}

?>