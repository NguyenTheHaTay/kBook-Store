<?php
include "dbconnect.php";
session_start();
	if(!isset($_POST['submit'])){
		echo "Có lỗi xảy ra!";
		exit;
	}
	


	$name = trim($_POST['name']);
	$pass = trim($_POST['pass']);

	if($name == "" || $pass == ""){
		echo "Tên đăng nhập hoặc mật khẩu rỗng!";
		exit;
	}

	$name = mysqli_real_escape_string($con, $name);
	$pass = mysqli_real_escape_string($con, $pass);
	$pass = sha1($pass);

	// get from db
	$query = "SELECT name, pass from admin";
	$result = mysqli_query($con, $query);
	if(!$result){
		echo "Empty data " . mysqli_error($con);
		exit;
	}
	$row = mysqli_fetch_assoc($result);

	if($name != $row['name'] && $pass != $row['pass']){
		echo "Tên đăng nhập hoặc mật khẩu không chính xác!";
		$_SESSION['admin'] = false;
		exit;
	}

	if(isset($con)) {mysqli_close($con);}
	$_SESSION['admin'] = true;
	header("Location: insert.html");
?>