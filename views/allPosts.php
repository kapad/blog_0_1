<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Rohan's blog</title>
<link rel="stylesheet" type="text/css" href="/blog_0_1/bootstrap/docs/assets/css/bootstrap.css" />
</head>
<body>
	<div class="container">
		<div class="row span12 page-header">
			<h1>Rohan's blog</h1>
		</div>
		<div class="row">
			<div class="span2">
				<a href="index?op=newPost" class="btn btn-primary">Make a new post</a>
			</div>
			<!-- 		<div class = "row span10"> </div> -->
			<div class="span8">
				<?php 
				foreach ($posts as $post) {
					?>
				<div class="well">
					<h3>
						<a href="index?op=view&id=<?php echo $post->id; ?>"><?php echo htmlentities($post->title); ?> </a>
					</h3>
					<!-- 					<p>Post summary:</p> -->
					<p>
						<small> Posted by <?php echo htmlentities($post->author); ?> at <?php echo htmlentities($post->timestamp); ?>
						</small>
					</p>
					<p>
						<?php echo htmlentities($post->summary); ?>
						<a href="index?op=view&id=<?php echo $post->id; ?>">more</a>
					</p>
				</div>
				<?php }// ending foreach?>
			</div>
		</div>
	</div>
</body>
</html>
