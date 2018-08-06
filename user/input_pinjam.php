<?php 
  include '../koneksi.php';
  $td = date('dmY');
  $pk=mysqli_query($con,"SELECT max(kode_pinjam) as kode FROM pinjam") or die(mysqli_error($con));
  $data=mysqli_fetch_array($pk);
  $no=(int) substr($data['kode'], 8,7);
  $no++;
  $kodepinjam=$td.sprintf("%07s",$no);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Advanced form elements</title>
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
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
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
if (isset($_POST['submit'])) {
  $qtmp=mysqli_query($con,"SELECT * FROM barangtmp WHERE kode_pinjam='".$_SESSION['idpinjam']."'");
  $no=1;
  while ($tmp=mysqli_fetch_object($qtmp)) {
    $jumlah=$_POST['jumlah'.$no];
    $qpinjam=mysqli_query($con,"INSERT INTO `pinjam`(`kode_pinjam`, `kode_barang`, `id_user`, `jumlah`, `w_pinjam`, `kep`, `status`) VALUES ('".$_POST['kode']."','".$tmp->kode_barang."','".$_POST['id_user']."','".$jumlah."','".$_POST['waktu']."','".$_POST['kep']."','Dipinjam')") or die(mysqli_error($con));
    $stok=mysqli_query($con,"UPDATE barang SET stok=stok-".$jumlah." WHERE kode_barang='".$tmp->kode_barang."'") or die(mysqli_error($con));
    $hapus=mysqli_query($con,"DELETE FROM `barangtmp` WHERE kode_pinjam='".$tmp->kode_pinjam."' AND kode_barang='".$tmp->kode_barang."'");
  $no++;
  }
  if ($qpinjam && $stok && $hapus) {
    unset($_SESSION['idpinjam']);
    unset($_SESSION['karyawan']);
    echo "<script>alert('Data Berhasil Disimpan');window.location='data_pinjam.php';</script>";
  }
  else{
      echo "<script>alert('Data Gagal Disimpan');</script>";
    }
}
if (isset($_GET['a'])) {
  unset($_SESSION['idpinjam']);
  unset($_SESSION['karyawan']);
}
if (isset($_GET['hps'])) {
  $qhapus=mysqli_query($con, "DELETE FROM `barangtmp` WHERE kode_pinjam='".$_GET['hps']."' AND kode_barang='".$_GET['bar']."'");
}
   ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div id="get_user" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pilih User</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Advanced Form Elements
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="../#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Peminjaman</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <form action="" method="post"  enctype="multipart/form-data" role="form">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <label>Kode Peminjaman:</label>
              <input class="form-control" type="text" name="kode" required readonly="" value="<?= $kodepinjam ?>"><br>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>ID Karyawan</label><br>
                  <input class="form-control" type="text" name="id_user" required readonly="" value="<?=$_SESSION['user']?>">
              </div>
            </div>
            <div class="col-md-6">
              <label>Waktu Pinjam :</label>
              <input class="form-control" type="text" name="waktu" placeholder="Masukan Nama Karyawan" required value="<?= date('Y-m-d H:i:s');?>" readonly>
            </div>
    <div class="col-md-12">
              <a href="get_barang.php" class="btn btn-primary">Pilih <B></B>Barang</a><br>
            </div>
        <div class="col-xs-12">
            <div class="box-body table-responsive ">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Kondisi</th>
                  <th>Jumlah</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $_SESSION['idpinjam']=$kodepinjam;
                        $q=mysqli_query($con,"SELECT * FROM barangtmp WHERE kode_pinjam='".$_SESSION['idpinjam']."'") or die(mysqli_error($con));
                        $no="1";
                        if (mysqli_num_rows($q)>=1) {
                          while ($data=mysqli_fetch_object($q)) {
                          $max=mysqli_query($con,"SELECT stok FROM barang where kode_barang='$data->kode_barang'") or die(mysqli_error($con));
                          $qyt=mysqli_fetch_object($max);
                      ?>
                        <tr>
                          <td style="vertical-align: middle;"><?= $no ?></td>
                          <td style="vertical-align: middle;"><?= $data->kode_barang ?></td>
                          <td style="vertical-align: middle;"><?= $data->nama_barang  ?></td>
                          <td style="vertical-align: middle;"><?= $data->kondisi ?></td>
                          <td style="vertical-align: middle;"><input type="number" name="jumlah<?= $no ?>" max="<?=$qyt->stok?>" min="1" width="auto" required></td>
                          <td style="vertical-align: middle;"><a href="input_pinjam.php?hps=<?=$_SESSION['idpinjam']?>&bar=<?=$data->kode_barang?>"><i class="fa fa-trash-o"></i>Hapus</a></td>  
                        </tr>
                       <?php
                        $no++;                                       
                        }
                        }else{
                         echo "<tr>
                          <td   colspan='6'><marquee>Peminjaman Kosong</marquee></td>
                        </tr>";
                      }
                      ?>
                        
                </tbody>
              </table>
        </div>
        <!-- /.col -->
      </div>
            <div class="col-md-12">
              <label>Keperluan:</label>
              <textarea class="form-control" name="kep" placeholder="Masukan Keperluan" required rows="5"></textarea>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              <a href="input_pinjam.php?a=btl" class="btn btn-warning" name="batal">Batal</a>
            </div>
        </div>
        </form>
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
    include '../footer.php';
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
  function get_user()
    {
      $(‘#get_user’).modal(‘show’);
    }
</script>
</body>
</html>