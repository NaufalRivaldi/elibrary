<?php 
	include_once "../session.php";
	include_once "../confiq.php";

	$Nama = $_POST['Nama'];
	$NoTelp = $_POST['NoTelp'];
	$JK = $_POST['JK'];
	$Email = $_POST['Email'];
	$Alamat = $_POST['Alamat'];
	$TglBergabung = $_POST['TglBergabung'];

	$btn = $_POST['btn'];
	switch ($btn) {
		case 'Simpan':
			$sql = "INSERT INTO tbanggota VALUES('','$Nama','$NoTelp','$JK','$Email','$Alamat','$TglBergabung')";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_anggota.php");
			}else{
				header("location:".linkhome."page_anggota.php");
			}
			break;

		case 'Update':
			$IdAnggota = $_POST['IdAnggota'];
			$sql = "UPDATE tbanggota SET Nama = '$Nama', NoTelp = '$NoTelp', JK = '$JK', Email = '$Email', Alamat = '$Alamat', TglBergabung = '$TglBergabung' WHERE IdAnggota = '$IdAnggota'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_anggota.php");
			}else{
				header("location:".linkhome."page_anggota.php");
			}
			break;
		
		default:
			$IdAnggota = $_GET['id'];
			$sql = "DELETE FROM tbanggota WHERE IdAnggota = '$IdAnggota'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_anggota.php");
			}else{
				header("location:".linkhome."page_anggota.php");
			}
			break;
	}
?>