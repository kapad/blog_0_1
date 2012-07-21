<?php

require_once 'models/DBGateway.php';
require_once 'models/validation.php';
require_once 'models/myException.php';
define('summaryLength', 30);

class BlogServices {

	private $DBGateway = NULL;
	private $validation = NULL;

	public function __construct() {
		$this->DBGateway = new DBGateway();
		$this->validation = new Validation();
	}

	/**
	 * 
	 * @param string $string
	 * @param int $wordsreturned
	 * @return string $summary
	 */
	private function getSummary($string, $wordsreturned)
	{
		$retval = $string;
		$array = explode(" ", $string);
		if (count($array)<=$wordsreturned)
		{
			$retval = $string;
		}
		else
		{
			array_splice($array, $wordsreturned);
			$retval = implode(" ", $array)."...";
		}
		return $retval;
	}

	/**
	 *
	 * @param string $author
	 * @param string $title
	 * @param long text $body
	 * @return number $postId
	 */
	public function newPost ($author, $title, $body) {
		$this->validation->validatePost($author, $title, $body);
		$summary = $this->getSummary($body, summaryLength);
		$postId = $this->DBGateway->insertPost($author, $title, $body, $summary);
		return $postId;
	}

	/**
	 *
	 * @param number $postId
	 * @param string $author
	 * @param string $title
	 * @param text $body
	 * @return number $commentId
	 */
	public function newComment($postId, $author, $body) {
		$this->validation->validateComment($author, $body);
		$commentId = $this->DBGateway->insertComment($author, $body, $postId);
		return $commentId;//$commentId is not being used
	}

	/**
	 *
	 * @return object array $posts
	 */
	public function allPosts () {
		$posts = $this->DBGateway->getAllPosts();
		return $posts;
	}

	/**
	 *
	 * @param number $postId
	 * @return object $post
	 */
	public function getPost($postId) {
		$post = $this->DBGateway->getPost($postId);
		return $post;
	}

	/**
	 *
	 * @param number $postId
	 * @return object array $comments
	 */
	public function getComments ($postId) {
		$comments = $this->DBGateway->getAllComments($postId);
		return $comments;
	}

	/**
	 * 
	 * @param number $postId
	 * @param string $author
	 * @param string $title
	 * @param string $body
	 */
	public function editPost($postId, $author, $title, $body) {		
		$this->validation->validatePost($author, $title, $body);
		$summary = $this->getSummary($body, summaryLength);
		$this->DBGateway->editPost($postId, $author, $title, $body, $summary);
		return;
	}
}

?>