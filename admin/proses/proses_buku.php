<?php 
	include_once "../session.php";
	include_once "../confiq.php";

	$KdKategori = $_POST['KdKategori'];
	$KdPenerbit = $_POST['KdPenerbit'];
	$KdPenulis = $_POST['KdPenulis'];
	$JudulBuku = $_POST['JudulBuku'];
	$Jumlah = $_POST['Jumlah'];
	$Sinopsis = $_POST['Sinopsis'];
	$Gambar = $_FILES['GambarBuku']['name'];
	$tGambar = $_FILES['GambarBuku']['tmp_name'];

	$dir = "../dist/img/upload/";

	$btn = $_POST['btn'];
	switch ($btn) {
		case 'Simpan':
			$sql = "INSERT INTO tbbuku VALUES('','$KdKategori','$KdPenerbit','$KdPenulis','$JudulBuku','$Jumlah','$Sinopsis','$Gambar')";
			$query = $conn->query($sql);
			if($query){
				$loc = $dir.$Gambar;
				move_uploaded_file($tGambar, $loc);
				header("location:".linkhome."page_buku.php");
			}else{
				header("location:".linkhome."page_buku.php");
			}
			break;

		case 'Update':
			$KdBuku = $_POST['KdBuku'];

			if(empty($Gambar)){
				$sql = "UPDATE tbbuku SET KdKategori = '$KdKategori', KdPenerbit = '$KdPenerbit', KdPenulis = '$KdPenulis', JudulBuku = '$JudulBuku', Jumlah = '$Jumlah', Sinopsis = '$Sinopsis' WHERE KdBuku = '$KdBuku'";	
			}else{
				unlinkGambar($dir, $KdBuku, $conn);
				$loc = $dir.$Gambar;
				move_uploaded_file($tGambar, $loc);
				$sql = "UPDATE tbbuku SET KdKategori = '$KdKategori', KdPenerbit = '$KdPenerbit', KdPenulis = '$KdPenulis', JudulBuku = '$JudulBuku', Jumlah = '$Jumlah', Sinopsis = '$Sinopsis', GambarBuku = '$Gambar' WHERE KdBuku = '$KdBuku'";
			}
			
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_buku.php");
			}else{
				header("location:".linkhome."page_buku.php");
			}
			break;
		
		default:
			$KdBuku = $_GET['id'];
			unlinkGambar($dir, $KdBuku, $conn);
			$sql = "DELETE FROM tbbuku WHERE KdBuku = '$KdBuku'";
			$query = $conn->query($sql);
			
			if($query){
				header("location:".linkhome."page_buku.php");
			}else{
				header("location:".linkhome."page_buku.php");
			}
			break;
	}
?>