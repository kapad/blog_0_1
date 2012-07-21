<!DOCTYPE html>
<html>
<head>
<title>Write a new comment</title>
<link rel="stylesheet" type="text/css" href="/blog_0_1/bootstrap/docs/assets/css/bootstrap.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
	<div class="container">
		<div class="row span12 page-header">
			<h1>
				<b>Write a new comment</b>
			</h1>
		</div>
		<?php if($errors) {?>
		<div class="row span12 alert">
			<ul>
				<?php 
				foreach($errors as $error) {
					echo '<li>' . htmlentities($error) . '</li>';
				}
				?>
			</ul>
		</div>
		<?php }?>
		<div class="row span12">
			<form method="POST" action="<?php $_SERVER['REQUEST_URI']; ?>" class="well">
				<label for="author">Author name:</label>
				<br />
				<input type="text" name="author" class = "span4" placeholder="Enter your name..." value="<?php echo htmlentities($author); ?>" />
				<br />
				<label for="body">Your comment:</label>
				<br />
				<textarea rows="5" cols="128" name="body" class = "span8" placeholder="Type your comment here..."><?php echo htmlentities($body); ?></textarea>
				<br />
				<input type="submit" name="submit" value="submit comment" class="btn" />
			</form>
		</div>
	</div>
</body>
</html>
