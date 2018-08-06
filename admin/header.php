<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
  if (empty($_SESSION['admin'])) {
    header('location:../index.php');
  }
 ?>
<header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">CNN</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CNN</b> | <small>Admin</small></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../foto/<?=$_SESSION['foto']?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$_SESSION['nama']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../foto/<?=$_SESSION['foto']?>" class="img-circle" alt="User Image">

                <p>
                  <?=$_SESSION['nama']?>
                  <small><?=$_SESSION['level']?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat" >Sign out</a>
                </div>
              </li>
            </ul>
          </li> 
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../foto/<?=$_SESSION['foto']?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$_SESSION['nama']?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-table"></i> <span>Barang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="barang_sn.php"><i class="fa fa-circle-o"></i> Serial Number</a></li>
            <li><a href="barang_stok.php"><i class="fa fa-circle-o"></i> Stok</a></li>
          </ul>
        </li>
        <li>
          <a href="karyawan.php">
            <i class="fa fa-user"></i> <span>Karyawan</span>
          </a>
        </li>
        <li>
          <a href="">
            <i class="fa fa-edit"></i> <span>Input</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="input_barang.php"><i class="fa fa-circle-o"></i> Barang</a></li>
            <li><a href="input_karyawan.php"><i class="fa fa-circle-o"></i> Karyawan</a></li>
          </ul>
        </li>
        <li>
          <a href="">
            <i class="fa fa-files-o"></i> <span>Peminjaman</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="input_pinjam.php"><i class="fa fa-circle-o"></i> Input Pinjam</a></li>
            <li><a href="pengembalian.php"><i class="fa fa-circle-o"></i> Pengembalian</a></li>
            <li><a href="data_pinjam.php"><i class="fa fa-circle-o"></i> Data Pinjam</a></li>
          </ul>
        </li>
        <li>
          <a href="http://jadwalteknikbandung.ml" target="blank">
            <i class="fa fa-calendar"></i> <span>Jadwal</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>