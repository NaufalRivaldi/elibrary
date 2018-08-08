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
            <h1 class="m-0 text-dark">Data Peminjaman</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Peminjaman</li>
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
            <a href="#" data-toggle="modal" data-target="#TambahModal">
              <button class="btn btn-success">
                <i class="fa fa-plus-circle"></i> Tambah Data
              </button>
            </a>
            <form method="post" action="page_pinjam.php">
              <div class="form-groups">
                <input type="text" name="Search" class="form-control" style="width: 20%; float: left; margin-right: 1%;" placeholder="Nama Peminjam...">
                <input type="submit" name="btn_search" value="Search" class="btn btn-primary">
              </div>
            </form>
          </p>
          <table class="table table-striped">
            <tr>
              <th>No</th>
              <th>No Peminjaman</th>
              <th>Nama Anggota</th>
              <th>Nama Buku</th>
              <th>Tgl Pinjam</th>
              <th>Lama Pinjam(hari)</th>
              <th>Tgl Kembali</th>
              <th>Deskripsi</th>
              <th>Action</th>
            </tr>
            <?php 
              $no = 1;

              if(isset($_POST['btn_search'])){
                $Search = $_POST['Search'];
                $sql = "
                  SELECT tbpinjam.NoPinjam,
                          tbanggota.Nama,
                          tbbuku.JudulBuku,
                          tbpinjam.TglPinjam,
                          tbpinjam.LamaPinjam,
                          tbpinjam.TglKembali,
                          tbpinjam.Deskripsi
                  FROM tbpinjam 
                  INNER JOIN tbanggota ON tbpinjam.IdAnggota = tbanggota.IdAnggota 
                  INNER JOIN tbbuku ON tbpinjam.KdBuku = tbbuku.KdBuku 
                  WHERE tbanggota.Nama LIKE '%$Search%' ORDER BY tbpinjam.Deskripsi DESC
                ";
              }else{
                $sql = "
                  SELECT tbpinjam.NoPinjam,
                          tbanggota.Nama,
                          tbbuku.JudulBuku,
                          tbpinjam.TglPinjam,
                          tbpinjam.LamaPinjam,
                          tbpinjam.TglKembali,
                          tbpinjam.Deskripsi
                  FROM tbpinjam 
                  INNER JOIN tbanggota ON tbpinjam.IdAnggota = tbanggota.IdAnggota 
                  INNER JOIN tbbuku ON tbpinjam.KdBuku = tbbuku.KdBuku ORDER BY tbpinjam.Deskripsi DESC
                ";
              }
              $query = $conn->query($sql);
              while ($data = $query->fetch_array()) { 
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['0']; ?></td>
              <td><?= $data['1']; ?></td>
              <td><?= $data['2']; ?></td>
              <td><?= $data['3']; ?></td>
              <td><?= $data['4']; ?> Hari</td>
              <td><?= $data['5']; ?></td>
              <td><?= $data['6']; ?></td>
              <td>
                <a href="proses/detail_pinjam.php?id=<?= $data['0']; ?>"><button class="btn btn-success">Print</button></a><br><br>
                <a href="proses/proses_pinjam.php?id=<?= $data['0']; ?>" onClick="return valDelete()"><button class="btn btn-danger">Hapus</button></a>
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

<!-- Modal -->
<div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Peminjaman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="proses/proses_pinjam.php">
          <div class="form-groups">
            <label>Nama Anggota</label>
            <select name="IdAnggota" class="form-control" required>
              <option value="">Pilih Anggota</option>
              <?php 
                $sql = "SELECT IdAnggota, Nama FROM tbanggota ORDER BY IdAnggota ASC";
                $query = $conn->query($sql);
                while ($data = $query->fetch_array()) {
              ?>
                <option value="<?= $data[0]; ?>"><?= $data[0]; ?> - <?= $data[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-groups">
            <label>Nama Buku</label>
            <select name="KdBuku" class="form-control" required>
              <option value="">Pilih Buku</option>
              <?php 
                $sql = "SELECT KdBuku, JudulBuku FROM tbbuku ORDER BY KdBuku ASC";
                $query = $conn->query($sql);
                while ($data = $query->fetch_array()) {
              ?>
                <option value="<?= $data[0]; ?>"><?= $data[0]; ?> - <?= $data[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-groups">
            <label>Lama Pinjam</label>
            <select name="LamaPinjam" class="form-control" required>
              <option value="">Lama Pinjaman (Hari)</option>
              <option value="1">1 Hari</option>
              <option value="2">2 Hari</option>
              <option value="3">3 Hari</option>
              <option value="4">4 Hari</option>
              <option value="5">5 Hari</option>
              <option value="6">6 Hari</option>
              <option value="7">7 Hari</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="btn" value="Simpan" class="btn btn-primary">
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->

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