<!-- QUERY -->
<?php
include "include/connection.php";
// include "include/restrict.php";
session_start();
// jika session username belum dibuat, atau session username kosong
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // redirect ke halaman sign-in
    header("location:./sign-in.php?NoAccess=true");
    // header("location:../tpb/sign-in.php");
}
$user = $_SESSION['username'];

$dataHeadSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultHeadSetting = mysqli_fetch_array($dataHeadSettting);

$dataSetRealTime = $dbcon->query("SELECT * FROM tbl_realtime ORDER BY id DESC LIMIT 1");
$resultSetRealTime = mysqli_fetch_array($dataSetRealTime);

$SetTime = $resultSetRealTime['reload'];

$CheckForPrivileges = $_SESSION['username'];
$dataForPrivileges = $dbcon->query("SELECT INSERT_DATA,UPDATE_DATA,DELETE_DATA,KIRIM_DATA,UPDATE_PASSWORD FROM view_privileges WHERE USER_NAME='$CheckForPrivileges'");
$resultForPrivileges = mysqli_fetch_array($dataForPrivileges);

$dataGETAJU = $_GET['AJU'];
$DataCK5PLB = $dbcon->query("SELECT * FROM tpb_header WHERE NOMOR_AJU='$dataGETAJU'");
$resultDataCK5PLB = mysqli_fetch_array($DataCK5PLB);
$dataGETAJUID = $resultDataCK5PLB['ID'];

// var_dump($dataGETAJUID);exit;

