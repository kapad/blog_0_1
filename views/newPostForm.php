<!DOCTYPE html>
<html>
<head>
<title>Make a new post</title>
<link rel="stylesheet" type="text/css" href="/blog_0_1/bootstrap/docs/assets/css/bootstrap.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
	<div class="container">
		<div class="row span12 page-header">
			<h1>Make a new post</h1>
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
				<label for="title">Post Title:</label>
				<br />
				<input type="text" name="title" class="span4" placeholder="Enter post title..." value="<?php echo htmlentities($title); ?>" />
				<br />
				<label for="author">Author name:</label>
				<br />
				<input type="text" name="author" class="span4" placeholder="Enter your name..." value="<?php echo htmlentities($author); ?>" />
				<br />
				<label for="body">Your post:</label>
				<br />
				<textarea rows="25" cols="128" name="body" class="span8" placeholder="Type your post here..."><?php echo htmlentities($body); ?></textarea>
				<br />
				<input type="submit" value="submit post" name="submit" />
			</form>
		</div>
	</div>
</body>
</html>
