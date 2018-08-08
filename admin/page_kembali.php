<?php 
  include_once "session.php";
  include_once "confiq.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIE-LI | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="dist/css/style.css" rel="stylesheet">
  <link href="dist/img/AdminLTELogo.png" rel="icon">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Beranda</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link">Keluar</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <?php include "pages/sidebar.php" ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Pengembalian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Pengembalian</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="kontenadmin">
          <p>
            <form method="post" action="page_kembali.php">
              <div class="form-groups">
                <input type="text" name="NoPinjam" class="form-control" style="width: 20%; float: left; margin-right: 1%;" placeholder="Nomer Peminjaman">
                <input type="submit" name="btn" value="Cari" class="btn btn-primary">
              </div>
            </form>
          </p>
          <?php 
            if(isset($_POST['NoPinjam'])){
              $NoPinjam = $_POST['NoPinjam'];
              $sql = "
              SELECT tbpinjam.NoPinjam,
                      tbanggota.Nama,
                      tbbuku.JudulBuku,
                      tbpinjam.TglKembali,
                      tbpinjam.LamaPinjam
              FROM tbpinjam 
              INNER JOIN tbanggota ON tbpinjam.IdAnggota = tbanggota.IdAnggota 
              INNER JOIN tbbuku ON tbpinjam.KdBuku = tbbuku.KdBuku 
              WHERE tbpinjam.NoPinjam = '$NoPinjam' && tbpinjam.Deskripsi = 'Pinjam'
              ";
              $query = $conn->query($sql);
              $data = $query->fetch_array();
              $row = $query->num_rows;
          ?>
          <table class="table table-striped">
            <tr>
              <th width="20%">No Peminjaman</th>
              <td width="5%">:</td>
              <td><?= $data['NoPinjam'] ?></td>
            </tr>
            <tr>
              <th>Nama Anggota</th>
              <td>:</td>
              <td><?= $data['Nama'] ?></td>
            </tr>
            <tr>
              <th>Judul Buku</th>
              <td>:</td>
              <td><?= $data['JudulBuku'] ?></td>
            </tr>
            <tr>
              <th>Tanggal Kembali</th>
              <td>:</td>
              <td><?= $data['TglKembali'] ?></td>
            </tr>
          </table>
          <?php 
            $date = date('Y-m-d');
            $TglKembali = $data['TglKembali'];

            if($row > 0){
              if($data['TglKembali'] < $date){
                $denda = denda($TglKembali);

                echo "<div class=\"alert alert-danger\" role=\"alert\">Dikenakan denda dikarenakan melewati batas waktu yg ditentukan. <br>Denda : Rp. ".$denda."</div>";
              }
            }else{
              echo "<div class=\"alert alert-danger\" role=\"alert\">Data Tidak Ditemukan!</div>";
            }
          ?>
          <form method="post" action="proses/proses_kembali.php">
            <input type="hidden" name="NoPinjam" value="<?= $data['NoPinjam']; ?>">
            <input type="hidden" name="TglKembali" value="<?= $date; ?>">
            <input type="hidden" name="HariTerlambat" value="<?= hariterlambat($TglKembali); ?>">
            <input type="hidden" name="Denda" value="<?= denda($TglKembali); ?>">
            <input type="submit" name="btn" value="Kembali" class="btn btn-primary">
          </form>
          <?php } ?>
          <hr>
          <p>
            <form method="post" action="page_kembali.php">
              <div class="form-groups">
                <input type="text" name="Search" class="form-control" style="width: 20%; float: left; margin-right: 1%;" placeholder="No Pinjaman...">
                <input type="submit" name="btn_search" value="Search" class="btn btn-primary">
              </div>
            </form>
          </p>
          <table class="table table-striped">
            <tr>
              <th>No</th>
              <th>No Peminjaman</th>
              <th>Nama Anggota</th>
              <th>Judul Buku</th>
              <th>Tgl kembali</th>
              <th>Hari Terlambat</th>
              <th>Denda</th>
              <th>Action</th>
            </tr>
            <?php 
              $no = 1;

              if(isset($_POST['btn_search'])){
                $Search = $_POST['Search'];
                $sql = "
                  SELECT tbkembali.IdKembali,
                          tbpinjam.NoPinjam,
                          tbanggota.Nama,
                          tbbuku.JudulBuku,
                          tbkembali.TglKembali,
                          tbkembali.HariTerlambat,
                          tbkembali.Denda
                  FROM tbkembali
                  INNER JOIN tbpinjam ON tbkembali.NoPinjam = tbpinjam.NoPinjam
                  INNER JOIN tbbuku ON tbpinjam.KdBuku = tbbuku.KdBuku 
                  INNER JOIN tbanggota ON tbpinjam.IdAnggota = tbanggota.IdAnggota 
                  WHERE tbkembali.NoPinjam LIKE '%$Search%' ORDER BY tbkembali.NoPinjam ASC
                ";
              }else{
                $sql = "
                  SELECT tbkembali.IdKembali,
                          tbpinjam.NoPinjam,
                          tbanggota.Nama,
                          tbbuku.JudulBuku,
                          tbkembali.TglKembali,
                          tbkembali.HariTerlambat,
                          tbkembali.Denda
                  FROM tbkembali
                  INNER JOIN tbpinjam ON tbkembali.NoPinjam = tbpinjam.NoPinjam
                  INNER JOIN tbbuku ON tbpinjam.KdBuku = tbbuku.KdBuku 
                  INNER JOIN tbanggota ON tbpinjam.IdAnggota = tbanggota.IdAnggota 
                  ORDER BY tbkembali.NoPinjam ASC
                ";
              }
              $query = $conn->query($sql);
              while ($data = $query->fetch_array()) { 
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['1']; ?></td>
              <td><?= $data['2']; ?></td>
              <td><?= $data['3']; ?> Hari</td>
              <td><?= $data['4']; ?></td>
              <td><?= $data['5']; ?> Hari</td>
              <td>Rp. <?= $data['6']; ?></td>
              <td>
                <a href="proses/detail_kembali.php?id=<?= $data['0']; ?>"><button class="btn btn-success">Print</button></a> || 
                <a href="proses/proses_kembali.php?id=<?= $data['0']; ?>" onClick="return valDelete()"><button class="btn btn-danger">Delete</button></a>
              </td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2018 <a href="index.php">SIE-LI</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0 - Kelompok 3
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script src="dist/js/validasi.js"></script>
<!-- Modal Edit -->
<?php 
  if(isset($_GET['id'])){
    echo "<script>
    $('#EditModal').modal();
    </script>";
  }
?>
</body>
</html>