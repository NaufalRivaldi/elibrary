<?php 
  session_start();
  include_once "confiq.php";

  $error = 0;

  if(isset($_POST['btn'])){
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $sql = "SELECT * FROM tbadmin WHERE Email = '$Email' AND PASSWORD = '$Password'";
    $query = $conn->query($sql);
    $row = $query->num_rows;
    
    if($row > 0){
      $data = $query->fetch_array();
      $_SESSION['nama'] = $data['Nama'];
      $_SESSION['level'] = $data['LEVEL'];
      $_SESSION['IdAdmin'] = $data['IdAdmin'];
      header("location:index.php");
    }else{
      //header("location:login.php");
      $error = 1;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>SIE-LI</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="dist/css/style.css" rel="stylesheet">
    <link href="dist/img/AdminLTELogo.png" rel="icon">
  </head>
  <body>
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="login-form">
        <img src="dist/img/icon.jpg" width="50%">
        <div class="login">
          <fieldset>
            <legend>SIE-LI</legend>
            <?php 
              if($error > 0){
                echo "<div class=\"alert alert-danger\" role=\"alert\">Login Gagal! Pastikan Data Inputan Benar.</div>";
              }
            ?>
            <form method="post" action="login.php">
              <div class="form-groups">
                <label>Email</label>
                <input type="text" name="Email" class="form-control" required>
              </div>
              <div class="form-groups">
                <label>Password</label>
                <input type="password" name="Password" class="form-control" required>
              </div><br>
              <div class="form-groups">
                <input type="submit" name="btn" class="btn btn-primary btn-block">
              </div><br>
              <p class="text-center"><strong>Copyright &copy; 2018 <a href="login.php">SIE-LI</a>.</strong>
    All rights reserved.</p>
            </form>
          </fieldset>
        </div>
      </div>
    </div>
    <div class="col-md-4"></div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>