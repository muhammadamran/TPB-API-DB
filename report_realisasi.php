<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
	<div class="page-title-css">
		<div>
			<h1 class="page-header-css">
				<i class="fas fa-desktop icon-page"></i>
				<font class="text-page">Laporan Realisasi</font>
			</h1>
			<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item active">Laporan Realisasi</li>
            </ol>
		</div>
		<div>
			<button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('h:m:i a') ?></font></span></button>
		</div>
	</div>
	<div class="line-page"></div>
	<!-- Begin Row -->
	<style>
		.row-choose {
			display: flex;
			margin-top: 30px;
			margin-bottom: 30px;
			justify-content: center;
		}

		.class-utama {
			padding: 10px;
		}

		.class-one {
			background: #fff;
			border-radius: 5px;
		}

		.class-one:hover {
			box-shadow: 0 5px 25px rgb(0 0 0 / 30%)
		}

		.show-choose {
			position: relative;
		}

		.image {
			display: block;
			width: 100%;
			height: auto;
		}

		.overlay {
			position: absolute;
			bottom: 100%;
			left: 0;
			right: 0;
			background-color: #6d7479e0;
			overflow: hidden;
			width: 100%;
			height:0;
			transition: .5s ease;
			border-radius: 5px;
		}

		.show-choose:hover .overlay {
			bottom: 0;
			height: 100%;
		}

		.text {
			color: white;
			font-size: 20px;
			font-weight: 700;
			position: absolute;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			text-align: center;
		}


		@media (max-width: 992.5px) {
			.row-choose {
				display: grid;
			}
		}
	</style>
	<div class="row-choose">
		<!-- begin col-3 -->
		<!-- 1 -->
		<a href="#modal-lihat-daftar-mitra" class="class-utama" data-toggle="modal" title="Lihat Daftar Mitra">
			<div class="class-one">
				<div class="show-choose">
				  <img src="assets/img/svg/realisasi_e.svg" alt="Cari Laporan Realisasi" class="image" width="100%">
				  <div class="overlay">
				    <div class="text">Lihat Daftar Mitra</div>
				  </div>
				</div>
			</div>
		</a>
		<!-- Modal Lihat Daftar Mitra -->
		<div class="modal fade" id="modal-lihat-daftar-mitra">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <form action="adm_hak_akses.php" method="POST">
		                <div class="modal-header">
		                    <h4 class="modal-title">[Laporan Realisasi] Lihat Daftar Mitra</h4>
		                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		                </div>
		                <div class="modal-body">
		                    <div class="table-responsive">
		                        <table class="table table-striped table-bordered table-td-valign-middle">
		                            <thead>
		                                <tr>
		                                    <th width="1%">#</th>
		                                    <th class="text-nowrap" style="text-align: center;">NPWP</th>
		                                    <th class="text-nowrap" style="text-align: center;">Nama Mitra</th>
		                                    <th class="text-nowrap" style="text-align: center;">Alamat</th>
		                                    <th class="text-nowrap" style="text-align: center;">No. SKEP</th>
		                                    <th class="text-nowrap" style="text-align: center;">API</th>
		                                    <th class="text-nowrap" style="text-align: center;">Status</th>
		                                    <!-- <th class="text-nowrap">Aksi</th> -->
		                                </tr>
		                            </thead>
		                            <tbody>
		                                <?php
		                                $dataTable = $dbcon->query("SELECT * FROM referensi_pengusaha AS a
		                                                            LEFT JOIN referensi_status_pengusaha AS b ON a.KODE_ID=b.KODE_STATUS_PENGUSAHA ORDER BY a.ID DESC");
		                                if (mysqli_num_rows($dataTable) > 0) {
		                                    $no = 0;
		                                    while ($row = mysqli_fetch_array($dataTable)) {
		                                        $no++;
		                                        ?>
		                                        <tr class="odd gradeX">
		                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
		                                            <td style="text-align: left;">
		                                                <?php if ($row['NPWP'] == NULL || $row['NPWP'] == '') { ?>
		                                                     <center><font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font></center>
		                                                <?php } else { ?>
		                                                    <?= $row['NPWP'] ?>
		                                                <?php } ?>
		                                            </td>
		                                            <td style="text-align: left;">
		                                                <?php if ($row['NAMA'] == NULL || $row['NAMA'] == '') { ?>
		                                                     <center><font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font></center>
		                                                <?php } else { ?>
		                                                    <?= $row['NAMA'] ?>
		                                                <?php } ?>
		                                            </td>
		                                            <td style="text-align: left;">
		                                                <?php if ($row['ALAMAT'] == NULL || $row['ALAMAT'] == '') { ?>
		                                                    <center><font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font></center>
		                                                <?php } else { ?>
		                                                	 <?= $row['ALAMAT'] ?>
		                                                <?php } ?>
		                                            </td>
		                                            <td style="text-align: left;">
		                                                <?php if ($row['NOMOR_SKEP'] == NULL || $row['NOMOR_SKEP'] == '') { ?>
		                                                     <center><font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font></center>
		                                                <?php } else { ?>
		                                                    <?= $row['NOMOR_SKEP'] ?>
		                                                <?php } ?>
		                                            </td>
		                                            <td style="text-align: left;">
		                                                <?php if ($row['STATUS_IMPORTIR'] == NULL || $row['STATUS_IMPORTIR'] == '') { ?>
		                                                     <center><font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font></center>
		                                                <?php } else { ?>
		                                                    <?= $row['STATUS_IMPORTIR'] ?>
		                                                <?php } ?>
		                                            </td>
		                                            <td style="text-align: left;">
		                                                <?php if ($row['URAIAN_STATUS_PENGUSAHA'] == NULL || $row['URAIAN_STATUS_PENGUSAHA'] == '') { ?>
		                                                     <center><font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font></center>
		                                                <?php } else { ?>
		                                                    <?= $row['URAIAN_STATUS_PENGUSAHA'] ?>
		                                                <?php } ?>
		                                            </td>
		                                        </tr>
		                                    <?php } ?>
		                                <?php } else { ?>
		                                    <tr>
		                                        <td colspan="10">
		                                            <center>
		                                                <div style="display: grid;">
		                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
		                                                </div>
		                                            </center>
		                                        </td>
		                                    </tr>
		                                <?php } ?>
		                            </tbody>
		                        </table>
		                    </div>
		                </div>
		                <div class="modal-footer">
		                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>
		<!-- End Modal Lihat Daftar Mitra -->
		<!-- End 1 -->
		<!-- 2 -->
		<!-- <a href="report_realisasi_all_mitra.php?TahunAju=<?= date('Y');?>" target="_blank" class="class-utama"> -->
		<!-- <form action="report_realisasi_all_mitra.php" method="GET" class="class-utama">
		<a href="report_realisasi_all_mitra.php" target="_blank">
			<input type="hidden" name="session" value="<?= $_SESSION['username'] ?>">
			<button type="submit" name="find_" style="border-color: transparent;">
			<div class="class-one">
				<div class="show-choose">
				  <img src="assets/img/svg/realisasi_d.svg" alt="Cari Laporan Realisasi" class="image" width="100%">
				  <div class="overlay">
				    <div class="text">Laporan Realisasi Semua Mitra</div>
				  </div>
				</div>
			</div>
			</button>
		</a>
		</form> -->
		<!-- End 2 -->
		<!-- 3 -->
		<a href="#modal-laporan-realisasi-per-mitra" class="class-utama" data-toggle="modal" title="Laporan Realisasi Per Mitra">
			<div class="class-one">
				<div class="show-choose">
				  <img src="assets/img/svg/realisasi_a.svg" alt="Laporan Realisasi Semua Mitra" class="image" width="100%">
				  <div class="overlay">
				    <div class="text">Laporan Realisasi Per Mitra</div>
				  </div>
				</div>
			</div>
		</a>
		<div class="modal fade" id="modal-laporan-realisasi-per-mitra">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <form action="report_realisasi_per_mitra.php" target="_blank" method="GET">
		                <div class="modal-header">
		                    <h4 class="modal-title">[Laporan Realisasi] Lihat Daftar Per Mitra</h4>
		                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		                </div>
		                <div class="modal-body">
		                    <div class="row" style="display: grid;justify-content: center;align-items: center;">
		                    	<div class="col-12">
		                    		<img src="assets/img/svg/realisasi_a.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="50%">
		                    	</div>
		                    </div>
		                    <hr>
		                    <div class="row">
		                    	<div class="col-xl-6">
	                                <div class="form-group">
			                    		<select type="text" class="default-select2 form-control" name="NameMitra" id="IDMitra">
	                                        <option value="">-- Pilih Mitra --</option>
	                                        <?php
	                                        $resultMitraOKE = $dbcon->query("SELECT ID,NPWP,NAMA FROM referensi_pengusaha WHERE NAMA IS NOT NULL AND NAMA !='' ORDER BY NAMA ASC");
	                                        foreach ($resultMitraOKE as $RowMitraOKE) {
	                                        ?>
	                                            <option value="<?= $RowMitraOKE['ID'] ?>"><?= $RowMitraOKE['NPWP'] ?> - <?= $RowMitraOKE['NAMA'] ?></option>
	                                        <?php } ?>
	                                    </select>
			                    	</div>
		                    	</div>
		                    	<div class="col-xl-6">
	                                <div class="form-group">
			                    		<select type="text" class="default-select2 form-control" name="TahunAju" id="IDTahunAjuMitra">
	                                        <option value="">-- Pilih Tahun --</option>
	                                        <?php
	                                        for($i=date('Y'); $i>=date('Y')-32; $i-=1) {
	                                            echo "<option value='$i'> $i </option>";
	                                            }
	                                        ?>
	                                    </select>
			                    	</div>
		                    	</div>
		                    	<input type="hidden" name="me" value="<?= $_SESSION['username'] ?>">
		                    </div>
		                </div>
		                <div class="modal-footer">
		                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
		                    <button type="submit" name="find_" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>
		<!-- End 3 -->
		<!-- 4 -->
		<a href="#modal-laporan-realisasi-per-tahun" class="class-utama" data-toggle="modal" title="Laporan Realisasi Mitra Per Tahun">
			<div class="class-one">
				<div class="show-choose">
				  <img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="100%">
				  <div class="overlay">
				    <div class="text">Laporan Realisasi Mitra Per Tahun</div>
				  </div>
				</div>
			</div>
		</a>
		<!-- Modal Lihat Daftar Mitra -->
		<div class="modal fade" id="modal-laporan-realisasi-per-tahun">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <form action="report_realisasi_per_tahun.php" target="_blank" method="GET">
		                <div class="modal-header">
		                    <h4 class="modal-title">[Laporan Realisasi] Lihat Daftar Mitra Per Tahun</h4>
		                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		                </div>
		                <div class="modal-body">
		                    <div class="row" style="display: grid;justify-content: center;align-items: center;">
		                    	<div class="col-12">
		                    		<img src="assets/img/svg/realisasi_b.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="50%">
		                    	</div>
		                    </div>
		                    <hr>
		                    <div class="row">
		                    	<div class="col-xl-12">
	                                <div class="form-group">
			                    		<select type="text" class="default-select2 form-control" name="TahunAju" id="IDTahunAju" required>
	                                        <option value="">-- Pilih Tahun --</option>
	                                        <?php
	                                        for($i=date('Y'); $i>=date('Y')-32; $i-=1) {
	                                            echo "<option value='$i'> $i </option>";
	                                            }
	                                        ?>
	                                    </select>
			                    	</div>
		                    	</div>
		                    	<input type="hidden" name="me" value="<?= $_SESSION['username'] ?>">
		                    </div>
		                </div>
		                <div class="modal-footer">
		                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
		                    <button type="submit" name="find_TahunAju" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
		                    <!-- <a href="report_realisasi_per_tahun.php?TahunAju=<?= $_POST['TahunAju']?>" class="btn btn-primary"><i class="fas fa-search"></i> Cari</a> -->
		                </div>
		            </form>
		        </div>
		    </div>
		</div>
		<!-- End Modal Lihat Daftar Mitra -->
		<!-- End 4 -->
		<!-- end col-3 -->
	</div>
	<!-- End Begin Row -->
	<?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php 
// include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
include "include/jsForm.php";
?>