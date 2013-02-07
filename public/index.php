<?php
try {
	define('BASE',dirname(__FILE__).'/../');
	define('VIEW', BASE.'application/view/');
	define('CONTROLLER', BASE.'application/controller/');
	define('HELPER', BASE.'application/view/helper/');
	define('MODEL', BASE.'application/model/');
	define('LIBRARY', BASE.'application/library/');
	
	echo "YOYO";
	$query_pos = strpos($_SERVER['REQUEST_URI'],'?');
	if ($query_pos) {
		$paths = explode('/',strtolower(str_replace('//','/',substr($_SERVER['REQUEST_URI'],0,$query_pos))));
	} else {
		$paths = explode('/',strtolower(str_replace('//','/',$_SERVER['REQUEST_URI'])));
	}
	$call_type = strtolower($_SERVER['REQUEST_METHOD']);
	$i = count($paths);
	$reset = false;
	while ($i > 0) {
		if ($paths[$i-1] == '') {
			unset($paths[$i-1]);
			$reset = true;
		}
		$i--;
	}
	if ($reset) {
		$paths = array_values($paths);
	}

	$path_size = count($paths);
	
	//  defaults if nothing's left
	if ($path_size == 0) {
		$method = 'index';
		$object = 'index';
		$return_type = 'html';
		$tags = array();
	} else {
		//if it's an ajax call
		if ($paths[0] == 'ajax') {
			//drop the ajax element, recheck for defaults
			$return_type = 'json';
			unset($paths[0]);
			$paths = array_values($paths); 
			$path_size = count($paths);
			if ($path_size == 0) {
				$method = 'index';
				$object = 'index';
				$tags = array();
				return;
			}
		} else {
			$return_type = 'html';
		}
		$object = $paths[0];
		if ($path_size == 1) {
			$method = 'index';
			$tags = array();	
		} else {
			$method = $paths[1];
			if ($path_size == 2) {
				$tags = array();
			} else {
				$tags = array_slice($paths, 2);
			}
		}
	}
	$object = str_replace('-','/',$object);
	

	if (file_exists(CONTROLLER.$object.'Controller.php')) {
		require_once (CONTROLLER.$object.'Controller.php');
		$controller_name = $object.'Controller';
		$controller = new $controller_name($return_type, $tags);
		$method_name = $call_type.'_'.$method;	
		if (method_exists($controller,$method_name)) {
			$controller->$method_name();
		} else {
			$controller->get_index();
		}
	} else {
		include (CONTROLLER.'indexController.php');
		$controller = new indexController($return_type, $call_type, $tags);
		$controller->get_index();
	}
	exit();
} catch (Exception $e) {
	print $e->getMessage();
}
?>