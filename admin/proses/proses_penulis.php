<?php 
	include_once "../session.php";
	include_once "../confiq.php";

	$NamaPenulis = $_POST['NamaPenulis'];
	$Profile = $_POST['Profile'];

	$btn = $_POST['btn'];
	switch ($btn) {
		case 'Simpan':
			$sql = "INSERT INTO tbpenulis VALUES('','$NamaPenulis','$Profile')";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_penulis.php");
			}else{
				header("location:".linkhome."page_penulis.php");
			}
			break;

		case 'Update':
			$KdPenulis = $_POST['KdPenulis'];
			$sql = "UPDATE tbpenulis SET NamaPenulis = '$NamaPenulis', Profile = '$Profile' WHERE KdPenulis = '$KdPenulis'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_penulis.php");
			}else{
				header("location:".linkhome."page_penulis.php");
			}
			break;
		
		default:
			$KdPenulis = $_GET['id'];
			$sql = "DELETE FROM tbpenulis WHERE KdPenulis = '$KdPenulis'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_penulis.php");
			}else{
				header("location:".linkhome."page_penulis.php");
			}
			break;
	}
?>