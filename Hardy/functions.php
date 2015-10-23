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

?>