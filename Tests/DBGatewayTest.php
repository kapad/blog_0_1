<?php 

require_once 'models/DBGateway.php';

class DBGatewayTest extends PHPUnit_Framework_TestCase {
	
	public function testInsertPost() {
		$poster = new DBGateway();
		$postId = $poster->insertPost('rohan', 'rk post', 'thi#s is my post', 'th//is');
		$this->assertGreaterThanOrEqual(1, $postId);
		return $postId;
	}
	
	/**
	 * @depends testInsertPost
	 */
	public function testInsertComment ($postId) {
		$inserter = new DBGateway();
		$this->assertGreaterThanOrEqual(1, $inserter->insertComment('rohan', 'this is my comment', $postId));
	}
	
	public function testGetAllPosts() {
		$getter = new DBGateway();		
		$posts = $getter->getAllPosts();
		foreach ($posts as $post) {
			$this->assertObjectHasAttribute('id', $post);
			$this->assertObjectHasAttribute('timestamp', $post);
			$this->assertObjectHasAttribute('title', $post);
			$this->assertObjectHasAttribute('body', $post);
			$this->assertObjectHasAttribute('author', $post);
			$this->assertObjectHasAttribute('summary', $post);
		}
	}
	
	/**
	 * @depends testInsertPost
	 */
	public function testGetAllComments ($postId) {
		$getter = new DBGateway();
		$comments = $getter->getAllComments( ($postId+10) );
		foreach ($comments as $comment) {
			$this->assertObjectHasAttribute('id', $comment);
			$this->assertObjectHasAttribute('post_id', $comment);
			$this->assertObjectHasAttribute('author', $comment);
			$this->assertObjectHasAttribute('timestamp', $comment);
			$this->assertObjectHasAttribute('body', $comment);		
		}
	}
	
	/*public function testEditPost() {
		$editor = new DBGateway();
		$editor->editPost(1, 'rohan', 'i am legend', 'movie', 'bullshit');
	}*/
	
	/**
	 * @depends testInsertPost
	 */
	public function testGetPost($postId) {
		$getter = new DBGateway();
		$post = $getter->getPost($postId);
		$this->assertInstanceOf('stdClass', $post);
		$this->assertObjectHasAttribute('id', $post);
		$this->assertObjectHasAttribute('timestamp', $post);
		$this->assertObjectHasAttribute('title', $post);
		$this->assertObjectHasAttribute('body', $post);
		$this->assertObjectHasAttribute('author', $post);
		$this->assertObjectHasAttribute('summary', $post);
	}
	
}
?>