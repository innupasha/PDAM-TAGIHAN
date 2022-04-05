<?php
include "database.php";
$que = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
$hsl = mysqli_fetch_array($que);
$timestamp = strtotime($hsl['tgl_pengumuman']);
// menghapus tags html (mencegah serangan jso pada halaman index)
$instansi = strip_tags($hsl['instansi']);
$tahun = strip_tags($hsl['tahun']);
$tgl_pengumuman = strip_tags($hsl['tgl_pengumuman']);
//echo $timestamp;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="Description" content="Aplikasi pengecekan tagihan air pelanggan PDAM TIRTARAJA Kab.OKU">
	<title>Info Tagihan Pelanggan</title>
	<link rel="shortcut icon" href="img/favicon.png">
	<!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
	<link rel="stylesheet" href="css/main.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
	
</head>

<body>
        <div class="flex-center position-ref full-height">
		<div class="content">
			<img src="img/favicon.png" alt="Logo PDAM TIRTARAJA" width="100px" height="100px;">
			<div class="title m-b-md">
				Info Tagihan
			</div>
    
    <div class="container">
		<!-- countdown -->
		<h2>Tambahkan Angka :</h2>
                <marquee><strong>(1) Untuk Wilayah Baturaja</strong>
                <strong>(2) Untuk Wilayah Penyandingan</strong>
                <strong>(3) Untuk Wilayah Lengkayap</strong>
                <strong>(4) Untuk Wilayah Lubuk Batang</strong>
                <strong>(5) Untuk Wilayah Lubuk Raja</strong></marquee>
                <h2>Di Awal Nomor Rekening Anda</h2>
		<hr>
		<div id="clock" class="lead"></div>
		
		<div id="xpengumuman">
		<?php
		if(isset($_POST['submit'])){
			//tampilkan hasil queri jika ada
			$no_pelanggan = stripslashes($_POST['nomor']);
			
			$hasil = mysqli_query($db_conn,"SELECT * FROM un_pelanggan WHERE no_pelanggan='$no_pelanggan'");
			if(mysqli_num_rows($hasil) > 0){
				$data = mysqli_fetch_array($hasil);
				
		?>
			<table class="table table-bordered">
				<tr><td>Nomor Pelanggan</td><td><?= htmlspecialchars($data['no_pelanggan']); ?></td></tr>
				<tr><td>Nama Pelanggan</td><td><?= htmlspecialchars($data['nama']); ?></td></tr>
				<tr><td>Alamat Pelanggan</td><td><?= htmlspecialchars($data['komli']); ?></td></tr>
			</table>
			<table class="table table-bordered">
				<thead>
				<tr>
					<th>Lembar Rekening</th>
					<th>Golongan</th>
					<th>Pemakaian Air (Kubik)</th>
					<th>Tagihan Non Denda</th>
				</tr>
				</thead>
				<tbody>
					
					<td><?= htmlspecialchars($data['n_bin']); ?></td>
					<td><?= htmlspecialchars($data['n_big']); ?></td>
					<td><?= htmlspecialchars($data['n_mat']); ?></td>
					<td><?= htmlspecialchars($data['n_kejuruan']); ?></td>
				</tbody>
			</table>
			
			<?php
			if( $data['status'] == 1 ){
				echo '<div class="alert alert-success" role="alert"><strong>SELAMAT !</strong> Tagihan anda telah LUNAS.</div>';
			} else {
				echo '<div class="alert alert-danger" role="alert"><strong>MAAF !</strong> Tagihan anda BELUM LUNAS.</div>';
			}	
			?>
			
		<?php
			} else {
				echo 'nomor pelanggan yang anda inputkan tidak ditemukan! periksa kembali nomor pelanggan anda.';
				//tampilkan pop-up dan kembali tampilkan form
			}
		} else {
			//tampilkan form input nomor pelanggan
		?>
              
        <form method="post">
            <div class="input-group">
                <input type="text" name="nomor" class="form-control" placeholder="Nomor Pelanggan" required>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="submit">Periksa!</button>
                </span>
            </div>
        </form>
		<?php
		}
		?>
		</div>
    </div><!-- /.container -->
	<footer class="footer">
		<div class="container">
			<p class="text-muted">&copy; <?= $tahun; ?> &middot; Tim IT <?= $instansi; ?></p>
		</div>
	</footer> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/jquery.ripples-min.js"></script>
	<script src="js/ripple.js"></script>
</body>
</html>