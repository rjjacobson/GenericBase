<?php 
class genericView {
	
	public $views;
	public $scriptSrcs; 
	public $title;
	public $passBackVariables;
	public $headerFile ="";
	public $footerFile ="";
	
	public function __construct() {
		$this->views = array();
		$this->scriptSrcs = array();
	}
	
	public function addView($view) {
		array_push($this->views, $view);
	}
	
	public function addScriptSrc($scriptSrc) {
		array_push($this->scriptSrcs, $scriptSrc);
	} 
	
	public function setTitle($title) {
		$this->title = $title;
	}

	public function setPassBackVariables($passBack) {
		$this->passBackVariables = $passBack;
	}
	
	public function setHeaderFile($headerFile) {
		$this->headerFile = $headerFile;
	}
	
	public function setFooterFile($footerFile) {
		$this->footerFile = $footerFile;
	}
		
	public function render() {
		global $user_login;

		if ($this->headerFile == ""){
			include (VIEW.'template/general_head.phtml');	
		}else{
			include (VIEW.$this->footerFile);
		}
	
		if (count($this->views > 0)) {
			foreach ($this->views as $view) {
				include (VIEW . $view);
			}
		} else {
			// TODO: 
			// include something if there's no view - what to add
		}
		
		if ($this->footerFile == ""){
			//include (VIEW.'template/common/general_foot.phtml');	
		}else{
			//include (VIEW.$this->footerFile);
		}
		
		
		
	}
	
}