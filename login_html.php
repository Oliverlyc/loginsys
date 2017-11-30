<?php
session_start();
if(!empty($_COOKIE['schoolnum']) && !is_null($_COOKIE['schoolnum'])){
	$_SESSION['schoolnum'] = $_COOKIE['schoolnum'];
	header('location:http://localhost/login/result.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>登录</title>
</head>
<body>
	
		<form action="login.php" method="post">
		<label>
			<div style="display: block;">学号:<input type="text" name="schoolnum"></div>
		</label>
		<label>
			<div style="display: block;">密码:<input type="password" name="pwd"></div>
		</label>
			<div>自动登录<input type="checkbox" name="auto_login"></div>
			<div><input type="submit" name="" value="登录"></div>
		</form>
	
</body>
</html>