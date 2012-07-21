<?php

require_once 'models/myException.php';

class Validation {
	
	public function validatePost ($author, $title, $body) {
		$errors = array();
		if ( empty($author) ) {
			$errors[] = 'author is required';			
		}
		if ( empty($title) ) {
			$errors[] = 'title is required';
		}
		if ( empty($body) ) {
			$errors[] = 'post body is required';
		}
		if( !empty($errors) ) {
			throw new MyException($errors);
		}
		//return $errors;//for testing
		return;
	}
	
	public function validateComment ($author, $body) {
		$errors = array();
		if ( empty($author) ) {
			$errors[] = 'author is required';
		}
		if ( empty($body) ) {
			$errors[] = 'post body is required';
		}
		if( !empty($errors) ) {
			throw new MyException($errors);
		}
		return;
	}
}
?>