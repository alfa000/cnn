<?php
include "../koneksi.php";
$pk=mysqli_query($con,"SELECT max(id_user) as id FROM user") or die(mysqli_error($con));
$data=mysqli_fetch_array($pk);
$no=(int) substr($data['id'], 1,4);
$no++;
$idkar="K".sprintf("%04s",$no);

if (isset($_POST['submit'])) {
  $nama         =$_POST['nama'];
  $password      =$_POST['pw'];
  $alamat       =$_POST['alamat'];
  $agama        =$_POST['agama'];
  $nohp         =$_POST['nohp'];
  $jk           =$_POST['jk'];
  $nama_gambar  =$_FILES['gambar']['name'];
  $tmp_file     =$_FILES['gambar']['tmp_name'];
  $gambar       =$idkar."-".$nama_gambar;
  $path         = "foto/".$gambar;

  if (move_uploaded_file($tmp_file, $path)) {
    $q=mysqli_query($con,"INSERT INTO `user` (`id_user`, `nama`, password, `alamat`,agama, `no_hp`,jenis_kelamin, `foto`, level) VALUES ('$idkar', '$nama', md5('$password'), '$alamat','$agama','$nohp','$jk','$gambar', 'User')") or die(mysqli_error($con)) ;
    if ($q) {
        echo "<script>alert('Data Berhasil Disimpan');window.location='karyawan.php';</script>";
    }
    else{
        echo "<script>alert('Data Gagal Disimpan');</script>";
    }
  }
  else{
      echo "<script>alert('Gambar Gagal Disimpan');history.go(-1);</script>";
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Input Karyawan</title>
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
        Form karyawan
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="from_karyawan.php">Input</a></li>
        <li class="active">karyawan</li>
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
              <h3 class="box-title">Input karyawan Baru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="" method="post"  enctype="multipart/form-data" role="form">
              <div class="box-body">
                <label>ID :</label>
                <input class="form-control" type="text" name="id" placeholder="Masukan ID Karyawan" value="<?= $idkar ?>" required readonly><br>
                <div class="col-md-12">
                <label>Nama karyawan :</label>
                <input class="form-control" type="text" name="nama" placeholder="Masukan Nama Karyawan" required><br>
                </div>
                <div class="col-md-12">
                <label>Password :</label>
                <input class="form-control" type="password" name="pw" placeholder="Masukan Password" required><br>
                </div>
                <div class="col-md-12">
                <label>Alamat:</label>
                <textarea class="form-control" name="alamat" placeholder="Kota/Provinsi/Kecamatan/Kelurahan/RT/RW" rows="8"></textarea><br>
                </div>
                <div class="col-md-6">
                <label>Agama :</label>
                <select class="form-control select2" name="agama" required>
                <option value="">Agama</option>
                <option value="islam">Islam</option>
                <option value="kristen">Kristen</option>
                <option value="katolik">Katolik</option>
                <option value="hindu">Hindu</option>
                <option value="buddha">Buddha</option>
                <option value="konghucu">Konghucu</option> 
                </select><br><br>
                </div>
                <div class="col-md-6">
                <label>No HP :</label>
                <input class="form-control" type="number" name="nohp" placeholder="Masukan No hp" required><br>
                </div>
                <div class="form-group">
                <div class="col-md-2">
                <label>Jenis Kelamin :</label>
                </div>
                <div class="col-md-4">
                  <p><input type="radio" name="jk" class="flat-red" value="Laki-laki" required> Laki-laki 
                  <br>             
                <div class="com-md-4">             
                  <input type="radio" name="jk" class=" flat-red" value="Perempuan" required>  Perempuan               
                </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Gambar :</label>
                  <input type="file" name="gambar" id="exampleInputFile">
                </div>
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
