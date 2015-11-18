<?php
try {
	
	$objDb = new PDO('mysql:host=localhost;dbname=comments', 'root', 'password');
	$objDb->exec('SET CHARACTER SET utf8');
	
	$sql = "SELECT *
			FROM `comments`
			ORDER BY `date` ASC";
	$statement = $objDb->query($sql);
	$comments = $statement->fetchAll(PDO::FETCH_ASSOC);
	
} catch(Exception $e) {
	echo 'There was a problem with the database';
	echo $e->getMessage();
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit record on text click and update on blur</title>
<meta name="description" content="Edit record on text click and update on blur">
<meta name="keywords" content="Edit record on text click and update on blur">
<meta name="author" content="SSD Tutorials">
<link rel="stylesheet" href="/css/core.css" media="all" type="text/css">
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>

<div id="wrapper">

	<?php if (!empty($comments)) { ?>
		
		<?php foreach($comments as $row) { ?>
			
			<div class="item">
				<span class="edit">
					<?php echo htmlentities(stripslashes($row['full_name']), ENT_QUOTES, 'UTF-8'); ?>
				</span>
				<div class="dn">
					<input type="text" name="full_name" 
						id="full_name" 
						value="<?php echo $row['full_name']; ?>" 
						data-id="<?php echo $row['id']; ?>"
						class="field updateBlur" />									<img src="/images/processing.gif"
						alt="Processing"
						width="56" height="7"
						class="processing" />
					<a href="#" class="close">Close</a>
				</div>
			</div>
			
			<div class="item">
				<span class="edit">
					<?php echo htmlentities(stripslashes($row['comment']), ENT_QUOTES, 'UTF-8'); ?>
				</span>
				<div class="dn">
					<textarea name="comment" id="comment"
					class="area updateBlur"
					data-id="<?php echo $row['id']; ?>"><?php echo $row['comment']; ?></textarea>
					<img src="/images/processing.gif"
						alt="Processing"
						width="56" height="7"
						class="processing" />
					<a href="#" class="close">Close</a>
				</div>
			</div>
			
		<?php } ?>
		
	<?php } ?>

</div>

<script src="/js/jquery-1.7.1.min.js"></script>
<script src="/js/core.js"></script>
</body>
</html>








