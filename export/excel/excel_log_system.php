<?php
include "../include/connection.php";
// Data
$dataHeadSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultHeadSetting = mysqli_fetch_array($dataHeadSettting);

$startdate = '';
$enddate = '';
if (isset($_GET["find_"])) {
	$startdate = $_GET['startdate'];
	$enddate   = $_GET['enddate'];
	// FOR AKTIFITAS
	$me = $_GET['me'];
	$datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
	$resultme = mysqli_fetch_array($datame);

	$IDUNIQme             = $resultme['USRIDUNIQ'];
	$InputUsername        = $me;
	$InputModul           = 'Report/Log System';
	$InputDescription     = $me . " Expot Data Excel: " .  $startdate . " s.d " .  $enddate . ", Simpan Data Sebagai Export Report Log System";
	$InputAction          = 'Export Excel Laporan Log System';
	$InputDate            = date('Y-m-d h:m:i');

	$query = $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
}

header("Content-type: application/vnd-ms-excel");
date_default_timezone_set("Asia/Bangkok");
$datenow = date('d-m-Y h-i-s');

header("Content-Disposition: attachment; filename=Laporan Log System_$datenow.xls");

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
?>
<div>
	<div class="title-laporan" style="justify-content: center;text-align: center;align-items: center;">
		<img src="https://hellos-id.com/dev/tpb/assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="20%">
	</div>
	<br>
	<div class="title-laporan" style="justify-content: center;text-align: center;align-items: center;display: grid;">
		<font style="font-size: 20px;text-transform: uppercase;font-weight: 900;">LAPORAN LOG SYSTEM</font>
		<br>
		<font>DI GUDANG BERIKAT PT BHANDA GHARA REKSA, JALAN BOULEVARD, KOMPLEK PERGUDANGAN PT BGR BLOK J1, KELAPA GADING, JAKARTA UTARA</font>
		<font>PT. Sarinah </font>
		<font>Data dari tanggal <?= $_GET['startdate']; ?> s.d <?= $_GET['enddate']; ?></font>
	</div>
</div>
<hr>
<table id="example1" border="1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="1%">#</th>
			<th style="text-align: center;">Tanggal</th>
			<th style="text-align: center;">Waktu</th>
			<th style="text-align: center;">Username</th>
			<th style="text-align: center;">Kejadian</th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (isset($_GET["find_"])) {
			$startdate = $_GET['startdate'];
			$enddate   = $_GET['enddate'];
			$dataTable = $dbcon->query("SELECT * FROM tbl_aktifitas WHERE date_created BETWEEN '$startdate' AND '$enddate' ORDER BY id DESC");
		}
		if (mysqli_num_rows($dataTable) > 0) {
			$no = 0;
			while ($row = mysqli_fetch_array($dataTable)) {
				$no++;
		?>
				<tr>
					<!-- 21 -->
					<td><?= $no ?>. </td>
					<td style="text-align: left;"><i class="fas fa-calendar-alt"></i> <?= date_indo(SUBSTR($row['date_created'], 0, 10), TRUE) ?></td>
					<td style="text-align: left;"><i class="fas fa-clock"></i> <?= SUBSTR($row['date_created'], 11) ?></td>
					<td style="text-align: center;"><?= $row['username'] ?></td>
					<td><?= $row['description'] ?></td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="5">
					<center>
						<div style="display: grid;">
							<i class="far fa-times-circle no-data"></i> Tidak ada data
						</div>
					</center>
				</td>
			</tr>
		<?php }
		mysqli_close($dbcon); ?>
	</tbody>
</table>