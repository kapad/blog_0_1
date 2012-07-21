<?php

require_once 'models/validation.php';

class validationTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @dataProvider validPostProvider
	 */	
	public function testValidatePost($author, $title, $body) {
		$tester	= new Validation();
		$this->assertEmpty( $tester->validatePost($author, $title, $body) );
		//validatePost function needs to be changed accordingly. 
	}
	
	public function validPostProvider() {
		return array(
				array('rohan', 'firstpost', 'this is my first post here'),
				array('tester', 'secondpost', 'this is testers post')				
				);
	}
	
	/**
	 * @dataProvider invalidPostProvider
	 * @expectedException MyException
	 */
	public function testForErrors($author, $title, $body) {
		$tester = new Validation();
		$tester->validatePost($author, $title, $body);
	}
	
	public function invalidPostProvider() {
		return array(
				array('rohan', NULL, 'post without title'),
				array('', 'title', 'post without author'),
				array('rohan', 'stupid title', ''),
				array('','','')
				);
	}
	
	/**
	 * @dataProvider invalidPostProvider
	 */
	public function testForExceptions($author, $title, $body) {
		$tester = new Validation();
		$e1 = 'author is required';
		$e2 = 'title is required';
		$e3 = 'post body is required';
		try {
			$tester->validatePost($author, $title, $body);
		}
		catch (MyException $e) {
			$errors = $e->getErrors();
			foreach($errors as $error) {
				if($error == $e1 || $error == $e2 || $error == $e3) {
					$this->assertTrue(TRUE);
				}
				else {
					$this->assertTrue(FALSE);
				}
			}
		}
	}
}

?>