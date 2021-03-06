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
            <h1 class="m-0 text-dark">Data Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Admin</li>
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
            <form method="post" action="page_admin.php">
              <div class="form-groups">
                <input type="text" name="Search" class="form-control" style="width: 20%; float: left; margin-right: 1%;" placeholder="Nama Admin...">
                <input type="submit" name="btn_search" value="Search" class="btn btn-primary">
              </div>
            </form>
          </p>
          <table class="table table-striped">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>NoTelp</th>
              <th>Email</th>
              <th>Level</th>
              <th>Action</th>
            </tr>
            <?php 
              $no = 1;

              if(isset($_POST['btn_search'])){
                $Search = $_POST['Search'];
                $sql = "SELECT * FROM tbadmin WHERE Nama LIKE '%$Search%'";
              }else{
                $sql = "SELECT * FROM tbadmin";
              }
              $query = $conn->query($sql);
              while ($data = $query->fetch_array()) { 
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['Nama']; ?></td>
              <td><?= $data['NoTelp']; ?></td>
              <td><?= $data['Email']; ?></td>
              <td><?= $data['LEVEL']; ?></td>
              <td>
                <a href="page_admin.php?id=<?= $data['IdAdmin']; ?>"><button class="btn btn-success">Update</button></a> || 
                <?php 
                  if($_SESSION['IdAdmin'] == $data['IdAdmin']){
                ?>
                  <a href="proses/proses_admin.php?id=<?= $data['IdAdmin']; ?>" onClick="return valDelete()"><button class="btn btn-danger" disabled="disabled">Delete</button></a>
                <?php }else{ ?>
                  <a href="proses/proses_admin.php?id=<?= $data['IdAdmin']; ?>" onClick="return valDelete()"><button class="btn btn-danger">Delete</button></a>
                <?php } ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="proses/proses_admin.php">
          <div class="form-groups">
            <label>Nama</label>
            <input type="text" name="Nama" class="form-control" required>
          </div>
          <div class="form-groups">
            <label>Email</label>
            <input type="text" name="Email" class="form-control" placeholder="example@mail.com" required>
          </div>
          <div class="form-groups">
            <label>No Telepon</label>
            <input type="text" name="NoTelp" class="form-control" required>
          </div>
          <div class="form-groups">
            <label>Password</label>
            <input type="password" name="Password" class="form-control" required>
          </div>
          <div class="form-groups">
            <label>Level</label>
            <select name="Level" class="form-control">
              <option value="1">Super Admin</option>
              <option value="2">Petugas</option>
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

<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
          $IdAdmin = $_GET['id'];
          $sql = "SELECT * FROM tbadmin WHERE IdAdmin ='$IdAdmin'";
          $query = $conn->query($sql);

          while ($edata = $query->fetch_array()) {
        ?>
        <form method="post" action="proses/proses_admin.php">
          <input type="hidden" name="IdAdmin" class="form-control" value="<?= $edata['IdAdmin'] ?>">
          <div class="form-groups">
            <label>Nama</label>
            <input type="text" name="Nama" class="form-control" value="<?= $edata['Nama'] ?>" required>
          </div>
          <div class="form-groups">
            <label>Email</label>
            <input type="text" name="Email" class="form-control" placeholder="example@mail.com" value="<?= $edata['Email'] ?>" required>
          </div>
          <div class="form-groups">
            <label>No Telepon</label>
            <input type="text" name="NoTelp" class="form-control" value="<?= $edata['NoTelp'] ?>" required>
          </div>
          <div class="form-groups">
            <label>Password</label>
            <input type="text" name="Password" class="form-control" value="<?= $edata['PASSWORD'] ?>" required>
          </div>
          <div class="form-groups">
            <label>Level</label>
            <select name="Level" class="form-control">
              <?php 
                if($edata['LEVEL'] == "1"){
                  echo "<option value='1' selected>Super Admin</option>"; 
                  echo "<option value='2'>Petugas</option>";
                }else{
                  echo "<option value='1'>Super Admin</option>"; 
                  echo "<option value='2' selected>Petugas</option>";
                }
              ?>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <input type="submit" name="btn" value="Update" class="btn btn-primary">
        </form>
        <?php } ?>
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
