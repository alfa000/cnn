<?php
include '../koneksi.php';
$id=mysqli_escape_string($con,$_GET['id']);
$q=mysqli_query($con, "SELECT *,count(barcode) as stok FROM barang WHERE barang.kode_barang='".$id."'") or die(mysqli_error($con));
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
  $gambar     =$_POST['serial']."-".$nama_gambar;
  $path     = "foto/".$gambar;
  
if (empty($nama_gambar)) {
  $q=mysqli_query($con,"UPDATE `barang` SET `nama_barang`='".$_POST['nama']."',`kondisi`='".$_POST['kondisi']."',`tempat`='".$_POST['tempat']."' WHERE kode_barang='".$_POST['kode']."'");
  $qs=mysqli_query($con,"UPDATE `stok` SET `stok`='".$_POST['stok']."' WHERE sn='".$_POST['serial']."'");
  
  if ($q) {
      echo "<script>alert('Data Berhasil Edit');window.location='barang_sn.php';</script>";
  }
  else{
      echo "<script>alert('Barang Dengan ID($id2) Sudah Ada');window.location='edit_barang.php';</script>";
  }
}
else{    
    unlink("foto/".$data->foto);
    if (move_uploaded_file($tmp_file, $path)){
      $q=mysqli_query($con,"UPDATE `barang` SET `nama_barang`='".$_POST['nama']."',`kondisi`='".$_POST['kondisi']."',`tempat`='".$_POST['tempat']."',`foto`='$gambar' WHERE sn='".$_POST['serial']."'");
      $qs=mysqli_query($con,"UPDATE `stok` SET `stok`='".$_POST['stok']."' WHERE kode='".$_POST['kode']."'");
      if ($q && $qs) {
          echo "<script>alert('Data Berhasil Edit');window.location='barang_sn.php';</script>";
      }
      else{
          echo "<script>alert('Barang Dengan ID($id2) Sudah Ada');</script>";
      }
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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
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
        Data Barang <small><?=@$data->kode_barang?></small>
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
              <h3 class="box-title">Detail Barang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <table width="100%">
                  <tr>
                    <td><label>Barcode </label><td>
                    <td>:</td>
                    <td><?=@$data->kode_barang?></td>
                  </tr>
                  <tr>
                    <td><label>Nama Barang </label><td>
                    <td>:</td>
                    <td><?=@$data->nama_barang?></td>
                  </tr>
                  <tr>
                    <td><label>Kondisi Barang </label><td>
                    <td>:</td>
                    <td><?=@$data->kondisi?></td>
                  </tr>
                  <tr>
                    <td><label>Tempat </label><td>
                    <td>:</td>
                    <td><?=@$data->tempat?></td>
                  </tr>
                  <tr>
                    <td><label>Stok </label><td>
                    <td>:</td>
                    <td><?=@$data->stok?></td>
                  </tr>
                </table>
                </div>
              </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border"> 
              <h3 class="box-title">Satuan Barang</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
              <div class="box-body table-responsive ">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Tempat</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                        $q=mysqli_query($con,"SELECT *FROM barang WHERE kode_barang='$id'") or die(mysqli_error($con));
                        $no="1";
                        while ($data=mysqli_fetch_object($q)) {
                      ?>
                        <tr>
                          <td style="vertical-align: middle;"><?= $no ?></td>
                          <td style="vertical-align: middle;"><?= $data->barcode ?></td>
                          <td style="vertical-align: middle;"><?= $data->kondisi ?></td>
                          <td style="vertical-align: middle;"><?= $data->tempat ?></td>
                          <td style="vertical-align: middle;">
                            <a href="view_barang.php?id=<?=$data->kode_barang?>" class="btn btn-primary"><i class="fa fa-print"></i>Print Barcode</a>&nbsp;&nbsp;
                            <a href="edit_barang.php?id=<?=$data->kode_barang?>" class="btn btn-warning"><i class="fa fa-edit"></i>Edit</a>&nbsp;&nbsp;
                            <a href="barang_stok.php?id=<?=$data->kode_barang?>"class="btn btn-danger"><i class="fa fa-trash-o"></i>Hapus</a>&nbsp;&nbsp;
                          </td>  
                        </tr>
                       <?php
                        $no++;                                       
                        }
                      ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
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
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
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
