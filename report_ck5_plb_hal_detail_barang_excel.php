<?php
header("Content-type: application/vnd-ms-excel");
date_default_timezone_set("Asia/Bangkok");
$datenow = date('d-m-Y h-i-s');

header("Content-Disposition: attachment; filename=Laporan CK5 PLB-Halaman_Detail_Barang$datenow.xls");
?>
<!-- QUERY -->
<?php
include "include/connection.php";
// include "include/restrict.php";

$dataHeadSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultHeadSetting = mysqli_fetch_array($dataHeadSettting);

$dataSetRealTime = $dbcon->query("SELECT * FROM tbl_realtime ORDER BY id DESC LIMIT 1");
$resultSetRealTime = mysqli_fetch_array($dataSetRealTime);

$SetTime = $resultSetRealTime['reload'];

$CheckForPrivileges = $_SESSION['username'];
$dataForPrivileges = $dbcon->query("SELECT INSERT_DATA,UPDATE_DATA,DELETE_DATA,KIRIM_DATA,UPDATE_PASSWORD FROM view_privileges WHERE USER_NAME='$CheckForPrivileges'");
$resultForPrivileges = mysqli_fetch_array($dataForPrivileges);

$dataGETAJU = $_GET['AJU'];
$DataCK5PLB = $dbcon->query("SELECT * FROM plb_header WHERE NOMOR_AJU='$dataGETAJU'");
$resultDataCK5PLB = mysqli_fetch_array($DataCK5PLB);

