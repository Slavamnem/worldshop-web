<?php
// Class handler of all requests to the application

define("LOAD_TYPE", "request-handler");
include "../autoload.php";
include "../library/PostWidget.php";

class RequestHandler extends BaseObject{
	function __construct($action){
		Session::start();
		global $config;
		// check get and post requests
		if($this->is_safe($config, "..")){
			switch($action){
				case 'checkLogin':
                    $ajaxHandler = new AjaxHandler($config);
					echo $ajaxHandler->checkNewLogin($_POST['login']);
					break;
				case 'registration':
					$user = new User($config['db']);
					$user->registration();
					exit("<meta http-equiv='refresh' content='0; url= /'>");
				case 'login':
					$user = new User($config['db']);
					$user->login();
					$refresh = ($_SESSION['login-status'] == "fail")? "/login_fail" : "/";
					exit("<meta http-equiv='refresh' content='0; url= {$refresh}'>");
					break;
				case 'logout':
					$user = new User($config['db']);
					$user->logout();
					exit("<meta http-equiv='refresh' content='0; url= /'>");
					break;
				case 'update_post':
					$post = new Post("post", $config['db']);
					$post->updatePost();
					break;
				case 'create_post':
					$post = new Post("post", $config['db']);
					$post->addPost();
					break;
				case 'delete_post':
					$post = new Post("post", $config['db']);
					$post->deletePost();
					break;
                case 'add_comment':
                    $params = $_POST;
                    if($this->commentValidate($params)){
                        $params['date_add'] = date("Y-m-d H:i:s");
                        $keys = "(".implode(",", array_keys($params)).")";
                        $values = "('".implode("','", array_values($params))."')";
                        $sql = "INSERT INTO comment {$keys} VALUES {$values}";
                        mysqli_query($config['db'], $sql);

                        echo $this->getCommentSection($params['post_id'], $config['db']);
                    }
                    break;
				default:
					break;
			} 
		}
		// if post or get request are unsafe
		else{
			exit("<meta http-equiv='refresh' content='0; url= /bad_request'>");
		}
	}
	public function commentValidate($params){
	    foreach($params as $key => $param){
	        if($key == "name"){
                if(strlen($param) == 0 or strlen($param) > 50){
                    return false;
                }
            }
            if($key == "email"){
                if(strlen($param) == 0 or strlen($param) > 100 or !filter_var($param, FILTER_VALIDATE_EMAIL)){
                    return false;
                }
            }
            if($key == "comment"){
                if(strlen($param) == 0 or strlen($param) > 1000){
                    return false;
                }
            }
        }
        return true;
    }
    public function getCommentSection($post_id, $db){
        $comments = Helper::select($db, "SELECT * FROM comment WHERE '$post_id' = post_id ORDER BY date_add DESC");
        include "../library/CommentWidget.php"; ?>
        <h4>Comments (<?=count($comments)?>)</h4><br>
        <?php foreach($comments as $comment){
            CommentWidget::get($comment);
        }
    }
}
if(isset($_GET['action'])) $request = new RequestHandler($_GET['action']);
?>