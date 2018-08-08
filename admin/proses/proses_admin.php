<?php 
	include_once "../session.php";
	include_once "../confiq.php";

	$Nama = $_POST['Nama'];
	$Email = $_POST['Email'];
	$NoTelp = $_POST['NoTelp'];
	$Password = $_POST['Password'];
	$Level = $_POST['Level'];

	$btn = $_POST['btn'];
	switch ($btn) {
		case 'Simpan':
			$sql = "INSERT INTO tbadmin VALUES('','$Nama','$NoTelp','$Email','$Password','$Level')";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_admin.php");
			}else{
				header("location:".linkhome."page_admin.php");
			}
			break;

		case 'Update':
			$IdAdmin = $_POST['IdAdmin'];
			$sql = "UPDATE tbadmin SET Nama = '$Nama', NoTelp = '$NoTelp', Email = '$Email', PASSWORD = '$Password', LEVEL = '$Level' WHERE IdAdmin = '$IdAdmin'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_admin.php");
			}else{
				header("location:".linkhome."page_admin.php");
			}
			break;
		
		default:
			$IdAdmin = $_GET['id'];
			$sql = "DELETE FROM tbadmin WHERE IdAdmin = '$IdAdmin'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_admin.php");
			}else{
				header("location:".linkhome."page_admin.php");
			}
			break;
	}
?>