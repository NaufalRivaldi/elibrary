<?php 
	$conn = mysqli_connect('localhost','root','','db_e_library2');

	//link
	define("linkhome", "http://localhost/webUAS/admin/");

	//function
	function unlinkGambar($dir, $id, $conn){
		$sql = "SELECT GambarBuku FROM tbbuku WHERE KdBuku = '$id'";
		$query = $conn->query($sql);
		$data = $query->fetch_array();

		$loc = $dir.$data[0];
		unlink("$loc");
	}

	function minStock($conn, $KdBuku){
		$sql = "SELECT Jumlah FROM tbbuku WHERE KdBuku = '$KdBuku'";
		$query = $conn->query($sql);
		$stock = $query->fetch_array();
		$min = $stock[0] - 1;
		$sql = "UPDATE tbbuku SET Jumlah = '$min' WHERE KdBuku = '$KdBuku'";
		$conn->query($sql);

		return true;
	}

	function plusStock($conn, $NoPinjam){
		$sql = "SELECT KdBuku FROM tbpinjam WHERE NoPinjam = '$NoPinjam'";
		$query = $conn->query($sql);
		$row = $query->fetch_array();
		$KdBuku = $row[0];
		$sql = "SELECT Jumlah FROM tbbuku WHERE KdBuku = '$KdBuku'";
		$query = $conn->query($sql);
		$stock = $query->fetch_array();
		$plus = $stock[0] + 1;
		$sql = "UPDATE tbbuku SET Jumlah = '$plus' WHERE KdBuku = '$KdBuku'";
		$conn->query($sql);
	}

	function denda($TglKembali){
		$date1= date('Y-m-d');
	  	$date2= $TglKembali;
	  	$datee1 = explode("-", $date1);
	  	$datee2 = explode("-", $date2);

	  	if($datee1[1] == $datee2[1]){
	  		$resday = $datee1[2] - $datee2[2];

	  		if($resday > 0){
	  			$denda = $resday * 2500;
	  		}else{
	  			$denda = 0;
	  		}
	  	}else{
	  		$day1 = $datee1[2];
	  		$day2 = 30 - $datee2[2];
	  		$resday = $day1 + $day2;
	  		$denda = $resday * 2500;
	  	}
	  	
	  	return $denda;
	}

	function hariterlambat($TglKembali){
		$date1= date('Y-m-d');
	  	$date2= $TglKembali;
	  	$datee1 = explode("-", $date1);
	  	$datee2 = explode("-", $date2);

	  	if($datee1[1] == $datee2[1]){
	  		$resday = $datee1[2] - $datee2[2];

	  		if($resday > 0){
	  			$jmlhari = $resday;
	  		}else{
	  			$jmlhari = 0;
	  		}
	  	}else{
	  		$day1 = $datee1[2];
	  		$day2 = 30 - $datee2[2];
	  		$jmlhari = $day1 + $day2;
	  	}
	  	return $jmlhari;
	}

	function upPinjam($conn, $NoPinjam){
		$sql = "UPDATE tbpinjam SET Deskripsi = 'Kembali' WHERE NoPinjam = '$NoPinjam'";
		$conn->query($sql);
	}

	//show qty
	function showanggota($conn){
		$sql = "SELECT * FROM tbanggota";
		$query = $conn->query($sql);
		$row = $query->num_rows;
		echo $row;
	}

	function showadmin($conn){
		$sql = "SELECT * FROM tbadmin";
		$query = $conn->query($sql);
		$row = $query->num_rows;
		echo $row;
	}

	function showbuku($conn){
		$sql = "SELECT * FROM tbbuku";
		$query = $conn->query($sql);
		$row = $query->num_rows;
		echo $row;
	}

	function showpinjam($conn){
		$sql = "SELECT * FROM tbpinjam";
		$query = $conn->query($sql);
		$row = $query->num_rows;
		echo $row;
	}
?>