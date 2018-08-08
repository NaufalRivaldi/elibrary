<?php 
	session_start();
	if(empty($_SESSION['nama'])){
		header("location:login.php");
	}else{
		$NamaAdmin = $_SESSION['nama'];
		$Level = $_SESSION['level'];
	}
?>