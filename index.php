<?php 
session_start();
if (isset($_SESSION['admin'])) {
  header('location:admin/index.php');
}else if (isset($_SESSION['user'])) {
  header('location:user/index.php');
}

if (isset($_POST['submit'])) {
  include 'koneksi.php';
  $id=mysqli_escape_string($con, $_POST['id']);
  $pw=mysqli_escape_string($con, $_POST['pw']);
  $q=mysqli_query($con,"SELECT * FROM user WHERE id_user='$id' and password=md5('$pw')") or die(mysqli_error($q));
  $a=mysqli_fetch_object($q);
  if (mysqli_num_rows($q)==1 && $a->level=="Admin") {
      $_SESSION['admin']=$a->id_user;
      $_SESSION['level']=$a->level;
      $_SESSION['nama']=$a->nama;
      $_SESSION['foto']=$a->foto;
      echo "<script>alert('Selamat Datang $a->nama');window.location='admin/index.php';</script>";
    }
  elseif (mysqli_num_rows($q)==1 && $a->level=="User") {
      $_SESSION['user']=$a->id_user;
      $_SESSION['level']=$a->level;
      $_SESSION['nama']=$a->nama;
      $_SESSION['foto']=$a->foto;
      echo "<script>alert('Selamat Datang $a->nama');window.location='user/index.php';</script>";
    }
  else{
      echo "<script>alert('ID Atau Password Salah');</script>";
  }
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <link rel="icon" type="image/png" href="ico.png">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="ID" name="id">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="pw">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>           
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
