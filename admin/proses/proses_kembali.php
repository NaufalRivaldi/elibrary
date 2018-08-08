<?php 
	include_once "../session.php";
	include_once "../confiq.php";

	$NoPinjam = $_POST['NoPinjam'];
	$TglKembali = $_POST['TglKembali'];
	$HariTerlambat = $_POST['HariTerlambat'];
	$Denda = $_POST['Denda'];


	$btn = $_POST['btn'];
	switch ($btn) {
		case 'Kembali':
			plusStock($conn, $NoPinjam);
			upPinjam($conn, $NoPinjam);
			$sql = "INSERT INTO tbkembali VALUES('','$NoPinjam','$TglKembali','$HariTerlambat','$Denda')";
			$query = $conn->query($sql);

			if($query){
				header("location:".linkhome."page_kembali.php");
			}else{
				header("location:".linkhome."page_kembali.php");
			}
			
			break;
		
		default:
			$IdKembali = $_GET['id'];
			plusStock($conn, $NoPinjam);
			$sql = "DELETE FROM tbkembali WHERE IdKembali = '$IdKembali'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_kembali.php");
			}else{
				header("location:".linkhome."page_kembali.php");
			}
			break;
	}
?>