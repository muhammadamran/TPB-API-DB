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

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
		<title>TPBERP | PT. Sarinah </title>
	<?php } else { ?>
		<title><?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> - <?= $resultHeadSetting['title'] ?></title>
	<?php } ?>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
	<meta name=ProgId content=Excel.Sheet>
	<meta name=Generator content="Microsoft Excel 15">
	<link rel=File-List href="CK-5-DAW%2010%20Pallet%20TBB1_files/filelist.xml">
	<?php if ($resultHeadSetting['icon'] == NULL) { ?>
		<link rel="apple-touch-icon" sizes="180x180" href="assets/images/icon/icon-default.png">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/images/icon/icon-default.png">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/images/icon/icon-default.png">
	<?php } else { ?>
		<link rel="apple-touch-icon" sizes="180x180" href="assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
	<?php } ?>
	<link href="assets/css/tpb.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<link href="assets/css/default/invoice-print.min.css" rel="stylesheet" />
	<link href="assets/css/ck5plb.css" rel="stylesheet" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q66YLEFFZ2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-Q66YLEFFZ2');
    </script>
</head>
<style type="text/css">
	.nav-top-content {
		padding: 20px;
		margin-top: 30px;
	}

	@media (max-width: 767.5px) {
		.nav-top-content {
			padding: 20px;
			margin-top: 0px;
		}
	}
