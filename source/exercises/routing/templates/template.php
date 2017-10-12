<!DOCTYPE html>
<html>
<head>
    <title>PHP / MySQL II</title>
	<link rel="stylesheet" href="./templates/style.css" type="text/css" />
</head>
<body>
	<div id="page">
		<div id="logo">
			<h1><a href="/" id="logoLink">PHP / MYSQL II</a></h1>
		</div>
		<div id="nav">
			<ul>
				<li><a href="./">Home</a></li>
				<li><a href="?page=about">About</a></li>
			</ul>	
		</div>
		<div id="content">
			<h2><?php echo $title; ?></h2>
			<p><?php echo $description; ?></p>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>