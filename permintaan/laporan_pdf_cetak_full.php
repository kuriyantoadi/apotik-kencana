<?php 
session_start();
if ($_SESSION['status'] != "admin") {
    header("location:login.php?pesan=belum_login");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Export Data Ke Excel</title>
    <style type="text/css">
        body{
            font-family: sans-serif;
        }
        table{
            margin: 20px auto;
            border-collapse: collapse;
        }
        table th, table td{
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
</head>
<body>
    <h1 style="text-align: center;">Laporan Permintaan Obat</h1>
    <table id="tabel_js" class="table table-primary">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>                                                                                              
            <th>Nama Obat</th>                                            
            <th>Jumlah Permintaan</th>
            <th>Tanggal Permintaan</th>                                             
            <th>Keterangan Apotek</th>
            <th>Keterangan Farmasi</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        include '../koneksi.php';
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * from tb_obat,tb_jenis_obat,tb_permintaan_obat,tb_user where tb_user.id_user=tb_permintaan_obat.id_user AND tb_permintaan_obat.id_obat=tb_obat.id_obat AND tb_obat.id_jenis_obat=tb_jenis_obat.id_jenis_obat");
        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td align="center"><?= $no++ ?></td>
            <td align="center"><?= $d['username'] ?></td>
            <td align="center"><?= $d['nama_obat'] ?></td>                                              
            <td align="center"><?= $d['jumlah_permintaan_obat'] ?></td>
            <td align="center"><?= $d['tgl_permintaan_obat'] ?></td>
            <td align="center"><?= $d['keterangan_apotek'] ?></td>
            <td align="center"><?= $d['keterangan_farmasi'] ?></td>
            <td align="center"><?= $d['status_permintaan_obat'] ?></td>
        </tr>
        <?php 
        }
        ?>
        </tbody>
    </table>
    <script>
		window.print();
	</script>
</body>
</html>