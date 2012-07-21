<?php

require_once 'models/blogServices.php';

class blogServicesTest extends PHPUnit_Framework_TestCase {

	/**
	 * @var BlogServices
	 */
	public $tester = NULL;

	public function __construct() {
		$this->tester = new BlogServices();
	}

	public function testNewPost() {
		$text = 'this is a very short post.';
		//$text = 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.';
		$postId = $this->tester->newPost('rohan', 'testing blogServices', $text);
		$this->assertGreaterThanOrEqual(1, $postId);
		return $postId;
	}

	public function testMultiplePosts() {
		//$text = 'this is a very short post.';
		//$text = 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.';
		$titles = array(
				"Lorem ipsum dolor sit amet.",
				"Fusce commodo justo sit amet",
				"mi venenatis tristique. Maecenas vehicula",
				"ante sit amet dolor posuere mollis.",
				"Nam vel est nunc. Suspendisse suscipit",
				"arcu a est tempus tincidunt.",
				"Donec congue bibendum velit vitae",
				"interdum. Suspendisse consectetur eleifend felis",
				"non aliquet. Ut sit amet quam",
				"consectetur nibh ullamcorper convallis.",
				"Phasellus venenatis tristique."
		);
		$posts = array (
				"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula egestas urna, ac rutrum mi faucibus sed. Pellentesque a elit ac turpis malesuada interdum. Nullam sit amet nisi et lacus iaculis placerat. Etiam diam nisi, imperdiet eget commodo id, tempus ac lacus. Suspendisse sed augue at elit mattis pretium a eget nisl. In eget sapien arcu, ac cursus enim. Vivamus luctus elit non ante vulputate semper. Phasellus ipsum sapien, molestie posuere consequat a, convallis sed est. Integer lacinia urna eu sapien dictum suscipit. Sed sapien ante, scelerisque sed tempus et, aliquet a purus. Etiam mattis velit laoreet elit feugiat nec pharetra sem imperdiet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam id odio velit.",
				"Proin at odio turpis, et consequat diam. Maecenas in tellus sed nibh viverra sagittis. Phasellus blandit, dolor eget venenatis ornare, erat erat lobortis ipsum, vel vulputate nibh augue sit amet enim. Suspendisse dignissim aliquam enim, ac mollis orci dapibus vel. Nullam rutrum aliquam libero ut facilisis. Donec vitae erat nec elit mattis luctus. Nullam scelerisque vulputate risus ut commodo. Curabitur nibh purus, varius sed mollis eu, consectetur in eros. Vivamus luctus lacinia pellentesque. Quisque varius, lorem dictum condimentum vehicula, velit magna faucibus felis, ornare interdum sapien ipsum quis nulla. Mauris ultrices nisl eu risus dictum malesuada. Integer tempus urna lorem. Nullam luctus tristique est, eget accumsan augue pharetra vel. Nulla facilisi.",
				"Sed aliquam mattis pulvinar. Sed aliquet rhoncus libero, sed ultricies ligula sollicitudin sit amet. Cras vestibulum posuere purus et tempus. Aenean eget tellus purus. Vivamus vitae purus justo. Donec tincidunt placerat metus sit amet pellentesque. Morbi sed mi id risus fermentum tempor quis sed velit. Morbi eleifend fringilla mauris sed auctor. Phasellus pretium eleifend nisi sed elementum. Maecenas sed nisi quam. Ut egestas, mi sed iaculis blandit, metus libero pharetra odio, a pretium eros massa vel purus. Duis a tristique dui. Etiam sit amet vulputate risus. Quisque pellentesque massa eu nisi mattis commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
				"Vivamus lacus velit, sodales vel commodo eu, tincidunt quis dolor. Quisque a tincidunt nunc. Suspendisse augue lorem, laoreet ac vehicula sit amet, fermentum id eros. Vivamus ante augue, auctor et gravida in, interdum sed velit. Integer urna odio, placerat non blandit sit amet, tincidunt non massa. Maecenas et risus at diam tristique mollis. Sed non sodales dolor. In dictum pharetra lacus, nec commodo massa vehicula ac.",
				"Ut semper magna dui. Vivamus ac augue mi. Quisque commodo dui eget sem tempus interdum. Mauris interdum lectus in nulla sollicitudin quis condimentum purus hendrerit. Mauris nunc leo, tempus id lobortis ultricies, commodo at neque. Ut consequat, quam ut tincidunt faucibus, tortor nisi rutrum risus, vitae tincidunt diam sem sit amet massa. Etiam in purus enim, vitae vulputate arcu.",
				"Duis quis tincidunt lectus. Mauris vestibulum tristique magna, ut euismod tellus varius sed. Etiam fermentum bibendum sapien sit amet vulputate. Nunc et mattis turpis. Pellentesque pellentesque sapien nec sapien consectetur in luctus neque vulputate. Quisque varius pellentesque erat, congue rutrum neque elementum quis. Fusce bibendum ligula in orci fringilla auctor. Aliquam ullamcorper faucibus accumsan. Praesent quis sapien mauris, sit amet dictum quam. Aliquam erat volutpat.",
				"Sed ultrices feugiat eros, sit amet vehicula sem dignissim placerat. Duis pretium bibendum est in suscipit. Phasellus aliquet, nibh vitae suscipit viverra, sem risus aliquam risus, rhoncus hendrerit mauris diam non leo. Curabitur bibendum auctor suscipit. Nulla accumsan rutrum cursus. In hac habitasse platea dictumst. Donec eget mi ornare turpis posuere commodo quis eu neque. Nunc bibendum dolor eu risus placerat congue. Proin justo augue, vehicula non aliquam ut, porttitor sit amet elit. Integer mi nulla, dictum lobortis congue et, consectetur vitae libero. Suspendisse enim urna, semper at bibendum ut, euismod a mauris.",
				"Etiam luctus viverra posuere. Cras consequat sagittis nibh et iaculis. Suspendisse ac ante ut arcu lacinia pretium vitae non orci. Donec rutrum facilisis dapibus. Proin porta iaculis dolor mollis adipiscing. Maecenas libero est, iaculis eget fermentum in, cursus molestie lacus. Donec vel turpis vel ligula pharetra facilisis. Fusce in libero enim.",
				"Maecenas vitae mauris velit. Morbi commodo consectetur auctor. Aliquam orci erat, ultrices nec iaculis quis, volutpat sit amet libero. In urna lorem, cursus in consequat at, consectetur id turpis. Vestibulum mi velit, viverra quis iaculis ac, blandit a metus. Fusce lacinia ante et elit imperdiet pellentesque. Donec quis dui orci, id congue lorem.",
				"Nullam molestie mi eu felis aliquam aliquet. Ut ac massa libero, eu auctor sapien. Nulla hendrerit massa a quam blandit pellentesque. Maecenas a suscipit est. Proin sagittis condimentum pellentesque. Donec in accumsan urna. Donec sit amet nulla sed tellus blandit posuere. Sed ac leo vitae massa congue congue. In hac habitasse platea dictumst. Vestibulum vel ultrices augue. Sed dignissim, dui ut placerat ornare, sapien velit cursus metus, sodales lacinia ante purus ac nibh. In arcu arcu, posuere at bibendum suscipit, consequat mollis dui. Suspendisse cursus adipiscing ante vel imperdiet."
		);
		for ($i=0; $i<500000; $i++) {
			$randTitles = array_rand($titles, 2);
			$randPosts = array_rand($posts, 4);
			$arrayTitles = array();
			$arrayPosts = array();
			foreach ($randTitles as $randTitle) {
				$arrayTitles[] = $titles[$randTitle];
			}
			foreach($randPosts as $randPost) {
				$arrayPosts[] = $posts[$randPost];
			}
			$title = implode(' ', $arrayPosts);
			$post = implode(' ', $arrayTitles);
			$postId = $this->tester->newPost('rohan', $title, $post);
			$this->assertGreaterThanOrEqual(1, $postId);
		}
	}

