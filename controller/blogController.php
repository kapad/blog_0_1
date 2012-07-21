<?php

require_once 'models/blogServices.php';

class BlogController {
	
	private $services = NULL;
	
	public function __construct() {
		$this->services = new BlogServices();
	}
	
	/**
	 * 
	 * @param string $options
	 */
	private function redirect($options) {
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php' . $options;
		header("Location: http://$host$uri/$extra");
	}
	
	public function handleRequest() {
		$op = isset($_GET['op']) ? $_GET['op'] : NULL;
		$id = isset($_GET['id']) ? $_GET['id'] : NULL;
		try {
			switch ($op) {
				case NULL:
				case 'all':
					$this->showAll();
					break;
				case 'edit':
					if($id == NULL) {
						throw new Exception("you must select a post to edit");
					}
					$this->editPost($id);
					break;
				case 'addComment':
					if($id == NULL) {
						throw new Exception("you must select a post to add the comment to");
					}
					$this->addComment($id);
					break;
				case 'view':
					if($id == NULL) {
						throw new Exception("you must select a post to view");
					}
					$this->showPost($id);
					break;
				case 'newPost':
					$this->newPost();
					break;
				default:
					throw new Exception("the option that you have entered is not supported");										
			}
		}
		catch (Exception $e) {
			$message = $e->getMessage();
			echo "<p>$message</p>";
		}
	}
	
	/**
	 * 
	 */
	 private function showAll() {
	 	try {
			$posts = $this->services->allPosts();
			include_once 'views/allPosts.php';
	 	}
	 	catch (Exception $e) {
			$message = $e->getMessage();
			echo "<p>$message</p>";
	 	}
	}
	
	/**
	 * 
	 * 
	 */
	private function editPost($postId) {
		$errors = NULL;
		try {		
			$post = $this->services->getPost($postId);
			if ( isset($_POST['submit']) ) {
				$author = $_POST['author'];
				$title = $_POST['title'];
				$body = $_POST['body'];
				$this->services->editPost($postId, $author, $title, $body);
				$this->redirect("?op=view&id=$postId");
			}
			else {				
				$author = $post->author;
				$title = $post->title;
				$body = $post->body;
			}			
		}
	 	catch (MyException $e) {
	 		$errors = $e->getErrors();
	 	}
	 	catch (Exception $e) {
			$message = $e->getMessage();
			echo "<p>$message</p>";
	 	}
		if ( isset($_POST['submit']) ) {
			$author = ( !empty($_POST['author']) ) ? $_POST['author'] : $post->author;
			$title = ( !empty($_POST['title']) ) ? $_POST['title'] : $post->title;
			$body = ( !empty($_POST['body']) ) ? $_POST['body'] : $post->body;
		}
		include_once 'views/newPostForm.php';		
	}
	
	/**
	 * 
	 */
	private function addComment($postId) {
		$errors = NULL;
		$author = NULL;
		$body = NULL;
		if( isset($_POST['submit']) ) {
			try {
				$author = $_POST['author'];
				$body = $_POST['body'];
				$this->services->newComment($postId, $author, $body);
				$this->redirect("?op=view&id=$postId");
			}
	 		catch (MyException $e) {
	 			$errors = $e->getErrors();
	 		}
	 		catch (Exception $e) {
				$message = $e->getMessage();
				echo "<p>$message</p>";
	 		}
		}
		include_once 'views/newCommentForm.php';
	}
	
	/**
	 * 
	 */
	private function showPost($postId) {
		$post = $this->services->getPost($postId);
		$comments = $this->services->getComments($postId);
		include_once 'views/fullPost.php';
	}
	
	/**
	 * 
	 */
	 private function newPost() {
	 	$errors = NULL;
	 	$author = NULL;
	 	$title = NULL;
	 	$body = NULL;
	 	if( isset($_POST['submit']) ) {
	 		try {
	 			$author = $_POST['author'];
	 			$body = $_POST['body'];
	 			$title = $_POST['title'];
	 			$postId = $this->services->newPOst($author, $title, $body);
	 			$this->redirect("?op=view&id=$postId");
	 		}
	 		catch (MyException $e) {
	 			$errors = $e->getErrors();
	 		}
	 		catch (Exception $e) {
				$message = $e->getMessage();
				echo "<p>$message</p>";
	 		}
	 	}
	 	include_once 'views/newPostForm.php';
	}
}

?>