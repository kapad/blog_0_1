<?php

class MyException extends Exception {
	
	private $errors = NULL;
	
	public function __construct($errors) {
		parent::__construct("validation error");
		$this->errors = $errors;		
	}
	
	public function getErrors() {
		return $this->errors;
	}
}
?>