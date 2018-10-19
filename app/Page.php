 <?php
class Page extends BaseObject{
	public $name;
	public $params;
	public $public_pages = ['index', 'login_fail', 'bad_request', 'post/view'];
	function __construct($name, $config){
		Session::start();
		$this->name = (isset($_SESSION['user']) or in_array($name, $this->public_pages))? $name : "access_denied";
		$this->db = $config['db'];
		$this->language = $config['language'];
		$this->charset = $config['charset'];
		$this->app_name = $config['app_name'];
	}
	// remember the additional parameters necessary for the page formation
	public function createParams(){
		switch($this->name){
			case 'index':
				if(isset($_COOKIE['my_posts'])){
					$this->posts = $_COOKIE['my_posts'];
				}
				else{
				    $user_login = $_SESSION['user']['login'];
					$posts = Helper::select($this->db, "SELECT * FROM post WHERE author_login = '$user_login' ORDER BY date_add DESC");
					setcookie('my_posts', $posts, time()+60);
					$this->posts = $posts;
                    $this->params = compact('posts');
				}
				break;
			case 'post/view':
                $id = $_GET['id'];
                $post = Helper::select($this->db, "SELECT * FROM post WHERE '$id' = id", 1);
                $comments = Helper::select($this->db, "SELECT * FROM comment WHERE '$id' = post_id ORDER BY date_add DESC");
                $this->params = compact('post', 'comments');
                if(!$post){
                    $this->name = "not_found";
                }
                break;
			case 'post/add':
            case 'post/edit':
				$id = $_GET['id'];
				if($id){
                    $post = Helper::select($this->db, "SELECT * FROM post WHERE '$id' = id", 1);
                    $this->params = compact('post');
                    if(!$post){
                        $this->name = "not_found";
                    }
                    elseif($post['author_login'] != $_SESSION['user']['login']){
                        $this->name = "access_denied";
                    }
                }
				break;
			case 'login_fail':
			case 'bad_request':
			case 'access_denied':
				break;
			default:
				$this->name = "not_found";
				break;
		}
	}
	// render page using added params
	public function render($dir = ""){
		$page_content = $this->fileToVar($dir."/views/{$this->name}.php", $this->params); 
		$charset = $this->charset;
		$language = $this->language;
		$app_name = $this->app_name; 
		include $dir."/views/layout.php"; 
	}
}
?>