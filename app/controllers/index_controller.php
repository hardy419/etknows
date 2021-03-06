<?php

class index_controller extends base_controller
{
    public function index()
    {
        global $Hardy_config;

        // Search view: Post URL where form submits
        $this->data['rootUrl'] = $Hardy_config['base_url'];

        // Rendering
        require $Hardy_config['view_dir'].'home_view.php';
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