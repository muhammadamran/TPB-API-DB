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
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
	<title>Laporan Realisasi Barang App Name | Company </title>
<?php } else { ?>
	<title>Laporan Realisasi Barang - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
		<?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
	<div class="page-title-css">
		<div>
			<h1 class="page-header-css">
				<i class="fas fa-check-to-slot icon-page"></i>
				<font class="text-page">Laporan Realisasi Barang</font>
			</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Index</a></li>
				<li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
				<li class="breadcrumb-item active">Laporan Realisasi Barang</li>
			</ol>
		</div>
		<div>
			<button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('H:i a') ?></font></span></button>
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
			height: 0;
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
		<a href="adm_kuota.php" target="_blank" class="class-utama" title="Kouta Mitra">
			<div class="class-one">
				<div class="show-choose">
					<img src="assets/img/svg/realisasi_a.svg" alt="Kouta Mitra" class="image" width="100%">
					<div class="overlay">
						<div class="text">Kouta Mitra</div>
					</div>
				</div>
			</div>
		</a>
		<!-- End 1 -->
		<!-- 2 -->
		<a href="dashboard_realisasi.php" target="_blank" class="class-utama" title="Analisis Kouta Mitra">
			<div class="class-one">
				<div class="show-choose">
					<img src="assets/img/svg/design-stats-animate.svg" alt="Analisis Kouta Mitra" class="image" width="100%">
					<div class="overlay">
						<div class="text">Analisis Kouta Mitra</div>
					</div>
				</div>
			</div>
		</a>
		<!-- End 2 -->
		<!-- 3 -->
		<a href="#modal-laporan-realisasi-per-mitra" class="class-utama" data-toggle="modal" title="Laporan Realisasi Per Mitra">
			<div class="class-one">
				<div class="show-choose">
					<img src="assets/img/svg/cohort-analysis-animate.svg" alt="Laporan Realisasi Semua Mitra" class="image" width="100%">
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
									<img src="assets/img/svg/cohort-analysis-animate.svg" alt="Laporan Realisasi Mitra Per Tahun" class="image" width="50%">
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
											for ($i = date('Y'); $i >= date('Y') - 32; $i -= 1) {
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
											for ($i = date('Y'); $i >= date('Y') - 32; $i -= 1) {
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
							<!-- <a href="report_realisasi_per_tahun.php?TahunAju=<?= $_POST['TahunAju'] ?>" class="btn btn-primary"><i class="fas fa-search"></i> Cari</a> -->
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
include "include/panel.php";
include "include/panel.php";
include "include/footer.php";
include "include/jsDatatables.php";
include "include/jsForm.php";
?>