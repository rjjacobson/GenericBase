<?php
class indexController {
	
	public function __construct(&$return_type, &$tags) {
		$this->return_type = &$return_type;
		$this->tags = &$tags;
	}
	
	public function get_index() {
		include (VIEW.'genericView.php');
		$view = new genericView();
		$view->setTitle('Home');
		$view->addView('script/general/index.phtml');		
		$view->render();
		
	}
} 
?>