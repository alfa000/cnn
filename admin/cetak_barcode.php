<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		if (isset($_GET['barcode'])) {
	?>
			<img alt="<?=$_GET['barcode']?>" src="../barcode.php?text=<?=$_GET['barcode']?>&print=true" />
	<?php
		}
		if (isset($_GET['id'])) {
			include '../koneksi.php';
			$q=mysqli_query($con,"SELECT * FROM barang WHERE kode_barang='".$_GET['id']."'");
			while ($data=mysqli_fetch_object($q)) {
	?>
			<img alt="<?=$_GET['barcode']?>" src="../barcode.php?text=<?=$data->barcode?>&print=true" />		
	<?php
			}
		}
	 ?>
</body>
<script type="text/javascript">
	window.print();
</script>
</html>