<?php
include '../koneksi.php';
$id=mysqli_escape_string($con,$_GET['id']);
$q=mysqli_query($con, "SELECT * FROM barang,stok WHERE barang.kode_barang='".$id."' and barang.kode_barang=stok.kode_barang") or die(mysqli_error($con));
$data=mysqli_fetch_object($q);
if (@$data->kondisi="baik") {
  $baik="selected";
  $rusak="";
}else{
  $baik="";
  $rusak="selected";
}
if (isset($_POST['submit'])) {

  $nama_gambar  =$_FILES['gambar']['name'];
  $tmp_file   =$_FILES['gambar']['tmp_name'];
  $gambar     =$_POST['kode']."-".$nama_gambar;
  $path     = "foto/".$gambar;
  
if (empty($nama_gambar)) {
  $q=mysqli_query($con,"UPDATE `barang` SET `nama_barang`='".$_POST['nama']."',`kondisi`='".$_POST['kondisi']."',`tempat`='".$_POST['tempat']."' WHERE kode_barang='".$_POST['kode']."'");
  $qs=mysqli_query($con,"UPDATE `stok` SET `stok`='".$_POST['stok']."' WHERE kode_barang='".$_POST['kode']."'");
  
  if ($q) {
      echo "<script>alert('Data Berhasil Edit');window.location='barang.php';</script>";
  }
  else{
      echo "<script>alert('Guru Dengan ID($id2) Sudah Ada');window.location='edit_barang.php';</script>";
  }
}
else{
  if (file_exists("foto/".$data->foto)) {      
    unlink("foto/".$data->foto);
    if (move_uploaded_file($tmp_file, $path)){
      $q=mysqli_query($con,"UPDATE `barang` SET `kode_barang`='".$_POST['kode']."',`sn`='".$_POST['serial']."',`nama_barang`='".$_POST['nama']."',`kondisi`='".$_POST['kondisi']."',`tempat`='".$_POST['tempat']."',`foto`='$gambar' WHERE kode_barang='".$_POST['kode']."'");
      $qs=mysqli_query($con,"UPDATE `stok` SET `stok`='".$_POST['stok']."' WHERE kode_barang='".$_POST['kode']."'");
      if ($q && $qs) {
          echo "<script>alert('Data Berhasil Edit');window.location='barang.php';</script>";
      }
      else{
          echo "<script>alert('Guru Dengan ID($id2) Sudah Ada');window.location='edit_barang.php';</script>";
      }
    }
  }
  else{
    echo "<script>alert('Gambar Gagal Diedit');window.location='edit_barang.php';</script>";
  }
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Input Barang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../font.css">
    <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.css">
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
  <style type="text/css">
    input:break-after: {
      box-shadow: 2px 2px 2px aqua;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php
include "header.php";
?>

  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Barang
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="from_Barang.php">Input</a></li>
        <li class="active">Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border"> 
              <h3 class="box-title">Edit Data Barang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="post"  enctype="multipart/form-data" role="form">
              <div class="box-body">
                <label>Kode Barang :</label>
                <input class="form-control" type="text" name="kode" readonly="" value="<?=@$data->kode_barang?>" required><br>
                <div class="col-md-6">
                <label>Nama Barang :</label>
                <input class="form-control" type="text" name="nama" placeholder="Masukan Nama Barang" value="<?=@$data->nama_barang?>" required><br>
                </div>
                <div class="col-md-6">
                <label>Serial Number Barang:</label>
                <input class="form-control" type="text" name="serial" placeholder="Masukan Serial Number Barang" value="<?=@$data->sn?>" required><br>
                </div>
                <div class="col-md-6">
                <label>Kondisi Barang :</label>
                <select class="form-control select2" name="kondisi" required>
                <option value="">Pilih Kondisi barang</option>
                <option value="Baik" <?=$baik?>>Baik</option>
                <option value="Rusak"<?=$rusak?>>Rusak</option> 
                </select><br><br>
                </div>
                <div class="col-md-6">
                <label>Tempat Barang:</label>
                <input class="form-control" type="text" name="tempat" placeholder="Tempat Barang" value="<?=@$data->tempat?>" required><br>
                </div>
                <div class="col-md-6">
                <label>Stok Barang :</label>
                <input class="form-control" type="number" name="stok" placeholder="Masukan Stok Barang" value="<?=@$data->stok?>" min="0" required><br>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Gambar :</label>
                  <input type="file" name="gambar" id="exampleInputFile">
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" class="minimal" required> Check me out
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              <div class="col-md-1">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              </div>
              <div class="col-md-6">
                <button type="reset" class="btn btn-primary" style="background-color: coral; border-color: white;">Reset</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
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
<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
</body>
</html>
