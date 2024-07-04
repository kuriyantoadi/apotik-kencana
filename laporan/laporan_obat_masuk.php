<?php include('../template/header-admin.php') ?>
<?php include('../template/header-admin-menu.php') ?>

		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row">				

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Laporan Obat Masuk</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php include('../alert.php') ?>
                                    <a href="laporan_obat_masuk_cetak_full.php" class="btn btn-primary btn-sm"><i data-feather="plus"></i> Download Full Rekap</a><br><br>
                                    <tr>
                                        <form action="laporan_obat_masuk_cetak_bulanan.php" method="post">
                                        <td>
                                            Bulan
                                            <select name="bulan" id="">
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                            <input type="submit" class="btn btn-primary btn-sm" value="Download" >
                                            </form><br>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <form action="laporan_obat_masuk_cetak_tahunan.php" method="post">
                                        <td>
                                            Tahun
                                            <select name="tahun" id="">
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                            </select>
                                            <input type="submit" class="btn btn-primary btn-sm" value="Download" >
                                            </form><br>
                                        </td>
                                    </tr>                                    
                                    <table id="example" class="display" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Nama Obat</th>
                                                <th class="text-center">Jumlah Obat</th>
                                                <th class="text-center">Opsi</th>
                                            </tr>
                                        </thead>
                                      
                                        <tbody>
                                            <?php 
                                            include '../koneksi.php';
                                            $no = 1;
                                            $data = mysqli_query($koneksi, "SELECT * from tb_obat_masuk, tb_obat, tb_jenis_obat 
                                            where tb_obat_masuk.id_obat=tb_obat.id_obat AND tb_obat.id_jenis_obat=tb_jenis_obat.id_jenis_obat");
                                            while ($d = mysqli_fetch_array($data)) {
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $d['kode_transaksi'] ?></td>
                                                <td><?= date('d M Y', strtotime($d['tgl_obat_masuk'])); ?></td>                                              
                                                <td><?= $d['nama_obat'] ?></td>                                              
                                                <td class="text-center"><?= $d['jumlah_obat'] ?></td>
                                                <td class="text-center">
													<a href="obat_masuk_hapus.php?id_obat_masuk=<?= $d['id_obat_masuk']; ?>" onclick="return confirm('Anda yakin Hapus data jenis obat <?php echo $d['nama_obat']; ?> ?')" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fas fa-trash-alt"></i></a>
                                                    <button data-bs-toggle="modal" data-bs-target="#edit<?= $d['id_obat_masuk']; ?>" id=".$d['id_obat_masuk']." class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></button>
                                                    <button data-bs-toggle="modal" data-bs-target="#detail<?= $d['id_obat_masuk']; ?>" id=".$d['id_obat_masuk']." class="btn btn-info shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></button>
                                                    <?php include('laporan_obat_masuk_modal.php') ?>
                                                </td>

                                            </tr>
                                             <?php } ?>
                                        </tbody>
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					
				</div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

		<?php include('../template/footer.php') ?>
