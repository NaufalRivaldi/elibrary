<?php 
	include_once "../session.php";
	include_once "../confiq.php";

	$NamaKategori = $_POST['NamaKategori'];
	$Keterangan = $_POST['Keterangan'];

	$btn = $_POST['btn'];
	switch ($btn) {
		case 'Simpan':
			$sql = "INSERT INTO tbkategoribuku VALUES('','$NamaKategori','$Keterangan')";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_kategori_buku.php");
			}else{
				header("location:".linkhome."page_kategori_buku.php");
			}
			break;

		case 'Update':
			$KdKategori = $_POST['KdKategori'];
			$sql = "UPDATE tbkategoribuku SET NamaKategori = '$NamaKategori', Keterangan = '$Keterangan' WHERE KdKategori = '$KdKategori'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_kategori_buku.php");
			}else{
				header("location:".linkhome."page_kategori_buku.php");
			}
			break;
		
		default:
			$KdKategori = $_GET['id'];
			$sql = "DELETE FROM tbkategoribuku WHERE KdKategori = '$KdKategori'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_kategori_buku.php");
			}else{
				header("location:".linkhome."page_kategori_buku.php");
			}
			break;
	}
?>