<?php 
	function judge_exist($link,$schoolnum,$table){
		$search = "SELECT * FROM `{$table}` WHERE schoolnum=?";
		$stmt = mysqli_prepare($link,$search);//准备一条sql语句
		mysqli_stmt_bind_param($stmt,'s',$schoolnum);//绑定参数
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($result);
		if ($schoolnum == $row['schoolnum']) {
			return 1;
		}
		else{
			return 0;
		}
	}
	function insert($link,$table,$schoolnum,$pwd){
		$sql = "INSERT INTO {$table}(schoolnum,pwd) VALUES (?,?)";
		$stmt = mysqli_prepare($link,$sql);
		mysqli_stmt_bind_param($stmt,'ss',$schoolnum,$pwd);
		$result = mysqli_stmt_execute($stmt);
		if ($result != FALSE) {
			return 1;
		}else{
			return 0;
		}
	}
	function login($link,$schoolnum,$pwd,$table){
		$sql = "SELECT `schoolnum`,`pwd` FROM {$table} WHERE schoolnum = ? AND pwd = ?";
		$stmt = mysqli_prepare($link,$sql);
		mysqli_stmt_bind_param($stmt,'ss',$schoolnum,$pwd);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($result);
		if ($schoolnum != $row['schoolnum']) {
			return 2;
		}
		else{
			if ($pwd != $row['pwd']) {
				return 0;
			}
			else{
				return 1;
			}
		}
	}
 ?>