	/**
	 * @depends testNewPost
	 * @param unknown_type $postId
	 */
	public function testGetPost($postId) {
		$post = $this->tester->getPost($postId);
		$this->assertObjectHasAttribute('id', $post);
		$this->assertObjectHasAttribute('timestamp', $post);
		$this->assertObjectHasAttribute('title', $post);
		$this->assertObjectHasAttribute('body', $post);
		$this->assertObjectHasAttribute('author', $post);
		$this->assertObjectHasAttribute('summary', $post);
		return $post;
	}

	/**
	 * @depends testGetPost
	 */
	public function testSummaryLength ($post) {
		$body = $post->body;
		$summary = $post->summary;
		$bodyLength = count( explode(' ', $body, 30) );
		if ($bodyLength <= 30)
		{
			$array = explode(' ', $summary);
			$this->assertEquals($bodyLength, count($array) );
		}
		else {
			$array = explode(' ', $summary);
			$this->assertEquals(summaryLength, count($array) );
		}
	}

	/**
	 * @depends testNewPost
	 */
	public function testInsertComment ($postId) {
		$text = 'Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC';
		$commentId = $this->tester->newComment($postId, 'tester', $text);
		$this->assertGreaterThanOrEqual(1, $commentId);
		return $commentId;
	}

	/**
	 *
	 * @depends testNewPost
	 */
	public function testGetComments ($postId) {
		$comments = $this->tester->getComments($postId);
		foreach ($comments as $comment) {
			$this->assertObjectHasAttribute('id', $comment);
			$this->assertObjectHasAttribute('post_id', $comment);
			$this->assertObjectHasAttribute('author', $comment);
			$this->assertObjectHasAttribute('timestamp', $comment);
			$this->assertObjectHasAttribute('body', $comment);
		}
	}

	/**
	 * @expectedException MyException
	 */

	public function testNewPostEmptyError() {
		$this->tester->newPost('', 'author is empty', 'this post wont work');
	}

	/**
	 * @depends testNewPost
	 * @expectedException MyException
	 */
	public function testNewCommentEmptyError ($postId) {
		$this->tester->newComment($postId, '', 'this comment will not work');
		$this->tester->newComment($postId, 'useless commentor: Ravi Shastri', '');
	}
}
?>