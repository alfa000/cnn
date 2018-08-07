<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Input Data Karyawan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <link rel="icon" type="image/png" href="../ico.png">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php 
  include 'header.php';
  include '../koneksi.php';
   ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>Nama Karyawan</th>
                  <th>No HP</th>
                  <th>Alamat</th>
                  <th>Agama</th>
                  <th>Jenis Kelamin</th>                  
                  <th>Foto</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                        $q=mysqli_query($con,"SELECT * FROM user WHERE level='User'") or die(mysqli_error($con));
                        $no="1";
                        while ($data=mysqli_fetch_object($q)) {
                      ?>
                        <tr>
                          <td style="vertical-align: middle;"><?= $no ?></td>
                          <td style="vertical-align: middle;"><?= $data->id_user ?></td>
                          <td style="vertical-align: middle;"><?= $data->nama  ?></td>
                          <td style="vertical-align: middle;"><?= $data->no_hp ?></td>
                          <td style="vertical-align: middle;"><?= $data->alamat ?></td>
                          <td style="vertical-align: middle;"><?= $data->agama ?></td>
                          <td style="vertical-align: middle;"><?= $data->jenis_kelamin ?></td>
                          <td style="vertical-align: middle;"><img src="foto/<?= $data->foto ?>" width="100px" ></td>
                          <td style="vertical-align: middle;"><a href="edit_karyawan.php?id=<?=$data->id_user?>"><i class="fa fa-edit"></i>Edit</a><br>
                          <a href="karyawan.php?hps=<?=$data->id_user?>"><i class="fa fa-trash-o"></i>Hapus</a></td>  
                        </tr>
                       <?php
                        $no++;                                       
                        }
                      ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
  include 'footer.php';
   ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
<?php
if (isset($_GET['hps'])) {

$id=mysqli_escape_string($con,$_GET['hps']);
  $h=mysqli_query($con, "SELECT * FROM user WHERE `id_user` = '$id'") or die(mysqli_error($con));
$data=mysqli_fetch_object($h);
if ($h) {
  if (file_exists("foto/".$data->foto)) {
    unlink("foto/".$data->foto);
    $q=mysqli_query($con, "DELETE FROM `user` WHERE `user`.`id_user` = '$id'") or die(mysqli_error($con));
    if ($q) {
        echo "<script>alert('Data Berhasil Dihapus');window.location='karyawan.php';</script>";
    }
  }
  else{
    $q=mysqli_query($con, "DELETE FROM `user` WHERE `user`.`id_user` = '$id'") or die(mysqli_error($con));
    if ($q) {
        echo "<script>alert('Data Berhasil Dihapus');window.location='karyawan.php';</script>";
    }
  }
}
else{
  echo "<script>alert('Data Gagal Dihapus');window.location='karyawan.php';</script>";
}
}

?>