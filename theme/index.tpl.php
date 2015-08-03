<!doctype html>
<html lang="<?=$lang?>">
	<head>
		<meta charset="<?=$charset?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=get_title($title)?></title>
		<?php if (isset($favicon)): ?><link rel="shortcut icon" href="<?=$favicon?>" /><?php endif; ?>
		<?php foreach ($stylesheets as $theStylesheet) : ?>
			<link rel="stylesheet" type="text/css" href="<?=$theStylesheet?>" />
		<?php endforeach; ?>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div id="header"><?=$header?></div>
		<div id="main"><?=$main?></div>
		<div id="footer"><?=$footer?></div>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	</body>
</html>