<?php
// base class of the application. It's properties and functions inherit most other classes
class BaseObject{
	public $db;
	public $language;
	public $charset;
	public $app_name;
	public $posts;

	// Security check for incoming post and get requests
	public function is_safe($config, $dir = ""){
		foreach($_POST as $value){
			if(!$this->checkSecurity($value)){
				$page = new Page("bad_request", $config);
				$page->render($dir);
				return false;
			}
		}
		foreach($_GET as $value){
			if(!$this->checkSecurity($value)){
				$page = new Page("bad_request", $config);
				$page->render($dir);
				return false;
			}
		}
		return true;
	}
	public function checkSecurity($value){
		$denied_symbols = ["+", "?", "/", "<", ">", "$", "="];

        if($value != htmlspecialchars(strip_tags(stripslashes(trim($value))))){
        	return false;
        }
        for($i = 0; $i < strlen($value); $i++){
            if(in_array($value[$i], $denied_symbols)){
                return false;
            }
        }
        return true;
	}

	// function wraps the file into a variable
	public function fileToVar($file, $params = []){
		ob_start();
		extract($params);
	    require($file);
	    return ob_get_clean();
	}
	public function getUserPosts(){
	    session_start();
        include "/library/PostWidget.php";
        foreach ($this->posts as $key => $post) {
            $post['content'] = $this->showPreview($post['content'], $post['id']);
            PostWidget::get(['type' => 'preview', 'post' => $post]);
        }
    }
    public function showPreview($text, $post_id){
	    return (strlen($text) > 300)? substr($text, 0, 300)."...<a href='/post/view/{$post_id}'>Read more</a>" :
            substr($text, 0, 300)." <a href='/post/view/{$post_id}'>Read more</a>";
    }
}
?>