<?php

$Hardy_config = array();

$Hardy_config['project_name'] = 'etknows';

$Hardy_config['slash'] = '\\';
$Hardy_config['base_dir'] = dirname(__FILE__);
$Hardy_config['parent_dir'] = str_replace($Hardy_config['project_name'].$Hardy_config['slash'], '', $Hardy_config['base_dir']);
$Hardy_config['controller_dir'] = $Hardy_config['base_dir'].$Hardy_config['slash'].'app'.$Hardy_config['slash'].'controllers'.$Hardy_config['slash'];
$Hardy_config['model_dir'] = $Hardy_config['base_dir'].$Hardy_config['slash'].'app'.$Hardy_config['slash'].'models'.$Hardy_config['slash'];
$Hardy_config['view_dir'] = $Hardy_config['base_dir'].$Hardy_config['slash'].'app'.$Hardy_config['slash'].'views'.$Hardy_config['slash'];

$Hardy_config['database'] = 'mysql';
$Hardy_config['connect_char'] = 'utf8';
$Hardy_config['host'] = 'localhost:3306';
$Hardy_config['user'] = 'root';
$Hardy_config['password'] = '';
$Hardy_config['schema'] = 'etk_db';

$Hardy_config['base_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$Hardy_config['project_name'].'/';

$Hardy_config['key'] = 98914982772;
//$Hardy_config['key_path'] = $Hardy_config['parent_dir'].$Hardy_config['project_name']."_key.txt";

$Hardy_config['cookie_expire_time'] = 7200;

?>