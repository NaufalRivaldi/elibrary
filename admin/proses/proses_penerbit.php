<?php 
	include_once "../session.php";
	include_once "../confiq.php";

	$NamaPenerbit = $_POST['NamaPenerbit'];
	$Alamat = $_POST['Alamat'];

	$btn = $_POST['btn'];
	switch ($btn) {
		case 'Simpan':
			$sql = "INSERT INTO tbpenerbit VALUES('','$NamaPenerbit','$Alamat')";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_penerbit.php");
			}else{
				header("location:".linkhome."page_penerbit.php");
			}
			break;

		case 'Update':
			$KdPenerbit = $_POST['KdPenerbit'];
			$sql = "UPDATE tbpenerbit SET NamaPenerbit = '$NamaPenerbit', Alamat = '$Alamat' WHERE KdPenerbit = '$KdPenerbit'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_penerbit.php");
			}else{
				header("location:".linkhome."page_penerbit.php");
			}
			break;
		
		default:
			$KdPenerbit = $_GET['id'];
			$sql = "DELETE FROM tbpenerbit WHERE KdPenerbit = '$KdPenerbit'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_penerbit.php");
			}else{
				header("location:".linkhome."page_penerbit.php");
			}
			break;
	}
?>