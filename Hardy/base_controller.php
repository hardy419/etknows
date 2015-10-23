<?php

class base_controller
{
    protected $data = null;
    protected $model = null;
    function __construct() {
        $this->data = array();
    }
    function __destruct() {
    }
}

?>