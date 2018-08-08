<!-- Brand Logo -->
<a href="index.html" class="brand-link">
  <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
       style="opacity: .8">
  <span class="brand-text font-weight-light">SIE-LI</span>
</a>

<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block"><?= $NamaAdmin; ?></a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-pie-chart"></i>
          <p>
            Data
            <i class="right fa fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <?php 
          if($_SESSION['level'] == 1){
          ?>
          <li class="nav-item">
            <a href="page_admin.php" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Admin</p>
            </a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a href="page_anggota.php" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Anggota</p>
            </a>
          </li>
        </ul>
      </li>
      <?php 
      if($_SESSION['level'] == 1){
      ?>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-edit"></i>
          <p>
            Kelola Buku
            <i class="fa fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="page_penerbit.php" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Penerbit</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="page_penulis.php" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Penulis</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="page_kategori_buku.php" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Kategori Buku</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="page_buku.php" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Buku</p>
            </a>
          </li>
        </ul>
      </li>
      <?php } ?>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-table"></i>
          <p>
            Transaksi
            <i class="fa fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="page_pinjam.php" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Peminjaman</p>
            </a>
          </li>
        </ul>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="page_kembali.php" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Pengembalian</p>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>