</style>
<body onload="window.print();">
	<!-- begin #page-container -->
	<div id="content" class="nav-top-content">
		<div class="invoice">
			<div class="invoice-company">
				<?= $resultHeadSetting['company'] ?>
			</div>
			<!-- <div class="invoice-header">
				<div class="invoice-from">
					<small>from</small>
					<address class="m-t-5 m-b-5">
						<strong class="text-inverse">Twitter, Inc.</strong><br />
						Street Address<br />
						City, Zip Code<br />
						Phone: (123) 456-7890<br />
						Fax: (123) 456-7890
					</address>
				</div>
				<div class="invoice-to">
					<small>to</small>
					<address class="m-t-5 m-b-5">
						<strong class="text-inverse">Company Name</strong><br />
						Street Address<br />
						City, Zip Code<br />
						Phone: (123) 456-7890<br />
						Fax: (123) 456-7890
					</address>
				</div>
				<div class="invoice-date">
					<small>Invoice / July period</small>
					<div class="date text-inverse m-t-5">August 3,2012</div>
					<div class="invoice-detail">
						#0000123DSS<br />
						Services Product
					</div>
				</div>
			</div> -->
			<div class="invoice-content">
				<!-- <div style="display: flex;justify-content: center;"> -->
					<!-- <div style="margin-left: 80px;"> -->
						<table border=0 cellpadding=0 cellspacing=0 width=1038 class=xl6911096
 style='border-collapse:collapse;table-layout:fixed;width:782pt'>
 <col class=xl6911096 width=32 style='mso-width-source:userset;mso-width-alt:
 1170;width:24pt'>
 <col class=xl6911096 width=158 style='mso-width-source:userset;mso-width-alt:
 5778;width:119pt'>
 <col class=xl6911096 width=17 style='mso-width-source:userset;mso-width-alt:
 621;width:13pt'>
 <col class=xl6911096 width=21 style='mso-width-source:userset;mso-width-alt:
 768;width:16pt'>
 <col class=xl6911096 width=26 style='mso-width-source:userset;mso-width-alt:
 950;width:20pt'>
 <col class=xl6911096 width=24 style='mso-width-source:userset;mso-width-alt:
 877;width:18pt'>
 <col class=xl6911096 width=23 style='mso-width-source:userset;mso-width-alt:
 841;width:17pt'>
 <col class=xl6911096 width=25 style='mso-width-source:userset;mso-width-alt:
 914;width:19pt'>
 <col class=xl6911096 width=49 style='mso-width-source:userset;mso-width-alt:
 1792;width:37pt'>
 <col class=xl6911096 width=25 style='mso-width-source:userset;mso-width-alt:
 914;width:19pt'>
 <col class=xl6911096 width=22 style='mso-width-source:userset;mso-width-alt:
 804;width:17pt'>
 <col class=xl6911096 width=25 style='mso-width-source:userset;mso-width-alt:
 914;width:19pt'>
 <col class=xl6911096 width=20 style='mso-width-source:userset;mso-width-alt:
 731;width:15pt'>
 <col class=xl6911096 width=36 style='mso-width-source:userset;mso-width-alt:
 1316;width:27pt'>
 <col class=xl6911096 width=48 style='mso-width-source:userset;mso-width-alt:
 1755;width:36pt'>
 <col class=xl6911096 width=20 style='mso-width-source:userset;mso-width-alt:
 731;width:15pt'>
 <col class=xl6911096 width=60 style='mso-width-source:userset;mso-width-alt:
 2194;width:45pt'>
 <col class=xl6911096 width=62 style='mso-width-source:userset;mso-width-alt:
 2267;width:47pt'>
 <col class=xl6911096 width=20 span=2 style='mso-width-source:userset;
 mso-width-alt:731;width:15pt'>
 <col class=xl6911096 width=91 style='mso-width-source:userset;mso-width-alt:
 3328;width:68pt'>
 <col class=xl6911096 width=24 style='mso-width-source:userset;mso-width-alt:
 877;width:18pt'>
 <col class=xl6911096 width=31 style='mso-width-source:userset;mso-width-alt:
 1133;width:23pt'>
 <col class=xl6911096 width=62 style='mso-width-source:userset;mso-width-alt:
 2267;width:47pt'>
 <col class=xl6911096 width=97 style='mso-width-source:userset;mso-width-alt:
 3547;width:73pt'>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl6911096 width=32 style='height:12.75pt;width:24pt'><a
  name="RANGE!A1:Y89"></a></td>
  <td class=xl6911096 width=158 style='width:119pt'></td>
  <td class=xl6911096 width=17 style='width:13pt'></td>
  <td class=xl6911096 width=21 style='width:16pt'></td>
  <td class=xl6911096 width=26 style='width:20pt'></td>
  <td class=xl6911096 width=24 style='width:18pt'></td>
  <td class=xl6911096 width=23 style='width:17pt'></td>
  <td class=xl6911096 width=25 style='width:19pt'></td>
  <td class=xl6911096 width=49 style='width:37pt'></td>
  <td class=xl6911096 width=25 style='width:19pt'></td>
  <td class=xl6911096 width=22 style='width:17pt'></td>
  <td class=xl6911096 width=25 style='width:19pt'></td>
  <td class=xl6911096 width=20 style='width:15pt'></td>
  <td class=xl6911096 width=36 style='width:27pt'></td>
  <td class=xl6911096 width=48 style='width:36pt'></td>
  <td class=xl6911096 width=20 style='width:15pt'></td>
  <td class=xl6911096 width=60 style='width:45pt'></td>
  <td class=xl6911096 width=62 style='width:47pt'></td>
  <td class=xl6911096 width=20 style='width:15pt'></td>
  <td class=xl6911096 width=20 style='width:15pt'></td>
  <td class=xl6911096 width=91 style='width:68pt'></td>
  <td class=xl6911096 width=24 style='width:18pt'></td>
  <td class=xl6911096 width=31 style='width:23pt'></td>
  <td class=xl6911096 width=62 style='width:47pt'></td>
  <td class=xl6911096 width=97 style='width:73pt'></td>
 </tr>
 <tr height=21 style='height:15.75pt'>
  <td colspan=24 height=21 class=xl14911096 style='height:15.75pt'>PEMBERITAHUAN
  MUTASI BARANG KENA CUKAI ( PMBKC )</td>
  <td class=xl7011096>CK<span style='mso-spacerun:yes'>  </span>5</td>
 </tr>
 <tr height=9 style='mso-height-source:userset;height:6.75pt'>
  <td height=9 class=xl6911096 style='height:6.75pt'></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td colspan=2 height=17 class=xl15011096 style='height:12.75pt'>Kantor</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7211096>:</td>
  <td class=xl7111096 colspan=6>KPPBC TMP A MARUNDA</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096 colspan=2>Kode<span style='mso-spacerun:yes'>           
  </span>:</td>
  <td colspan=2 class=xl14411096 style='border-right:.5pt solid black'>160200</td>
  <td class=xl7211096>&nbsp;</td>
  <td class=xl7211096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>Hal :<span style='mso-spacerun:yes'>  </span>1</td>
  <td class=xl7311096>Dari<span style='mso-spacerun:yes'>    </span>3</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td colspan=2 height=17 class=xl7411096 style='height:12.75pt'>Nomor
  Pengajuan</td>
  <td class=xl6911096></td>
  <td class=xl7611096>:</td>
  <td class=xl6911096 colspan=8>160227-013846-20180403-000029</td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=2>Tanggal<span style='mso-spacerun:yes'>      
  </span>:</td>
  <td class=xl12511096 colspan=3>03 April 2018</td>
  <td class=xl12511096></td>
  <td class=xl12511096></td>
  <td class=xl7511096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=18 style='mso-height-source:userset;height:13.5pt'>
  <td colspan=2 height=18 class=xl7411096 style='height:13.5pt'>Nomor
  Pendaftaran</td>
  <td class=xl6911096></td>
  <td class=xl7611096>:</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=2 class=xl7511096>Tanggal<span style='mso-spacerun:yes'>      
  </span>:</td>
  <td class=xl12511096 colspan=3>03 April 2018</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7511096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=12 style='mso-height-source:userset;height:9.0pt'>
  <td height=12 class=xl7411096 style='height:9.0pt'>&nbsp;</td>
  <td class=xl7511096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=18 style='mso-height-source:userset;height:13.5pt'>
  <td height=18 class=xl7811096 style='height:13.5pt'>A.</td>
  <td class=xl6911096>Jenis Barang Kena Cukai</td>
  <td class=xl7611096>:</td>
  <td class=xl7911096>2</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>1.</td>
  <td class=xl6911096 colspan=2>Etil Alkohol</td>
  <td class=xl6911096></td>
  <td class=xl7611096>2.</td>
  <td class=xl6911096 colspan=2>MMEA</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>3.</td>
  <td class=xl6911096 colspan=2>Hasil Tembakau</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>4.</td>
  <td class=xl6911096 colspan=2>Lainnya……..</td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>B.</td>
  <td class=xl6911096>Cara Pelunasan</td>
  <td class=xl7611096>:</td>
  <td class=xl7911096 style='border-top:none'>2</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>1.</td>
  <td class=xl6911096 colspan=3>Pembayaran</td>
  <td class=xl7611096>2.</td>
  <td class=xl6911096 colspan=4>Pelekatan Pita Cukai</td>
  <td class=xl7611096>3.</td>
  <td class=xl6911096 colspan=5>Pembubuhan Tanda Lunas Cukai Lainnya</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>C.</td>
  <td class=xl6911096>Status Cukai</td>
  <td class=xl7611096>:</td>
  <td class=xl7911096 style='border-top:none'>1</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>1.</td>
  <td class=xl6911096 colspan=3>Belum Dilunasi</td>
  <td class=xl7611096>2.</td>
  <td class=xl6911096 colspan=4>Sudah Dilunasi</td>
  <td class=xl7611096><span style='mso-spacerun:yes'> </span></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>D.</td>
  <td class=xl6911096>Jenis Pemberitahuan</td>
  <td class=xl7611096>:</td>
  <td class=xl7911096 style='border-top:none'>3</td>
  <td class=xl7911096 style='border-left:none'>3</td>
  <td class=xl6911096></td>
  <td class=xl7611096>1.</td>
  <td class=xl6911096 colspan=2>Dibayar</td>
  <td class=xl6911096></td>
  <td class=xl7611096>2.</td>
  <td class=xl6911096 colspan=4>Tidak Dipungut</td>
  <td class=xl7611096>3.</td>
  <td class=xl6911096 colspan=2>Dibebaskan</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>4.</td>
  <td class=xl6911096 colspan=2>Lainnya……..</td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=26 style='mso-height-source:userset;height:19.5pt'>
  <td height=26 class=xl7811096 style='height:19.5pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>11.</td>
  <td class=xl6911096>Tunai</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>21.</td>
  <td class=xl6911096 colspan=2>Diekspor</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>31.</td>
  <td class=xl6911096 colspan=4>Bahan Baku/Pemotong</td>
  <td class=xl6911096></td>
  <td class=xl7611096>41.</td>
  <td class=xl6911096 colspan=2 style='border-right:.5pt solid black'>Dimusnahkan</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td colspan=3 class=xl7511096>BHA Non BKC</td>
  <td class=xl7511096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>42.</td>
  <td class=xl6911096 colspan=2 style='border-right:.5pt solid black'>Diolah
  Kembali</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>12.</td>
  <td class=xl6911096>Tunda</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>22.</td>
  <td class=xl6911096 colspan=3>Ke dari Pabrik/</td>
  <td class=xl6911096></td>
  <td class=xl7611096>32.</td>
  <td class=xl6911096 colspan=4>Iptek/Sosial/Tenaga Ahli/</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>13.</td>
  <td class=xl6911096>Berkala</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl6911096 colspan=5>Tempat Penyimpanan</td>
  <td colspan=3 class=xl7511096>Perwakilan Asing</td>
  <td class=xl7511096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>23.</td>
  <td class=xl6911096 colspan=3>Bahan Baku /</td>
  <td class=xl6911096></td>
  <td class=xl7611096>33.</td>
  <td colspan=3 class=xl7511096>Ke TPB</td>
  <td class=xl7511096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=4>Penoilong BHABKC</td>
  <td class=xl7611096>34.</td>
  <td class=xl6911096 colspan=4>Telah/Untuk dirusak sehingga</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=4>tidak baik untuk diminum</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>35.</td>
  <td class=xl6911096 colspan=4>Untuk Konsumsi Penumpang/</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=4>Awak Sarana Pengangkut ke<span
  style='mso-spacerun:yes'> </span></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=4>Luar daerah Pabean</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl8011096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8211096>&nbsp;</td>
 </tr>
 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 class=xl8311096 colspan=2 style='height:17.25pt'>E. Data
  Pemberitahuan</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl8411096 colspan=2 style='height:18.75pt'>TEMPAT ASAL
  PEMASOK</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7311096>&nbsp;</td>
  <td colspan=8 class=xl14711096 style='border-left:none'>TEMPAT TUJUAN
  PENGGUNA</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7311096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7811096 colspan=8><span style='mso-spacerun:yes'> </span>(
  Apabila untuk tujuan Eskpor langsung ke butir 15 )</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td height=21 class=xl8511096 style='height:15.75pt'>1.</td>
  <td class=xl6911096>NPWP</td>
  <td class=xl7611096>:</td>
  <td class=xl6911096 colspan=6>01.000.061.0-051.000</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl8511096 style='border-left:none'>11.</td>
  <td class=xl6911096 colspan=2>Identitas</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>:</td>
  <td class=xl6911096 colspan=3>01.337.224.8-415.001</td>
  <td class=xl1511096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td height=21 class=xl8511096 style='height:15.75pt'>2.</td>
  <td class=xl6911096>NPPBKC</td>
  <td class=xl7611096>:</td>
  <td colspan=5 class=xl7511096>0404.2.2.1001</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl8511096 style='border-left:none'>12.</td>
  <td class=xl6911096 colspan=2>NPPBKC</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096>:</td>
  <td class=xl6911096 colspan=2>0501.4.2.0042</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td height=21 class=xl8611096 style='height:15.75pt'>3.</td>
  <td class=xl8711096>Nama Alamat</td>
  <td class=xl8811096 width=17 style='width:13pt'>:</td>
  <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;width:197pt'><span style='mso-spacerun:yes'>  </span> <span style='mso-spacerun:yes'>   </span></td>
  <td class=xl8611096 style='border-left:none'>13.</td>
  <td class=xl6911096 colspan=3>Nama Alamat</td>
  <td class=xl6911096></td>
  <td class=xl8811096 width=20 style='width:15pt'>:</td>
  <td class=xl8711096 colspan=4>PT Dewataagung Wibawa</td>
  <td class=xl1511096></td>
  <td class=xl11611096>&nbsp;</td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td height=21 class=xl8611096 style='height:15.75pt'>&nbsp;</td>
  <td class=xl8711096></td>
  <td class=xl8811096 width=17 style='width:13pt'></td>
  <td class=xl6911096 colspan=10>(BGR) Jl.Boulevard Blok J1 Kelapa Gading</td>
  <td class=xl8611096>&nbsp;</td>
  <td class=xl11711096></td>
  <td class=xl8911096 width=20 style='width:15pt'></td>
  <td class=xl8911096 width=60 style='width:45pt'></td>
  <td class=xl8911096 width=62 style='width:47pt'></td>
  <td class=xl8811096 width=20 style='width:15pt'>:</td>
  <td class=xl6911096 colspan=6 style='border-right:.5pt solid black'>Wisma
  Soewarna 3RD Floor Suite K-R, Soewana<span style='mso-spacerun:yes'> </span></td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td height=21 class=xl8611096 style='height:15.75pt'>&nbsp;</td>
  <td class=xl8711096></td>
  <td class=xl6911096></td>
  <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;
  width:197pt'>Jl. MH. Thamrin No. 11 Jakarta</td>
  <td class=xl8611096 style='border-left:none'>&nbsp;</td>
  <td class=xl11711096></td>
  <td class=xl8911096 width=20 style='width:15pt'></td>
  <td class=xl8911096 width=60 style='width:45pt'></td>
  <td class=xl8911096 width=62 style='width:47pt'></td>
  <td class=xl8811096 width=20 style='width:15pt'>:</td>
  <td class=xl8711096 colspan=6 style='border-right:.5pt solid black'>Business
  Park, Soeksrno-Hatta Internasional Airport<span
  style='mso-spacerun:yes'> </span></td>
 </tr>
 <tr height=14 style='mso-height-source:userset;height:10.5pt'>
  <td height=14 class=xl8611096 style='height:10.5pt'>&nbsp;</td>
  <td class=xl8711096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl8611096>&nbsp;</td>
  <td class=xl11711096></td>
  <td class=xl8911096 width=20 style='width:15pt'></td>
  <td class=xl8911096 width=60 style='width:45pt'></td>
  <td class=xl8911096 width=62 style='width:47pt'></td>
  <td class=xl8811096 width=20 style='width:15pt'>:</td>
  <td class=xl6911096></td>
  <td class=xl1511096></td>
  <td class=xl1511096></td>
  <td class=xl1511096></td>
  <td class=xl1511096></td>
  <td class=xl11611096>&nbsp;</td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td height=21 class=xl8511096 style='height:15.75pt'>4.</td>
  <td class=xl6911096>Nama, Kode Kantor</td>
  <td class=xl7611096>:</td>
  <td class=xl6911096 colspan=6>KPPBC TMP A MARUNDA</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl8511096 style='border-left:none'>14.</td>
  <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
  <td class=xl6911096></td>
  <td class=xl7611096>:</td>
  <td class=xl6911096 colspan=6 style='border-right:.5pt solid black'>KPU TYPE
  C Cengkareng Soekarno-Hatta</td>
 </tr>
 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 class=xl8011096 style='height:17.25pt'>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td colspan=3 class=xl14411096 style='border-right:.5pt solid black'>160200</td>
  <td class=xl8011096 style='border-left:none'>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl7911096>050100</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl9011096 style='height:12.75pt;border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7311096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7311096 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl8511096 style='height:18.75pt'>5.</td>
  <td class=xl6911096 colspan=2>Nomor Invoice/Surat Jalan *)</td>
  <td class=xl7611096>:</td>
  <td class=xl6911096 colspan=8>97368072 ; 97368073 ; 97368074</td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl8511096 style='border-left:none'>15.</td>
  <td class=xl6911096 colspan=4>Nama Kode Negara Tujuan</td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=2>:…………………..</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl8511096 style='height:18.0pt'>6.</td>
  <td class=xl6911096 colspan=2>Tanggal Invoice/Surat Jalan</td>
  <td class=xl7611096>:</td>
  <td class=xl12711096 colspan=4>21 Maret 2018</td>
  <td class=xl12711096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=5>a. Identitas (NPPBKC/NPP/NPWP)</td>
  <td class=xl6911096 colspan=2>:…………………..</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl8511096 style='height:18.0pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=11 style='mso-height-source:userset;height:8.25pt'>
  <td height=11 class=xl9011096 style='height:8.25pt'>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7311096>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 class=xl8511096 style='height:17.25pt'>7.</td>
  <td class=xl6911096>Nomor Skep Fasilitas</td>
  <td class=xl6911096></td>
  <td class=xl7611096>:</td>
  <td class=xl6911096 colspan=5>1653/KM.4/2016</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=3>b. Nama Alamat</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=2>:…………………..</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl8511096 style='height:18.0pt'>8.</td>
  <td class=xl6911096>Tanggal Skep Fasilitas</td>
  <td class=xl6911096></td>
  <td class=xl7611096>:</td>
  <td class=xl12611096 colspan=5>1 September 2016</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7611096>17.</td>
  <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=2>:…………………..</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl9111096><span style='mso-spacerun:yes'> </span></td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl9011096 style='height:18.75pt'>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7111096>&nbsp;</td>
  <td class=xl7311096>&nbsp;</td>
  <td class=xl7611096>18.</td>
  <td class=xl6911096 colspan=3>Pelabuhan Muat</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=2>:…………………..</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td height=21 class=xl8511096 style='height:15.75pt'>9.</td>
  <td class=xl6911096>Cara Pengangkutan</td>
  <td class=xl6911096></td>
  <td class=xl7611096>:</td>
  <td class=xl7911096>1</td>
  <td class=xl9211096>1.</td>
  <td class=xl6911096 colspan=2>Darat</td>
  <td class=xl6911096>2. Laut</td>
  <td class=xl6911096 colspan=3>3.<span style='mso-spacerun:yes'>  </span>Udara</td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7611096>19.</td>
  <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=2>:…………………..</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl9111096><span style='mso-spacerun:yes'> </span></td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl8511096 style='height:18.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7611096>20.</td>
  <td class=xl6911096 colspan=4>Pelabuhan Singgah Terakhir</td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=2>:…………………..</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl9311096><span style='mso-spacerun:yes'> </span></td>
 </tr>
 <tr height=24 style='mso-height-source:userset;height:18.0pt'>
  <td height=24 class=xl8511096 style='height:18.0pt'>10.</td>
  <td class=xl6911096>Jumlah Jenis Kemasan</td>
  <td class=xl6911096></td>
  <td class=xl7611096>:</td>
  <td colspan=2 class=xl14111096><span style='mso-spacerun:yes'>      </span>10
  </td>
  <td class=xl6911096 colspan=2>Pallet</td>
  <td class=xl6911096><span style='mso-spacerun:yes'> </span>=<span
  style='mso-spacerun:yes'>   </span>424</td>
  <td class=xl6911096 colspan=2>Karton</td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7611096>21.</td>
  <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=2>:…………………..</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl9111096><span style='mso-spacerun:yes'> </span></td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl8011096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8211096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8211096>&nbsp;</td>
 </tr>
 <tr height=19 style='mso-height-source:userset;height:14.25pt'>
  <td height=19 class=xl9411096 colspan=2 style='height:14.25pt'>F. Uraian
  Barang</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td rowspan=3 height=51 class=xl13811096 width=32 style='border-bottom:.5pt solid black;
  height:38.25pt;width:24pt'>22.No.Urut</td>
  <td rowspan=3 class=xl13811096 width=158 style='border-bottom:.5pt solid black;
  width:119pt'>23. Perincian Jumlah Jenis Merk &amp; Nomor Koli</td>
  <td colspan=7 rowspan=3 class=xl13211096 width=185 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:140pt'>24. Uraian jenis Barang Secara
  lengkap</td>
  <td colspan=4 rowspan=3 class=xl13211096 width=92 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:70pt'>25. Jumlah dan Jenis Satuan
  barang<span style='mso-spacerun:yes'> </span></td>
  <td colspan=4 rowspan=3 class=xl13211096 width=164 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:123pt'>26. HJB HJP*) (Rp.)</td>
  <td colspan=2 rowspan=3 class=xl13211096 width=82 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:62pt'>27. Tarif Cukai</td>
  <td colspan=2 rowspan=3 class=xl13211096 width=111 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:83pt'>28. Jumlah Cukai (Rp.)</td>
  <td colspan=3 rowspan=3 class=xl13211096 width=117 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black;width:88pt'>29. Jumlah Devisa (USD)</td>
  <td rowspan=3 class=xl13811096 width=97 style='border-bottom:.5pt solid black;
  width:73pt'>30.Keterangan</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
 </tr>
 <tr height=17 style='height:12.75pt'>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl9511096 style='height:12.75pt;border-top:none'>&nbsp;</td>
  <td class=xl9511096 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl9011096 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7311096 style='border-top:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl9011096 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7311096 style='border-top:none'>&nbsp;</td>
  <td class=xl9011096 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl7311096 style='border-top:none'>&nbsp;</td>
  <td class=xl9011096 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl9011096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7311096 style='border-top:none'>&nbsp;</td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl9611096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl9711096 style='border-left:none'>&nbsp;</td>
  <td class=xl11011096 style='border-left:none'>&nbsp;</td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11211096>&nbsp;</td>
  <td class=xl11311096 style='border-left:none'>&nbsp;</td>
  <td class=xl11411096></td>
  <td class=xl11411096></td>
  <td class=xl11511096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl11311096 style='border-left:none'>&nbsp;</td>
  <td class=xl9911096>&nbsp;</td>
  <td class=xl6811096></td>
  <td class=xl9911096>&nbsp;</td>
  <td class=xl6811096></td>
  <td class=xl6811096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl9611096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl9711096 style='border-left:none'><span
  style='mso-spacerun:yes'> </span>======= Terlampir ======</td>
  <td class=xl11011096 style='border-left:none'>&nbsp;</td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11211096>&nbsp;</td>
  <td class=xl11311096 style='border-left:none'>&nbsp;</td>
  <td class=xl11411096></td>
  <td class=xl11411096></td>
  <td class=xl11511096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl9811096 style='border-left:none'>&nbsp;</td>
  <td class=xl9911096>&nbsp;</td>
  <td colspan=2 class=xl11311096 style='border-right:.5pt solid black;
  border-left:none'><span style='mso-spacerun:yes'>  </span>==== Terlampir
  ===<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6811096></td>
  <td class=xl6811096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl9611096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl9711096 style='border-left:none'>&nbsp;</td>
  <td class=xl11011096 style='border-left:none'>&nbsp;</td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11211096>&nbsp;</td>
  <td class=xl11311096 style='border-left:none'>&nbsp;</td>
  <td class=xl11411096></td>
  <td class=xl11411096></td>
  <td class=xl11511096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl9811096 style='border-left:none'>&nbsp;</td>
  <td class=xl9911096>&nbsp;</td>
  <td class=xl6811096></td>
  <td class=xl9911096>&nbsp;</td>
  <td class=xl6811096></td>
  <td class=xl6811096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl9611096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl9711096 style='border-left:none'>&nbsp;</td>
  <td class=xl11011096 style='border-left:none'>&nbsp;</td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11111096></td>
  <td class=xl11211096>&nbsp;</td>
  <td class=xl11311096 style='border-left:none'>&nbsp;</td>
  <td class=xl11411096></td>
  <td class=xl11411096></td>
  <td class=xl11511096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl9811096 style='border-left:none'>&nbsp;</td>
  <td class=xl9911096>&nbsp;</td>
  <td class=xl6811096></td>
  <td class=xl9911096>&nbsp;</td>
  <td class=xl6811096></td>
  <td class=xl6811096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=25 style='mso-height-source:userset;height:18.75pt'>
  <td height=25 class=xl10011096 style='height:18.75pt'>&nbsp;</td>
  <td class=xl10011096 style='border-left:none'>&nbsp;</td>
  <td class=xl8011096 style='border-left:none'>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8211096>&nbsp;</td>
  <td class=xl12211096 style='border-left:none'>&nbsp;</td>
  <td class=xl12011096>&nbsp;</td>
  <td class=xl12011096>&nbsp;</td>
  <td class=xl12111096>&nbsp;</td>
  <td class=xl10111096 style='border-left:none'>&nbsp;</td>
  <td class=xl10211096>&nbsp;</td>
  <td class=xl10211096>&nbsp;</td>
  <td class=xl10311096>&nbsp;</td>
  <td class=xl10111096 style='border-left:none'>&nbsp;</td>
  <td class=xl10311096>&nbsp;</td>
  <td class=xl12211096 style='border-left:none'>&nbsp;</td>
  <td class=xl12311096>&nbsp;</td>
  <td class=xl8011096 style='border-left:none'>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8211096>&nbsp;</td>
  <td class=xl8211096>&nbsp;</td>
 </tr>
 <tr height=21 style='mso-height-source:userset;height:15.75pt'>
  <td height=21 class=xl10411096 colspan=2 style='height:15.75pt'>G.<span
  style='mso-spacerun:yes'>    </span><font class="font511096">Pemberitahuan</font></td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7311096 style='border-top:none'>&nbsp;</td>
  <td class=xl10411096 colspan=5>H. <font class="font511096">Untuk Pembayaran /
  Jaminan</font></td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7311096 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=19 style='mso-height-source:userset;height:14.25pt'>
  <td height=19 class=xl7811096 style='height:14.25pt'>&nbsp;</td>
  <td class=xl6911096 colspan=10>Dengan ini saya menyatakan bertanggung jawab
  atas kebenaran</td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl7611096>a.</td>
  <td class=xl6911096 colspan=2>Pembayaran</td>
  <td class=xl7611096>:</td>
  <td class=xl7911096>&nbsp;</td>
  <td class=xl6911096 colspan=2>1. Bank Devisa</td>
  <td class=xl6911096 colspan=2>2.Kantor</td>
  <td class=xl6911096 colspan=2 style='border-right:.5pt solid black'><span
  style='mso-spacerun:yes'>  </span>3. Kantor Pos</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096 colspan=6>hal-hal yang diberitahukan dalam dokumen ini</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl7611096>b.</td>
  <td class=xl6911096 colspan=2>Jaminan</td>
  <td class=xl7611096>:</td>
  <td class=xl7911096 style='border-top:none'>&nbsp;</td>
  <td class=xl6911096 colspan=2>1. Tunai</td>
  <td class=xl6911096 colspan=3>2.Bank Garansi</td>
  <td class=xl10511096>3.Excise Bond</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl7611096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=2>4. Lainnya</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096>Nama Alamat</td>
  <td class=xl7611096>:</td>
  <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;width:197pt'><span style='mso-spacerun:yes'>  </span><span style='mso-spacerun:yes'>   </span></td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl7611096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='mso-height-source:userset;height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;
  width:197pt'>Jl. MH. Thamrin No. 11 Jakarta</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl7611096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=10 style='border-right:.5pt solid black'>(BGR)
  Jl.Boulevard Blok J1 Kelapa Gading</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl7611096>c.</td>
  <td class=xl6911096 colspan=6>No. Bukti Pembayaran/Jaminan</td>
  <td class=xl6911096 colspan=4 style='border-right:.5pt solid black'>:…………………………</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096>Identitas</td>
  <td class=xl7611096>:</td>
  <td colspan=6 class=xl7511096>0404.2.2.1001</td>
  <td colspan=4 class=xl7611096 style='border-right:.5pt solid black'><span
  style='mso-spacerun:yes'> </span></td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl7611096>d.</td>
  <td class=xl6911096 colspan=6>Tanggal Bukti Pembayaran/Jaminan</td>
  <td class=xl6911096 colspan=4 style='border-right:.5pt solid black'>:…………………………</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl7611096>e.</td>
  <td class=xl6911096 colspan=3>Kode Penerimaan</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=4 style='border-right:.5pt solid black'>:…………………………</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=10 class=xl7611096 style='border-right:.5pt solid black'>Jakarta,<span
  style='mso-spacerun:yes'>        </span>April<span style='mso-spacerun:yes'> 
  </span>2018</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=10 class=xl7611096 style='border-right:.5pt solid black'>PT<span
  style='mso-spacerun:yes'>  </span>SARINAH <span
  style='mso-spacerun:yes'>   </span></td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td colspan=5 class=xl7511096>Pejabat Penerima</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=3 class=xl7511096 style='border-right:.5pt solid black'>Nama/Stempel/ttd</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl7611096></td>
  <td class=xl7611096></td>
  <td class=xl10611096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl7611096></td>
  <td class=xl7611096></td>
  <td class=xl10611096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl7611096></td>
  <td class=xl7611096></td>
  <td class=xl10611096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl7611096></td>
  <td class=xl7611096></td>
  <td class=xl10611096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=10 class=xl12811096 style='border-right:.5pt solid black'>Hari
  Prabowo</td>
  <td class=xl7811096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=10 class=xl7611096 style='border-right:.5pt solid black'>General
  Manager</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=5 class=xl7511096>(……………………..)</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=3 class=xl7511096 style='border-right:.5pt solid black'>(……………………………)</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl8011096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8211096>&nbsp;</td>
  <td class=xl8011096 style='border-left:none'>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8211096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl10711096 style='height:12.75pt;border-top:none'>I.<span
  style='mso-spacerun:yes'>    </span></td>
  <td class=xl10811096 colspan=5>Diisi Oleh Pejabat Bea dan Cukai :</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7111096 style='border-top:none'>&nbsp;</td>
  <td class=xl7311096 style='border-top:none'>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096 colspan=11>Pengangkutan ke tempat tujuan / pelabuhan muat
  *) wajib diselesaikan</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=5 class=xl7511096 style='border-right:.5pt solid black'>Nomor
  Buku Rekening</td>
  <td class=xl9511096 style='border-left:none'>&nbsp;</td>
  <td colspan=4 class=xl8511096 style='border-right:.5pt solid black;
  border-left:none'>Jakarta,<span
  style='mso-spacerun:yes'>                                   </span>2018</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096 colspan=12>dalam jangka waktu selambat-lambatnya pada
  hari ke………………………</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=5 class=xl7511096 style='border-right:.5pt solid black'>Barang
  Kena Cukai</td>
  <td class=xl10011096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=3 style='border-right:.5pt solid black'>Pejabat
  Bea dan Cukai</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096 colspan=12>setelah tanggal selesai keluarnya Barang Kena
  Cukai. Jika jangka waktu</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7611096></td>
  <td class=xl7611096></td>
  <td class=xl10611096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096 colspan=12>telah dilewati, maka Pengusaha dikenakan
  sanksi sesuai ketentuan yang<span style='mso-spacerun:yes'> </span></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096>berlaku.</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl10911096 colspan=6>Penundaan pembayaran cukai :</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096><span style='mso-spacerun:yes'> </span></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=5 class=xl7511096 style='border-right:.5pt solid black'>Nomor
  Buku Rekening<span style='mso-spacerun:yes'> </span></td>
  <td class=xl9511096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl7711096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td colspan=5 class=xl7511096 style='border-right:.5pt solid black'>Kredit</td>
  <td class=xl10011096 style='border-left:none'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=3 style='border-right:.5pt solid black'>(……..………….……………..)</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096 colspan=3 style='border-right:.5pt solid black'>Nip :
  ………………………….</td>
 </tr>
 <tr height=11 style='mso-height-source:userset;height:8.25pt'>
  <td height=11 class=xl8011096 style='height:8.25pt'>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8111096>&nbsp;</td>
  <td class=xl8211096>&nbsp;</td>
 </tr>
 <tr height=17 style='height:12.75pt'>
  <td height=17 class=xl6911096 colspan=2 style='height:12.75pt'><span
  style='mso-spacerun:yes'> </span>*)Coret yang tidak perlu</td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
  <td class=xl6911096></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=32 style='width:24pt'></td>
  <td width=158 style='width:119pt'></td>
  <td width=17 style='width:13pt'></td>
  <td width=21 style='width:16pt'></td>
  <td width=26 style='width:20pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=23 style='width:17pt'></td>
  <td width=25 style='width:19pt'></td>
  <td width=49 style='width:37pt'></td>
  <td width=25 style='width:19pt'></td>
  <td width=22 style='width:17pt'></td>
  <td width=25 style='width:19pt'></td>
  <td width=20 style='width:15pt'></td>
  <td width=36 style='width:27pt'></td>
  <td width=48 style='width:36pt'></td>
  <td width=20 style='width:15pt'></td>
  <td width=60 style='width:45pt'></td>
  <td width=62 style='width:47pt'></td>
  <td width=20 style='width:15pt'></td>
  <td width=20 style='width:15pt'></td>
  <td width=91 style='width:68pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=62 style='width:47pt'></td>
  <td width=97 style='width:73pt'></td>
 </tr>
 <![endif]>
