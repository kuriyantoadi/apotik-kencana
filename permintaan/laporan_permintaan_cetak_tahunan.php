<?php 
session_start();
if ($_SESSION['status'] != "admin") {
    header("location:login.php?pesan=belum_login");
}

		// koneksi database
        include('../koneksi.php');
		// $bulan = htmlspecialchars($_POST['bulan']);
		$tahun = htmlspecialchars($_POST['tahun']);

		if (empty($tahun) || !is_numeric($tahun)) {
			echo "<script>alert('Bulan tidak valid'); window.history.back();</script>";
			exit();
		}

		// Query untuk memeriksa data berdasarkan tahun
		$cek_data = mysqli_query($koneksi, "SELECT * FROM `tb_permintaan_obat` 
											WHERE YEAR(STR_TO_DATE(`tgl_permintaan_obat`, '%d-%m-%Y')) = $tahun;");

		// Periksa jumlah baris hasil query
		if (mysqli_num_rows($cek_data) == 0) {
			echo "<script>alert('Data Laporan Obat Kosong'); window.history.back();</script>";
			exit();
		} 

?>

	<title>Export Data Ke Excel</title>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
	}
	.back {
		text-decoration: none;
		color: white;
		background: red;
		border-radius: 10px;
		padding: 8px 10px;
		margin: 10px;
	}
	.export {
		text-decoration: none;
		color: white;
		background: blue;
		border-radius: 10px;
		padding: 8px 10px;
	}
	</style>

<?php 
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan permintaan tahunan.xls");
?>

	<table id="tabel_js" class="table table-primary">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Obat</th>                                                                                              
				<th>Jumlah Permintaan</th>                                               
				<th>Tanggal Permintaan</th>
				<th>Status</th>
			</tr>
		</thead>
    
		<tbody>
			<?php 
			include '../koneksi.php';
			$no = 1;
			$data = mysqli_query($koneksi, "SELECT * FROM `tb_permintaan_obat`,`tb_obat` 
											WHERE YEAR(STR_TO_DATE(`tgl_permintaan_obat`, '%d-%m-%Y')) = $tahun AND tb_permintaan_obat.id_obat=tb_obat.id_obat");
			while ($d = mysqli_fetch_array($data)) {
			?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $d['nama_obat'] ?></td>                                              
				<td><?= $d['jumlah_permintaan_obat'] ?></td>
				<td><?= $d['tgl_permintaan_obat'] ?></td>
				<td><?= $d['status_permintaan_obat'] ?></td>
			</tr>
			<?php 
			}
			?>
    	</tbody>
	</table>
</body>