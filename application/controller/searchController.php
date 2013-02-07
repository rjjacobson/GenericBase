<?php
class searchController {
	
	public function __construct(&$return_type, &$tags) {
		$this->return_type = &$return_type;
		$this->tags = &$tags;
	}
	
	public function post_main() {
		echo "BOB";
	}
} 
?>