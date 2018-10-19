<?php
// Handling ajax requests on the site
class AjaxHandler extends BaseObject{
	function __construct($config){	
		Session::start();
		$this->db = $config['db'];
	}
	// Check if login is busy 
	public function checkNewLogin($login){ 
		return (Helper::select($this->db, "SELECT id FROM user WHERE '$login' = login"))? 0 : 1;
	}
}
?>