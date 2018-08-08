<?php 
	include_once "../session.php";
	include_once "../confiq.php";

	$IdAnggota = $_POST['IdAnggota'];
	$KdBuku = $_POST['KdBuku'];
	$TglPinjam = date('Y-m-d');
	$LamaPinjam = $_POST['LamaPinjam'];
	$TglKembali = date('Y-m-d', strtotime('+'.$LamaPinjam.' days', strtotime($TglPinjam)));


	$btn = $_POST['btn'];
	switch ($btn) {
		case 'Simpan':
			if(minStock($conn, $KdBuku)){
				$sql = "INSERT INTO tbpinjam VALUES('','$IdAnggota','$KdBuku','$TglPinjam','$LamaPinjam','$TglKembali', 'Pinjam')";
				$query = $conn->query($sql);

				if($query){
					header("location:".linkhome."page_pinjam.php");
				}else{
					header("location:".linkhome."page_pinjam.php");
				}
			}else{
				echo "alert('Stock Buku Kosong!'); location.href='page_pinjam.php'";
			}
			
			break;
		
		default:
			$NoPinjam = $_GET['id'];
			plusStock($conn, $NoPinjam);
			$sql = "DELETE FROM tbpinjam WHERE NoPinjam = '$NoPinjam'";
			$query = $conn->query($sql);
			if($query){
				header("location:".linkhome."page_pinjam.php");
			}else{
				header("location:".linkhome."page_pinjam.php");
			}
			break;
	}
?>