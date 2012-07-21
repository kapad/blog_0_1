<?php

require_once 'DBC_constants.php';

define('posts','blog_posts');
define('comments','comments');
define('cPostId', 'post_id');
/**
 * 
 * @author rohan
 *
 */
class DBGateway {
	
	private $dbc = NULL;
	
	/*public function __construct() {
		$this->openDBC();
	}
	
	public function __destruct() {
		$this->closeDBC();
	}
	*/
	
	private function openDBC() {
		$this->dbc = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
		if($this->dbc->errno) {
			throw new Exception("connection to the database has failed" . $this->dbc->connect_error());
		}
	}
	
	private function closeDBC() {
		$this->dbc->close();
	}
	
	/**
	 * seperates out the object array generation from mysqli_result. 
	 * common to getAllPOsts() and getAllComments()
	 * @param mysqli_result $res
	 * @return object array generated from result
	 */
	private function getObjArray ($res) {
		$resObj = array();
		while( $obj = $res->fetch_object() ) {
			$resObj[] = $obj;
		}
		return $resObj;
	}
	
	/**
	 * @return object array of all posts
	 */
	public function getAllPosts () {
		$this->openDBC();
		$query = "SELECT * FROM " . posts;
		$res = $this->dbc->query($query);
		$resObj = $this->getObjArray($res);
		//$res->free();
		$this->closeDBC();
		return $resObj;
	}
	
	/**
	 * 
	 * @param number $postId
	 * @return object array of all comments
	 */
	public function getAllComments($postId) {
		$this->openDBC();
		$query = "SELECT * FROM " . comments .
			" WHERE " . cPostId . " = $postId";
		$res = $this->dbc->query($query);
		$resObj = $this->getObjArray($res);
		//$res->free();
		$this->closeDBC();
		return $resObj;
	}
	
	/**
	 * 
	 * @param string $paramAuthor
	 * @param string $paramTitle
	 * @param string $paramBody
	 * @return number $postId of inserted post
	 */
	public function insertPost ($paramAuthor, $paramTitle, $paramBody, $paramSummary) {
		$this->openDBC();
		$author = $this->dbc->real_escape_string($paramAuthor);
		$title = $this->dbc->real_escape_string($paramTitle);
		$body = $this->dbc->real_escape_string($paramBody);
		$summary = $this->dbc->real_escape_string($paramSummary);
		$query = "INSERT INTO " . posts . " (title, body, author, summary) " . 
			" VALUES ('$title', '$body', '$author', '$summary')";
		$this->dbc->query($query);
		$postId = $this->dbc->insert_id;
		$this->closeDBC();
		return intval($postId);
	}
	
	/**
	 * 
	 * @param string $paramAuthor
	 * @param string $paramBody
	 * @param string $postId
	 * @return number
	 */
	public function insertComment ($paramAuthor, $paramBody, $postId) {
		$this->openDBC();
		$author = $this->dbc->real_escape_string($paramAuthor);
		$body = $this->dbc->real_escape_string($paramBody);
		$query = "INSERT INTO " . comments . " (`post_id`, `author`, `body`) " . 
			" VALUES($postId, '$author', '$body') ";
		$this->dbc->query($query);
		$commentId = $this->dbc->insert_id;
		//$res->free();
		$this->closeDBC();
		return intval($commentId);
	} 
	
	/**
	 * 
	 * @param number $postId
	 */
	public function getPost($postId) {
		$this->openDBC();
		$query = "SELECT * FROM " . posts . " WHERE `id` = $postId";
		$res = $this->dbc->query($query);
		$post = $res->fetch_object();
		//$res->free();
		$this->closeDBC();
		return $post;
	}
	
	/**
	 * 
	 * @param number $postId
	 * @param string $author
	 * @param string $title
	 * @param string $body
	 * @param string $summary
	 */
	public function editPost($postId, $paramAuthor, $paramTitle, $paramBody, $paramSummary) {
		$this->openDBC();
		$author = $this->dbc->real_escape_string($paramAuthor);
		$title = $this->dbc->real_escape_string($paramTitle);
		$body = $this->dbc->real_escape_string($paramBody);
		$summary = $this->dbc->real_escape_string($paramSummary);
		$query = "UPDATE " . posts . " SET timestamp=DEFAULT, title='$title', body='$body', author='$author', summary='$summary'" .
		" WHERE id=$postId";
		$this->dbc->query($query);
		//echo $this->dbc->error; //used for debugging
		//$res->free();
		$this->closeDBC();		
	}
	
}

?>