<?php
class Post extends BaseObject{
    public $table_name;
    public $db;
	public $title;
	public $content;
	public $image;

	function __construct($table_name = "post", $db = null){
	    session_start();
		$this->table_name = $table_name;
		$this->db = $db;
	}
	public function updatePost(){
		$params = $_POST;

        Image::saveImages($params);

        $sql_body = "";
        foreach($params as $key => $value){
            if($key != "id") {
                $sql_body .= $key . " = " . "'" . $value . "',";
            }
        }
        $sql = "UPDATE ".$this->table_name." SET ".substr($sql_body, 0, strlen($sql_body)-1)." WHERE id = ".$params['id'];

        mysqli_query($this->db, $sql);
        
		$refresh = "/post/view/".$params['id'];
		exit("<meta http-equiv='refresh' content='0; url= {$refresh}'>");
	}
	public function addPost(){
		$params = $_POST;
        $params['date_add'] = date("Y-m-d H:i:s");
        Image::saveImages($params);

        $keys = "(".implode(",", array_keys($params)).")";
        $values = "('".implode("','", array_values($params))."')";
        $sql = "INSERT INTO {$this->table_name} {$keys} VALUES {$values}";
        mysqli_query($this->db, $sql);

        $refresh = "/post/view/".mysqli_insert_id($this->db);
        exit("<meta http-equiv='refresh' content='0; url= {$refresh}'>");
	}
	public function deletePost(){
	    $user_login = $_SESSION['user']['login'];
		mysqli_query($this->db, "DELETE FROM post WHERE id = {$_GET['id']} AND author_login = '$user_login'");
		exit("<meta http-equiv='refresh' content='0; url= /'>");
	}
}
?>