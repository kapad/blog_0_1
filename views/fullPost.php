<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo htmlentities($post->title); ?>
</title>
<link rel="stylesheet" type="text/css" href="/blog_0_1/bootstrap/docs/assets/css/bootstrap.css" />
</head>
<body>
	<div class="container">
		<div class="row span12 page-header">
			<h1>Rohan's blog</h1>
		</div>
		<div class="row span12">
			<p>
				<a href="index.php?op=all">Back to all posts</a>
			</p>
			<h2>
				<?php echo htmlentities($post->title); ?>
			</h2>
			<p>
				<a href="index?op=edit&id=<?php echo $post->id; ?>">Edit post</a>
			</p>
			<p><small>
				Posted by
				<?php echo htmlentities($post->author); ?>
				at
				<?php echo htmlentities($post->timestamp); ?>
			</small></p>
			<p class = "well">
				<?php echo htmlentities($post->body);?>
			</p>
		</div>
		<div class="row span12">
			<h3>Comments</h3>
			<?php foreach ($comments as $comment) {?>
			<div class="row span8 well">
				<p>
					comment by
					<?php echo htmlentities($comment->author); ?>
					at
					<?php echo htmlentities($comment->timestamp); ?>
				</p>
				<p class = "span8">
					<?php echo htmlentities($comment->body); ?>
				</p>
			</div>
			<?php } //ending foreach loop?>
		</div>
		<div class="row span4">
			<p>
				<a href="index?op=addComment&id=<?php echo $post->id; ?>">Add a comment</a>
			</p>
		</div>
	</div>
</body>
</html>
