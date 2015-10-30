<?php

$Hardy_classes = array();

function Hardy_get_class($name, $type='controller')
{
	global $Hardy_config;
	global $Hardy_classes;
	$class_name = $name.'_'.$type;
	
	if(!isset($Hardy_classes[$class_name]))
	{
		if(file_exists($Hardy_config[$type.'_dir'].$class_name.'.php'))
		{
			include_once $Hardy_config[$type.'_dir'].$class_name.'.php';
			$Hardy_classes[$class_name] = new $class_name();
		}
		else return null;
	}
	return $Hardy_classes[$class_name];
}

function Hardy_message ($msg, $retUrl)
{
	global $Hardy_config;
    require $Hardy_config['view_dir'].'header_view.php';
    echo "<p><strong>{$msg}</strong></p>";
    echo "<a href=\"{$retUrl}\" name=\"return\">点此返回...</a>";
    require $Hardy_config['view_dir'].'footer_view.php';
}

?>