// KEMASAN 
$DataCK5PLBKemasan = $dbcon->query("SELECT * 
                                    FROM tpb_kemasan AS a
                                    LEFT OUTER JOIN referensi_kemasan AS b ON a.KODE_JENIS_KEMASAN=b.KODE_KEMASAN
                                    WHERE a.ID_HEADER='$dataGETAJUID'");
$resultDataCK5PLBKemasan = mysqli_fetch_array($DataCK5PLBKemasan);

// Cari Nama Kantor Pemasok
$forNamaKantor = $resultDataCK5PLB['KODE_KANTOR'];
// var_dump($query);exit;
$DataNamaKantor = $dbcon->query("SELECT URAIAN_KANTOR FROM referensi_kantor_pabean WHERE KODE_KANTOR='$forNamaKantor'");
$resultDataNamaKantor = mysqli_fetch_array($DataNamaKantor);

// NPPBKC PEMASOK
$forNPPBKCPemasok = $resultDataCK5PLB['NAMA_PENGUSAHA'];
$DataNPPBKCPemasok = $dbcon->query("SELECT NPPBKC FROM tbl_ref_pengusaha WHERE NAMA='$forNPPBKCPemasok' ORDER BY NAMA DESC LIMIT 1");
$resultDataNPPBKCPemasok = mysqli_fetch_array($DataNPPBKCPemasok);

// NPPBKC TUJUAN
$forNPPBKCTujuan = $resultDataCK5PLB['NAMA_PENERIMA_BARANG'];
$DataNPPBKCTujuan = $dbcon->query("SELECT NPPBKC FROM tbl_ref_pengusaha WHERE NAMA='$forNPPBKCTujuan' ORDER BY NAMA DESC LIMIT 1");
$resultDataNPPBKCTujuan = mysqli_fetch_array($DataNPPBKCTujuan);

// Cari Nama Kantor Tujuan
$forNamaKantorTujuan = $resultDataCK5PLB['KODE_KANTOR_TUJUAN'];
$DataNamaKantorTujuan = $dbcon->query("SELECT URAIAN_KANTOR FROM referensi_kantor_pabean WHERE KODE_KANTOR='$forNamaKantorTujuan'");
$resultDataNamaKantorTujuan = mysqli_fetch_array($DataNamaKantorTujuan);

// Cari Tanggal SKEP
$forTanggalSKEP = $resultDataCK5PLB['NOMOR_IJIN_TPB'];
$DataTanggalSKEP = $dbcon->query("SELECT *, SUBSTR(TANGGAL_SKEP,1,10) AS for_tgl_skep FROM referensi_pengusaha WHERE NOMOR_SKEP='$forTanggalSKEP'");
$resultDataTanggalSKEP = mysqli_fetch_array($DataTanggalSKEP);

$YYAJU = SUBSTR($_GET['AJU'], 12, 4);
$MMAJU = SUBSTR($_GET['AJU'], 16, 2);
$DDAJU = SUBSTR($_GET['AJU'], 18, 2);

$DEKLARYYMMDD = $YYAJU . '-' . $MMAJU . '-' . $DDAJU;

// tpb_barang_tarif
$DataCK5PLB = $dbcon->query("SELECT * FROM tpb_barang_tarif WHERE ID_HEADER='$dataGETAJUID' GROUP BY ID_HEADER");
$resultBahanBakuTarif = mysqli_fetch_array($DataCK5PLB);
// DATE
function date_indo($date, $print_day = false)
{
	$day = array(
		1 =>
		'Senin',
		'Selasa',
		'Rabu',
		'Kamis',
		'Jumat',
		'Sabtu',
		'Minggu'
	);
	$month = array(
		1 =>
		'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$split    = explode('-', $date);
	$tgl_indo = $split[2] . ' ' . $month[(int)$split[1]] . ' ' . $split[0];

	if ($print_day) {
		$num = date('N', strtotime($date));
		return $day[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}

function Rupiah($angka)
{
	$hasil = "Rp. " . number_format($angka, 2, ',', '.');
	return $hasil;
}

function decimal($number) {
    $hasil = number_format($number, 0, ",", ",");
    return $hasil;
}

// NPWP
function NPWP($value)
{	
	// 12.345.678.9-012.345
	$hasil = number_format($value, 0, ',','.' );
	return $hasil;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Laporan CK5 Sarinah - Halaman Detail Barang</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<?php if ($resultHeadSetting['icon'] == NULL) { ?>
		<link rel="apple-touch-icon" sizes="180x180" href="assets/images/icon/icon-default.png">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/images/icon/icon-default.png">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/images/icon/icon-default.png">
	<?php } else { ?>
		<link rel="apple-touch-icon" sizes="180x180" href="assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
	<?php } ?>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<link href="assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
	<link href="assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />
	<link href="assets/css/ck5plb.css" rel="stylesheet" />
	<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
	<link href="assets/css/tpb.css" rel="stylesheet" />
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/solid.css" integrity="sha384-DhmF1FmzR9+RBLmbsAts3Sp+i6cZMWQwNTRsew7pO/e4gvzqmzcpAzhDIwllPonQ" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/fontawesome.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous" />
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q66YLEFFZ2"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-Q66YLEFFZ2');
	</script>
</head>
<body>
	<div class="invoice">
		<div class="row" style="display: flex;align-items: center;margin-bottom: -5px;">
			<div class="col-md-3">
				<div style="display: flex;justify-content: center;">
					<?php if ($resultHeadSetting['logo'] == NULL) { ?>
						<img src="assets/images/logo/logo-default.png" width="30%">
					<?php } else { ?>
						<img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
					<?php } ?>
				</div>
			</div>
			<div class="col-md-9">
				<div style="display: grid;justify-content: left;">
					<font style="font-size: 24px;font-weight: 800;">LAPORAN CK5 Sarinah - Halaman Detail Barang</font>
					<font style="font-size: 24px;font-weight: 800;">Nomor Pengajuan: <?= $dataGETAJU ?></font>
					<font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
					<div class="line-page-table"></div>
					<font style="font-size: 14px;font-weight: 400;"><?= $resultHeadSetting['address'] ?></font>
				</div>
			</div>
		</div>
		<br>
		<div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;"></div>
		<div class="invoice-content">
				<table id="data-table-buttons-one" class="table table-striped table-bordered table-td-valign-middle" style="width: 100%;font-size: 12px;font-weight: 400;">
					<tbody>
						<tr>
							<td colspan="5" width="158" style="font-weight: 800;">Kantor</td>
							<td width="15">&nbsp;:</td>
							<td width="271"><?= $resultDataNamaKantor['URAIAN_KANTOR']; ?></td>
							<td width="59" style="font-weight: 800;">Kode&nbsp;&nbsp;</td>
							<td width="12">:</td>
							<td colspan="5" width="372">&nbsp;<?= $resultDataCK5PLB['KODE_KANTOR']; ?>&nbsp;</td>
						</tr>
						<tr>
							<td colspan="5" style="font-weight: 800;">Nomor Pengajuan</td>
							<td>&nbsp;:</td>
							<td><?= $dataGETAJU ?></td>
							<td style="font-weight: 800;">Tanggal</td>
							<td>:</td>
							<td colspan="5"><?= date_indo($DEKLARYYMMDD); ?></td>
						</tr>
						<tr>
							<td colspan="5" style="font-weight: 800;">Nomor Pendaftaran</td>
							<td>&nbsp;:</td>
							<td><?= $resultDataCK5PLB['NOMOR_DAFTAR']; ?></td>
							<td style="font-weight: 800;">Tanggal</td>
							<td>:</td>
							<td colspan="5"><?= $resultDataCK5PLB['TANGGAL_DAFTAR']; ?></td>
						</tr>
					</tbody>
				</table>
				<table id="data-table-buttons-two" class="table table-striped table-bordered table-td-valign-middle" style="width: 100%;font-size: 12px;font-weight: 400;">
					<thead>
						<tr>
							<th width="1%">No. Urut</th>
							<th class="text-nowrap" style="text-align: center;">Rincian Jumlah, Jenis Merk</th>
							<th class="text-nowrap" style="text-align: center;">Uraian jenis barang secara lengkap</th>
							<th class="text-nowrap" style="text-align: center;">Jumlah dan jenis satuan barang</th>
							<th class="text-nowrap" style="text-align: center;">HJE / HJP*) (Rp)</th>
							<th class="text-nowrap" style="text-align: center;">Tarif Cukai</th>
							<th class="text-nowrap" style="text-align: center;">Jumlah Cukai (Rp)</th>
							<th class="text-nowrap" style="text-align: center;">Jumlah Devisa (USD)</th>
							<th class="text-nowrap" style="text-align: center;">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$dataTable = $dbcon->query("SELECT * 
							FROM tpb_barang AS a 
							LEFT OUTER JOIN referensi_satuan AS b ON a.KODE_SATUAN=b.KODE_SATUAN
							LEFT OUTER JOIN view_tpb_barang_tarif AS c ON a.SERI_BARANG=c.SERI_BARANG
							WHERE a.ID_HEADER='$dataGETAJUID'
							-- AND a.ID_HEADER='$dataGETAJUID'
							GROUP BY a.SERI_BARANG
							");
						if (mysqli_num_rows($dataTable) > 0) {
							$no = 0;
							while ($row = mysqli_fetch_array($dataTable)) {
								$no++;
								$aKali = $row['JUMLAH_SATUAN'];
								$bKali = $row['UKURAN'];
								$cHasil = $aKali * $bKali;
								$cJC = $cHasil * $row['TARIF'];

								$cJCA = array($cJC);
								$cJCSUM = array_sum($cJCA);
								// $JumlahRJJM = SUM($row['JUMLAH_SATUAN']);
								?>
								<tr class="odd gradeX">
									<td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
									<td style="text-align: left;"><?= $row['JUMLAH_SATUAN'] ?> <?= $row['URAIAN_SATUAN'] ?> <?= $row['MEREK_SATUAN'] ?></td>
									<td style="text-align: left;"><?= $row['URAIAN'] ?><br><?= $row['UKURAN'] ?></td>
									<td style="text-align: right;"><?= $cHasil ?> <?= $row['URAIAN_SATUAN'] ?></td>
									<td style="text-align: center;">-</td>
									<td style="text-align: center;"><?= $row['TARIF'];?></td>
									<td style="text-align: center;"><?= Rupiah($cJC) ?></td>
									<td style="text-align: center;">-</td>
									<td style="text-align: center;"><?= $cJCSUM ?></td>
								</tr>
							<?php } ?>
						</tbody>
						<?php
						$DataFooter = $dbcon->query("SELECT b.URAIAN_SATUAN,a.UKURAN,c.TARIF,
					                                (SELECT SUM(JUMLAH_SATUAN) FROM view_tpb_barang_tarif WHERE ID_HEADER='$dataGETAJUID') AS jml_RJJM,
					                                (SELECT SUM(JUMLAH_SATUAN * UKURAN) FROM tpb_barang_tarif WHERE ID_HEADER='$dataGETAJUID') AS jml_JJSB
													FROM tpb_barang AS a 
													LEFT OUTER JOIN referensi_satuan AS b ON a.KODE_SATUAN=b.KODE_SATUAN
													LEFT OUTER JOIN view_tpb_barang_tarif AS c ON a.SERI_BARANG=c.SERI_BARANG
													WHERE a.ID_HEADER='$dataGETAJUID'
													-- AND a.ID_HEADER='$dataGETAJUID'
													-- GROUP BY a.SERI_BARANG
													");
						$resultDataFooter = mysqli_fetch_array($DataFooter);
						$Totalall = $resultDataFooter['jml_JJSB'] * $resultDataFooter['TARIF'];
						?>
						<tfoot>
							<tr>
								<td style="text-align: right;"></td>
								<td style="text-align: right;"><b> <?= decimal(round($resultDataFooter['jml_RJJM']))?> <?= $resultDataFooter['URAIAN_SATUAN']?></b></td>
								<td style="text-align: right;"></td>
								<td style="text-align: right;"><b><?= decimal(round($resultDataFooter['jml_JJSB']))?> <?= $resultDataFooter['URAIAN_SATUAN']?></b></td>
								<td style="text-align: right;"></td>
								<td style="text-align: right;"></td>
								<td style="text-align: right;"><b> <?= Rupiah($Totalall)?></b></td>
								<td style="text-align: right;"></td>
								<td style="text-align: right;"></td>
							</tr>
							<?php } else { ?>
								<tr>
									<td colspan="9">
										<center>
											<div style="display: grid;">
												<i class="far fa-times-circle no-data"></i> Tidak ada data
											</div>
										</center>
									</td>
								</tr>
							<?php } ?>
						</tfoot>
				</table>
		</div>
		<div class="invoice-footer">
			<p class="text-center m-b-5 f-w-600">
				Export CK5 Sarinah | IT Inventory <?= $resultHeadSetting['company'] ?>
			</p>
			<p class="text-center">
				<span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> <?= $resultHeadSetting['website'] ?></span>
				<span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:<?= $resultHeadSetting['telp'] ?></span>
				<span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> <?= $resultHeadSetting['email'] ?></span>
			</p>
		</div>
	</div>
	<script src="assets/js/theme/default.min.js"></script>
	<script src="assets/plugins/d3/d3.min.js"></script>
	<script src="assets/plugins/nvd3/build/nv.d3.js"></script>
	<script src="assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
	<script src="assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
	<script src="assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
	<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="assets/plugins/pdfmake/build/pdfmake.min.js"></script>
	<script src="assets/plugins/pdfmake/build/vfs_fonts.js"></script>
	<script src="assets/plugins/jszip/dist/jszip.min.js"></script>
	<script src="assets/js/demo/table-manage-buttons.demo.js"></script>
	<script src="assets/js/demo/table-manage-default.demo.js"></script>
	<script src="assets/plugins/datatables.net-fixedcolumns/js/dataTables.fixedcolumns.min.js"></script>
	<script src="assets/plugins/datatables.net-fixedcolumns-bs4/js/fixedcolumns.bootstrap4.min.js"></script>
	<script src="assets/js/demo/table-manage-fixed-columns.demo.js"></script>
	<script src="assets/plugins/datatables.net-fixedheader/js/dataTables.fixedheader.min.js"></script>
	<script src="assets/plugins/datatables.net-fixedheader-bs4/js/fixedheader.bootstrap4.min.js"></script>
	<script src="assets/js/demo/table-manage-fixed-header.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#data-table-buttons-one').DataTable({
				dom: 'Bfrtip',
				buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5'
				]
			});
		});

		$(document).ready(function() {
			$('#data-table-buttons-two').DataTable({
				dom: 'Bfrtip',
				buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5'
				]
			});
		});
	</script>
	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>