<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>test</title>
</head>
<body>
	<p>
	<?php 
		session_start();
		echo $_SESSION['schoolnum'];
	?>登陆成功</p>
	<a href="unset.php">注销</a>
</body>
</html>