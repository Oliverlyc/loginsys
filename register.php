<?php
session_start(); 
header("Content-type:text/html;charset=utf-8");
	include "func.inc.php";
	$json_string = file_get_contents('config.json');
	$data = json_decode($json_string,true);
	$link = mysqli_connect($data['ip'],$data['name'],$data['pwd'],$data['basename']);
	//global $list ;
	$table = $data['table'];
	mysqli_set_charset($link,'utf8');
	if (!$link) {
		die("连接失败").mysqli_connect_error();
	}
	else{
		$schoolnum = $_POST['schoolnum'];
		$pwd = sha1($_POST['pwd']);
		$pwd_2 = sha1($_POST['pwd_2']);
		
		if ($pwd == 'da39a3ee5e6b4b0d3255bfef95601890afd80709') {
			echo "<script>alert('请输入密码');location='register.html';</script>";
		}
		else{
			if ($pwd != $pwd_2) {
				echo "<script>alert('两次输入密码不一致');location='register.html'</script>";
			}
			else{
				if (judge_exist($link,$schoolnum,$list)) {
					echo "<script>alert('学号已存在');location='register.html';</script>";
				}
				else{
					if (insert($link,$list,$schoolnum,$pwd)) {
						echo "<script>alert('注册成功');</script>";
						header("location:login.php");
						$_SESSION['flag'] = 1;
						$_SESSION['schoolnum'] = $schoolnum;
						$_SESSION['pwd'] = $pwd;
						mysqli_close();
					}
				}
			}
		}
	}
session_destroy();
 ?>