<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Barang | Data Tables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>  

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
    <section class="content-header">
      <h1>
        Data Barang
      </h1>
      <ol class="breadcrumb">
        <li><a href="../#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive ">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Serial Number</th>
                  <th>Kondisi</th>
                  <th>Tempat</th>
                  <th>Stok</th>
                  <th>Foto</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                        $q=mysqli_query($con,"SELECT * FROM barang,stok WHERE barang.kode_barang=stok.kode_barang and stok.stok!=0") or die(mysqli_error($con));
                        $no="1";
                        while ($data=mysqli_fetch_object($q)) {
                      ?>
                        <tr>
                          <td style="vertical-align: middle;"><?= $no ?></td>
                          <td style="vertical-align: middle;"><?= $data->kode_barang ?></td>
                          <td style="vertical-align: middle;"><?= $data->nama_barang  ?></td>
                          <td style="vertical-align: middle;"><?= $data->sn ?></td>
                          <td style="vertical-align: middle;"><?= $data->kondisi ?></td>
                          <td style="vertical-align: middle;"><?= $data->tempat ?></td>
                          <td style="vertical-align: middle;"><?= $data->stok ?></td>
                          <td style="vertical-align: middle;"><img src="../foto/<?= $data->foto ?>" width="100px" ></td>
                          <td style="vertical-align: middle;"><a href="get_barang.php?id=<?=$data->kode_barang?>" class="btn btn-info"><i class="fa fa-edit"></i>Add</a><br>
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
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
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
  if (isset($_GET['id'])) {
    $barang=mysqli_query($con,"SELECT * FROM barang WHERE kode_barang='".$_GET['id']."'");
    $t=mysqli_fetch_object($barang);
    $in=mysqli_query($con, "INSERT INTO `barangtmp`(`kode_pinjam`,`kode_barang`, `nama_barang`, `kondisi`) VALUES ('".$_SESSION['idpinjam']."','$t->kode_barang','$t->nama_barang','$t->kondisi')");
    if ($in) {
      echo "<script>alert('Data Berhasil Disimpan');window.location='input_pinjam.php';</script>";
    }else{
      echo "<script>alert('Barang Sudah Dipinjam');window.location='input_pinjam.php';</script>";
    }
  }
 ?>