</table>
					<!-- </div> -->
				<!-- </div> -->
				<!-- <div class="invoice-price">
					<div class="invoice-price-left">
						<div class="invoice-price-row">
							<div class="sub-price">
								<small>SUBTOTAL</small>
								<span class="text-inverse">$4,500.00</span>
							</div>
							<div class="sub-price">
								<i class="fa fa-plus text-muted"></i>
							</div>
							<div class="sub-price">
								<small>PAYPAL FEE (5.4%)</small>
								<span class="text-inverse">$108.00</span>
							</div>
						</div>
					</div>
					<div class="invoice-price-right">
						<small>TOTAL</small> <span class="f-w-600">$4508.00</span>
					</div>
				</div> -->
			</div>
			<!-- <div class="invoice-note">
				* Make all cheques payable to [Your Company Name]<br />
				* Payment is due within 30 days<br />
				* If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
			</div> -->
			<div class="invoice-footer">
				<p class="text-center m-b-5 f-w-600">
					Export CK5 PLB | IT Inventory <?= $resultHeadSetting['company'] ?>
				</p>
				<p class="text-center">
					<span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> <?= $resultHeadSetting['website'] ?></span>
					<span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:<?= $resultHeadSetting['telp'] ?></span>
					<span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> <?= $resultHeadSetting['email'] ?></span>
				</p>
			</div>
		</div>
	</div>

	<?php 
		// include "include/panel.php"; 
	?>
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<script src="assets/js/app.min.js"></script>
	<script src="assets/js/theme/default.min.js"></script>
</body>
</html>