// KEMASAN 
$DataCK5PLBKemasan = $dbcon->query("SELECT * 
	FROM plb_kemasan AS a
	LEFT OUTER JOIN referensi_kemasan AS b ON a.KODE_JENIS_KEMASAN=b.KODE_KEMASAN
	WHERE a.NOMOR_AJU='$dataGETAJU'");
$resultDataCK5PLBKemasan = mysqli_fetch_array($DataCK5PLBKemasan);

// Cari Nama Kantor Pemasok
$forNamaKantor = $resultDataCK5PLB['KPPBC'];
$DataNamaKantor = $dbcon->query("SELECT URAIAN_KANTOR FROM referensi_kantor_pabean WHERE KODE_KANTOR='$forNamaKantor'");
$resultDataNamaKantor = mysqli_fetch_array($DataNamaKantor);

// NPPBKC PEMASOK
$forNPPBKCPemasok = $resultDataCK5PLB['PERUSAHAAN'];
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
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 15">
<link rel=File-List href="Halaman%20Detail%20Barang11_files/filelist.xml">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
x\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<script  async src="https://www.googletagmanager.com/gtag/js?id=G-Q66YLEFFZ2">
</script>

<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-Q66YLEFFZ2');
</script>
<style id="Halaman Detail Barang1_21469_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.font021469
	{color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.font521469
	{color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.font621469
	{color:black;
	font-size:18.0pt;
	font-weight:800;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;}
.xl1521469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl6521469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:"Medium Date";
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6621469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:800;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6721469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:800;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6821469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:800;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl6921469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7021469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7121469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7221469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7321469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:right;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7421469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7521469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7621469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl7721469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:bottom;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7821469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	border:.5pt solid windowtext;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl7921469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:none;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8021469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:18.0pt;
	font-weight:800;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:left;
	vertical-align:middle;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
.xl8121469
	{padding:0px;
	mso-ignore:padding;
	color:black;
	font-size:18.0pt;
	font-weight:800;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:none;
	border-left:none;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:nowrap;}
-->
</style>
</head>

<body>
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--The following information was generated by Microsoft Excel's Publish as Web
Page wizard.-->
<!--If the same item is republished from Excel, all information between the DIV
tags will be replaced.-->
<!----------------------------->
<!--START OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD -->
<!----------------------------->

<div id="Halaman Detail Barang1_21469" align=center x:publishsource="Excel">

<table border=0 cellpadding=0 cellspacing=0 width=1305 style='border-collapse:collapse;table-layout:fixed;width:980pt'>
 <col width=49 style='mso-width-source:userset;mso-width-alt:1792;width:37pt'>
 <col width=142 style='mso-width-source:userset;mso-width-alt:5193;width:107pt'>
 <col width=195 style='mso-width-source:userset;mso-width-alt:7131;width:146pt'>
 <col width=165 style='mso-width-source:userset;mso-width-alt:6034;width:124pt'>
 <col width=88 style='mso-width-source:userset;mso-width-alt:3218;width:66pt'>
 <col width=60 style='mso-width-source:userset;mso-width-alt:2194;width:45pt'>
 <col width=109 style='mso-width-source:userset;mso-width-alt:3986;width:82pt'>
 <col width=113 style='mso-width-source:userset;mso-width-alt:4132;width:85pt'>
 <col width=64 span=6 style='width:48pt'>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1521469 width=49 style='height:15.0pt;width:37pt'>
  <div style='display:flex;align-items: center'>
  <div style='display:flex;justify-content: center'></div>
  </td>
  <td class=xl1521469 width=142 style='width:107pt'></td>
  <td class=xl1521469 width=195 style='width:146pt'></td>
  <td class=xl1521469 width=165 style='width:124pt'></td>
  <td class=xl1521469 width=88 style='width:66pt'></td>
  <td class=xl1521469 width=60 style='width:45pt'></td>
  <td class=xl1521469 width=109 style='width:82pt'></td>
  <td class=xl1521469 width=113 style='width:85pt'></td>
  <td class=xl1521469 width=64 style='width:48pt'></td>
  <td class=xl1521469 width=64 style='width:48pt'></td>
  <td class=xl1521469 width=64 style='width:48pt'></td>
  <td class=xl1521469 width=64 style='width:48pt'></td>
  <td class=xl1521469 width=64 style='width:48pt'></td>
  <td class=xl1521469 width=64 style='width:48pt'></td>
 </tr>
 <tr height=31 style='height:23.25pt'>
  <td colspan=9 height=31 class=xl8021469 style='height:23.25pt'>
  <div style='display:grid;justify-content: left'>LAPORAN CK5 PLB - Halaman
  Detail Barang<font class="font521469"> </font></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=31 style='height:23.25pt'>
  <td colspan=9 height=31 class=xl8021469 style='height:23.25pt'>Nomor
  Pengajuan: 16022301384620180509000033</td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=31 style='height:23.25pt'>
  <td height=31 class=xl8021469 style='height:23.25pt'></td>
  <td class=xl8021469></td>
  <td class=xl8021469></td>
  <td class=xl8021469></td>
  <td class=xl8021469></td>
  <td class=xl8021469></td>
  <td class=xl8021469></td>
  <td class=xl8021469></td>
  <td class=xl8021469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=31 style='height:23.25pt'>
  <td colspan=9 height=31 class=xl8121469 style='height:23.25pt'><?= $resultHeadSetting['company'] ?></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=9 height=20 class=xl7921469 style='height:15.0pt'><?= $resultHeadSetting['address'] ?></div>
  </td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1521469 style='height:15.0pt'></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=2 height=20 class=xl6621469 width=191 style='height:15.0pt;
  width:144pt'></div>
  <div style='box-sizing: border-box;margin-right:-1px'></div>Kantor</td>
  <td class=xl7821469 width=195 style='border-left:none;width:146pt'>: <?= $resultDataNamaKantor['URAIAN_KANTOR']; ?></td>
  <td class=xl6621469 width=165 style='border-left:none;width:124pt'>Kode&nbsp;&nbsp;</td>
  <td colspan=5 class=xl7821469 width=434 style='border-left:none;width:326pt'>: <?= $resultDataCK5PLB['KPPBC']; ?>&nbsp;</td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td colspan=2 height=20 class=xl6621469 width=191 style='height:15.0pt;width:144pt'>Nomor Pengajuan</td>
  <td class=xl7821469 width=195 style='border-top:none;border-left:none;width:146pt'>: <?= $dataGETAJU ?></td>
  <td class=xl6621469 width=165 style='border-top:none;border-left:none;width:124pt'>Tanggal</td>
  <td colspan=5 class=xl7821469 width=434 style='border-left:none;width:326pt'>: <?= date_indo($DEKLARYYMMDD); ?></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td colspan=2 height=20 class=xl6621469 width=191 style='height:15.0pt;width:144pt'>Nomor Pendaftaran</td>
  <td class=xl7821469 width=195 style='border-top:none;border-left:none;width:146pt'>: <?= $resultDataCK5PLB['NOMOR_DAFTAR']; ?></td>
  <td class=xl6621469 width=165 style='border-top:none;border-left:none;width:124pt'>Tanggal</td>
  <td colspan=5 class=xl7821469 width=434 style='border-left:none;width:326pt'>: <?= $resultDataCK5PLB['TANGGAL_DAFTAR']; ?></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=20 style='mso-height-source:userset;height:15.0pt'>
  <td height=20 class=xl6721469 width=49 style='height:15.0pt;width:37pt'></td>
  <td class=xl6721469 width=142 style='width:107pt'></td>
  <td class=xl6821469 width=195 style='width:146pt'></td>
  <td class=xl6821469 width=165 style='width:124pt'></td>
  <td class=xl6821469 width=88 style='width:66pt'></td>
  <td class=xl6921469 width=60 style='width:45pt'></td>
  <td class=xl6921469 width=109 style='width:82pt'></td>
  <td class=xl6821469 width=113 style='width:85pt'></td>
  <td class=xl6921469 width=64 style='width:48pt'></td>
  <td class=xl6521469 width=64 style='width:48pt'></td>
  <td class=xl6521469 width=64 style='width:48pt'></td>
  <td class=xl6521469 width=64 style='width:48pt'></td>
  <td class=xl6521469 width=64 style='width:48pt'></td>
  <td class=xl6521469 width=64 style='width:48pt'></td>
 </tr>
</table>
<table border=1 cellpadding=0 cellspacing=0 width=1305 style='border-collapse:collapse;table-layout:fixed;width:980pt'>
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
		FROM plb_barang AS a 
		LEFT OUTER JOIN referensi_satuan AS b ON a.KODE_SATUAN=b.KODE_SATUAN
		LEFT OUTER JOIN view_plb_barangtarif AS c ON a.SERI_BARANG=c.SERI_BARANG
		WHERE a.NOMOR_AJU='$dataGETAJU'
		-- AND a.NOMOR_AJU='$dataGETAJU'
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
                                (SELECT SUM(JUMLAH_SATUAN) FROM view_plb_barangtarif WHERE NOMOR_AJU='$dataGETAJU') AS jml_RJJM,
                                (SELECT SUM(JUMLAH_SATUAN * UKURAN) FROM plb_barangtarif WHERE NOMOR_AJU='$dataGETAJU') AS jml_JJSB
								FROM plb_barang AS a 
								LEFT OUTER JOIN referensi_satuan AS b ON a.KODE_SATUAN=b.KODE_SATUAN
								LEFT OUTER JOIN view_plb_barangtarif AS c ON a.SERI_BARANG=c.SERI_BARANG
								WHERE a.NOMOR_AJU='$dataGETAJU'
								-- AND a.NOMOR_AJU='$dataGETAJU'
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
<br>
<table border=0 cellpadding=0 cellspacing=0 width=1305 style='border-collapse:collapse;table-layout:fixed;width:980pt'>
 <tr height=20 style='height:15.0pt'>
  <td colspan=9 rowspan=2 height=40 class=xl7621469 style='height:30.0pt'><!-- </div> -->Export
  CK5 PLB | IT Inventory PT. Sarinah</td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1521469 style='height:15.0pt'></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td colspan=9 rowspan=2 height=20 class=xl7721469 width=985 style='height:
  15.0pt;width:740pt'><script  src="assets/js/theme/default.min.js">
  </script><script  src="assets/plugins/d3/d3.min.js">
  </script><script  src="assets/plugins/nvd3/build/nv.d3.js">
  </script><script  src="assets/plugins/jvectormap-next/jquery-jvectormap.min.js">
  </script><script  src="assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js">
  </script><script  src="assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js">
  </script><script  src="assets/plugins/gritter/js/jquery.gritter.js">
  </script><script  src="assets/plugins/datatables.net/js/jquery.dataTables.min.js">
  </script><script  src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js">
  </script><script  src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js">
  </script><script  src="assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
  </script><script  src="assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js">
  </script><script  src="assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js">
  </script><script  src="assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js">
  </script><script  src="assets/plugins/datatables.net-buttons/js/buttons.flash.min.js">
  </script><script  src="assets/plugins/datatables.net-buttons/js/buttons.html5.min.js">
  </script><script  src="assets/plugins/datatables.net-buttons/js/buttons.print.min.js">
  </script><script  src="assets/plugins/pdfmake/build/pdfmake.min.js">
  </script><script  src="assets/plugins/pdfmake/build/vfs_fonts.js">
  </script><script  src="assets/plugins/jszip/dist/jszip.min.js">
  </script><script  src="assets/js/demo/table-manage-buttons.demo.js">
  </script><script  src="assets/js/demo/table-manage-default.demo.js">
  </script><script  src="assets/plugins/datatables.net-fixedcolumns/js/dataTables.fixedcolumns.min.js">
  </script><script  src="assets/plugins/datatables.net-fixedcolumns-bs4/js/fixedcolumns.bootstrap4.min.js">
  </script><script  src="assets/js/demo/table-manage-fixed-columns.demo.js">
  </script><script  src="assets/plugins/datatables.net-fixedheader/js/dataTables.fixedheader.min.js">
  </script><script  src="assets/plugins/datatables.net-fixedheader-bs4/js/fixedheader.bootstrap4.min.js">
  </script><script  src="assets/js/demo/table-manage-fixed-header.demo.js">
  </script><script  type="text/javascript">
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
</td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl1521469 style='height:15.0pt'></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
  <td class=xl1521469></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=49 style='width:37pt'></td>
  <td width=142 style='width:107pt'></td>
  <td width=195 style='width:146pt'></td>
  <td width=165 style='width:124pt'></td>
  <td width=88 style='width:66pt'></td>
  <td width=60 style='width:45pt'></td>
  <td width=109 style='width:82pt'></td>
  <td width=113 style='width:85pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
 </tr>
 <![endif]>
</table>

</div>


<!----------------------------->
<!--END OF OUTPUT FROM EXCEL PUBLISH AS WEB PAGE WIZARD-->
<!----------------------------->
</body>

</html>
