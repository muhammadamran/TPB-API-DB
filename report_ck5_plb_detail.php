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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!-- <?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
        <title>TPBERP | PT. Sarinah </title>
    <?php } else { ?>
        <title><?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> - <?= $resultHeadSetting['title'] ?></title>
    <?php } ?> -->
    <title>Laporan CK5 PLB</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <?php if ($resultHeadSetting['icon'] == NULL) { ?>
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/icon/icon-default.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icon/icon-default.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/icon/icon-default.png">
    <?php } else { ?>
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
    <?php } ?>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/css/default/app.min.css" rel="stylesheet" />
    <link href="../assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <!-- <link href="../assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" /> -->
    <link href="assets/css/ck5plb.css" rel="stylesheet" />
    <link href="../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="../assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <link href="../assets/css/tpb.css" rel="stylesheet" />
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

    .for-area-one {
        border: transparent;
        height: 90px;
        width: 325px;
    }

    .for-area-one-oke {
        /*border: transparent;*/
        height: 90px;
        width: 325px;
    }

    .for-area-two {
        border: transparent;
        height: 90px;
        width: 400px;
    }

    @media (max-width: 1366.5px) {
        .for-area-one {
            border: transparent;
            height: 110px;
            width: 260px;
        }

        .for-area-one-oke {
            /*border: transparent;*/
            height: 110px;
            width: 260px;
        }

        .for-area-two {
            border: transparent;
            height: 110px;
            width: 310px;
        }
    }

    .area-big {
        border: transparent;
        width: 130px;
    }

    @media (max-width: 1156.5px) {
        .area-big {
            border: transparent;
            width: 88px;
        }
    }

    label {
        font-size: 12px;
    }

    div.table-responsive>div.dataTables_wrapper>div.row {
        margin: 0;
        font-size: 12px;
    }
</style>

<body>
<div class="invoice">
    <div class="invoice-company">
        <div style="display: flex;justify-content: space-between;margin-bottom: -18px;">
            <div>
                <a href="./report_ck5_plb_detail_edit.php?AJU=<?= $_GET['AJU']; ?>" class="btn btn-sm btn-primary m-b-10" title="Update CK5PLB" style="padding: 7px;">
                    <div style="display: flex;justify-content: space-between;align-items: end;">
                        <i class="fas fa-file" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Hal 1
                    </div>
                </a>
                <a href="./report_ck5_plb_detail_edit.php?AJU=<?= $_GET['AJU']; ?>" class="btn btn-sm btn-default m-b-10" title="Update CK5PLB" style="padding: 7px;">
                    <div style="display: flex;justify-content: space-between;align-items: end;">
                        <i class="fas fa-file" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Hal 1A
                    </div>
                </a>
                <a href="./report_ck5_plb_detail_edit.php?AJU=<?= $_GET['AJU']; ?>" class="btn btn-sm btn-default m-b-10" title="Update CK5PLB" style="padding: 7px;">
                    <div style="display: flex;justify-content: space-between;align-items: end;">
                        <i class="fas fa-file" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Hal Detail Barang
                    </div>
                </a>
            </div>
            <div>
                <!-- <div class="report-button-filter"> -->
                    <!-- <span class="pull-right hidden-print"> -->
                        <a href="./report_ck5_plb_detail_edit.php?AJU=<?= $_GET['AJU']; ?>" class="btn btn-sm btn-warning m-b-10" title="Update CK5PLB" style="padding: 7px;">
                            <div style="display: flex;justify-content: space-between;align-items: end;">
                                <i class="fas fa-edit" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Update CK5 PLB
                            </div>
                        </a>
                        <a href="javascript:;" class="btn btn-sm btn-white m-b-10">
                            <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel"> Export Excel
                        </a>
                        <a href="report_ck5_plb_detail_print.php" class="btn btn-sm btn-white m-b-10">
                            <img src="assets/img/favicon/print.png" class="icon-primary-print" alt="Print"> Print
                        </a>
                        <!-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10"><i class="fa fa-file-excel t-plus-1 text-success fa-fw fa-lg"></i> Export as xls</a> -->
                        <!-- <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a> -->
                        <!-- <a href="report_ck5_plb_detail_print.php" class="btn btn-sm btn-white m-b-10"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a> -->
                    <!-- </span> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
    <div class="line-page-table"></div>
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
            <div style="display: grid;justify-content: center;">
                <font style="font-size: 24px;font-weight: 800;">LAPORAN CK5 PLB</font>
                <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                <div class="line-page-table"></div>
                <font style="font-size: 14px;font-weight: 400;"><?= $resultHeadSetting['address'] ?></font>
            </div>
        </div>
    </div>
    <br>
    <div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;"></div>
    <div class="invoice-content">
        <div class="table-responsive">
            <table border=0 cellpadding=0 cellspacing=0 width=1038 class=xl6911096 style='border-collapse:collapse;table-layout:fixed;width:100%'>
                <col class=xl6911096 width=32 style='mso-width-source:userset;mso-width-alt:1170;width:24pt'>
                <col class=xl6911096 width=158 style='mso-width-source:userset;mso-width-alt:5778;width:119pt'>
                <col class=xl6911096 width=17 style='mso-width-source:userset;mso-width-alt:621;width:13pt'>
                <col class=xl6911096 width=21 style='mso-width-source:userset;mso-width-alt:768;width:16pt'>
                <col class=xl6911096 width=26 style='mso-width-source:userset;mso-width-alt:950;width:20pt'>
                <col class=xl6911096 width=24 style='mso-width-source:userset;mso-width-alt:877;width:18pt'>
                <col class=xl6911096 width=23 style='mso-width-source:userset;mso-width-alt:841;width:17pt'>
                <col class=xl6911096 width=25 style='mso-width-source:userset;mso-width-alt:914;width:19pt'>
                <col class=xl6911096 width=49 style='mso-width-source:userset;mso-width-alt:1792;width:37pt'>
                <col class=xl6911096 width=25 style='mso-width-source:userset;mso-width-alt:914;width:19pt'>
                <col class=xl6911096 width=22 style='mso-width-source:userset;mso-width-alt:804;width:17pt'>
                <col class=xl6911096 width=25 style='mso-width-source:userset;mso-width-alt:914;width:19pt'>
                <col class=xl6911096 width=20 style='mso-width-source:userset;mso-width-alt:731;width:15pt'>
                <col class=xl6911096 width=36 style='mso-width-source:userset;mso-width-alt:1316;width:27pt'>
                <col class=xl6911096 width=48 style='mso-width-source:userset;mso-width-alt:1755;width:36pt'>
                <col class=xl6911096 width=20 style='mso-width-source:userset;mso-width-alt:731;width:15pt'>
                <col class=xl6911096 width=60 style='mso-width-source:userset;mso-width-alt:2194;width:45pt'>
                <col class=xl6911096 width=62 style='mso-width-source:userset;mso-width-alt:2267;width:47pt'>
                <col class=xl6911096 width=20 span=2 style='mso-width-source:userset;mso-width-alt:731;width:15pt'>
                <col class=xl6911096 width=91 style='mso-width-source:userset;mso-width-alt:3328;width:68pt'>
                <col class=xl6911096 width=24 style='mso-width-source:userset;mso-width-alt:877;width:18pt'>
                <col class=xl6911096 width=31 style='mso-width-source:userset;mso-width-alt:1133;width:23pt'>
                <col class=xl6911096 width=62 style='mso-width-source:userset;mso-width-alt:2267;width:47pt'>
                <col class=xl6911096 width=97 style='mso-width-source:userset;mso-width-alt:3547;width:73pt'>
                <tr height=17 style='height:12.75pt'>
                    <td height=17 class=xl6911096 width=32 style='height:12.75pt;width:24pt'><a name="RANGE!A1:Y89"></a></td>
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
                    <td colspan=24 height=21 class=xl14911096 style='height:15.75pt'>PEMBERITAHUAN MUTASI BARANG KENA CUKAI ( PMBKC )</td>
                    <td class=xl7011096>CK<span style='mso-spacerun:yes'></span>5</td>
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
                    <td class=xl7111096 colspan=6><?= $resultDataNamaKantor['URAIAN_KANTOR']; ?></td>
                    <td class=xl7111096>&nbsp;</td>
                    <td class=xl7111096>&nbsp;</td>
                    <td class=xl7111096>&nbsp;</td>
                    <td class=xl7111096 colspan=2>Kode<span style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                    <td colspan=2 class=xl14411096 style='border-right:.5pt solid black'><?= $resultDataCK5PLB['KPPBC']; ?></td>
                    <td class=xl7211096>&nbsp;</td>
                    <td class=xl7211096>&nbsp;</td>
                    <td class=xl7111096>&nbsp;</td>
                    <td class=xl7111096>&nbsp;</td>
                    <td class=xl7111096>&nbsp;</td>
                    <td class=xl7111096>&nbsp;</td>
                    <td class=xl7111096></td>
                    <td class=xl7311096></td>
                </tr>
                <tr height=17 style='height:12.75pt'>
                    <td colspan=2 height=17 class=xl7411096 style='height:12.75pt'>Nomor Pengajuan</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>:</td>
                    <td class=xl6911096 colspan=8>
                        <font id="SHOW-IDNO-AJU"><?= $resultDataCK5PLB['NOMOR_AJU']; ?></font>
                    </td>
                    <td class=xl6911096></td>
                    <td class=xl6911096 colspan=2>Tanggal<span style='mso-spacerun:yes'></span>&nbsp;&nbsp;:</td>
                    <td class=xl12511096 colspan=3 style="background: transparent;"><?= date_indo($DEKLARYYMMDD); ?></td>
                    <td class=xl12511096></td>
                    <td class=xl12511096></td>
                    <td class=xl7511096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <tr height=18 style='mso-height-source:userset;height:13.5pt'>
                    <td colspan=2 height=18 class=xl7411096 style='height:13.5pt'>Nomor Pendaftaran</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>:</td>
                    <td class=xl6911096><?= $resultDataCK5PLB['NOMOR_DAFTAR']; ?></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td colspan=2 class=xl7511096>Tanggal<span style='mso-spacerun:yes'></span>&nbsp;&nbsp;:</td>
                    <td class=xl12511096 colspan=3 style="background: transparent;"><?= $resultDataCK5PLB['TANGGAL_DAFTAR']; ?></td>
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
                    <td class="xl7911096">2</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class=xl6911096 colspan=2>1. Etil Alkohol</td>
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
                <!-- Show Jenis Barang Kena Cukai -->
                <tr id="OthersJenisBarangKenaCukai" height=18 style='mso-height-source:userset;height:13.5pt;display: none;'>
                    <td height=18 class=xl7811096 style='height:13.5pt'></td>
                    <td class=xl6911096>Lainnya</td>
                    <td class=xl7611096>:</td>
                    <td colspan=10>
                        <input type="text" name="InputOthersJenisBarangKenaCukai">
                    </td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096></td>
                    <td class=xl6911096 colspan=2></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096></td>
                    <td class=xl6911096 colspan=2></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <!-- End Show Jenis Barang Kena Cukai -->
                <tr height=17 style='height:12.75pt'>
                    <td height=17 class=xl7811096 style='height:12.75pt'>B.</td>
                    <td class=xl6911096>Cara Pelunasan</td>
                    <td class=xl7611096>:</td>
                    <td class="xl7911096">2</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class=xl6911096 colspan=3>1. Pembayaran</td>
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
                    <td class="xl7911096">2</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class=xl6911096 colspan=3>1. Belum Dilunasi</td>
                    <td class=xl7611096>2.</td>
                    <td class=xl6911096 colspan=4>Sudah Dilunasi</td>
                    <td class=xl7611096><span style='mso-spacerun:yes'></span></td>
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
                    <td class="xl7911096">2</td>
                    <td class="xl7911096">2</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class=xl6911096 colspan=2>1. Dibayar</td>
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
                <!-- Show Jenis Barang Kena Cukai -->
                <tr id="OthersJenisPemberitahuan" height=18 style='mso-height-source:userset;height:13.5pt;display: none;'>
                    <td height=18 class=xl7811096 style='height:13.5pt'></td>
                    <td class=xl6911096>Lainnya</td>
                    <td class=xl7611096>:</td>
                    <td colspan=10>
                        <input type="text" name="InputOthersJenisPemberitahuan">
                    </td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096></td>
                    <td class=xl6911096 colspan=2></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096></td>
                    <td class=xl6911096 colspan=2></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <!-- End Show Jenis Barang Kena Cukai -->
                <tr height=26 style='mso-height-source:userset;height:19.5pt'>
                    <td height=26 class=xl7811096 style='height:19.5pt'>&nbsp;</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>&nbsp;&nbsp;&nbsp;11. Tunai</td>
                    <td class=xl6911096></td>
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
                    <td class=xl6911096 colspan=2 style='border-right:.5pt solid black'>Diolah Kembali</td>
                </tr>
                <tr height=17 style='height:12.75pt'>
                    <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>&nbsp;&nbsp;&nbsp;12. Tunda</td>
                    <td class=xl6911096></td>
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
                    <td class=xl7611096>&nbsp;&nbsp;&nbsp;13. Berkala</td>
                    <td class=xl6911096></td>
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
                    <td class=xl6911096 colspan=4>Awak Sarana Pengangkut ke<span style='mso-spacerun:yes'></span></td>
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
                    <td height=23 class=xl8311096 colspan=2 style='height:17.25pt'>E. Data Pemberitahuan</td>
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
                    <td height=25 class=xl8411096 colspan=2 style='height:18.75pt'>TEMPAT ASAL PEMASOK</td>
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
                    <td colspan=8 class=xl14711096 style='border-left:none'>TEMPAT TUJUAN PENGGUNA</td>
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
                    <td class=xl7811096 colspan=8><span style='mso-spacerun:yes'></span>( Apabila untuk tujuan Eskpor langsung ke butir 15 )</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <tr height=21 style='mso-height-source:userset;height:15.75pt'>
                    <td height=21 class=xl8511096 style='height:15.75pt'>1.</td>
                    <td class=xl6911096>NPWP</td>
                    <td class=xl7611096>:</td>
                    <td class=xl6911096 colspan=6><?= $resultDataCK5PLB['ID_PENGUSAHA']; ?></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                    <td class=xl8511096 style='border-left:none'>11.</td>
                    <td class=xl6911096 colspan=2>Identitas</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>:</td>
                    <td class=xl6911096 colspan=3><?= $resultDataCK5PLB['ID_PENERIMA_BARANG']; ?></td>
                    <td class=xl1511096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <tr height=21 style='mso-height-source:userset;height:15.75pt'>
                    <td height=21 class=xl8511096 style='height:15.75pt'>2.</td>
                    <td class=xl6911096>NPPBKC</td>
                    <td class=xl7611096>:</td>
                    <td colspan=5 class=xl7511096 style="background: transparent;"><?= $resultDataNPPBKCPemasok['NPPBKC']; ?></td>
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
                    <td class=xl6911096 colspan=2 style="background: transparent;"><?= $resultDataNPPBKCTujuan['NPPBKC']; ?></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <tr height=21 style='mso-height-source:userset;height:15.75pt'>
                    <td height=21 class=xl8611096 style='height:15.75pt'>3.</td>
                    <td class=xl8711096>Nama Alamat</td>
                    <td class=xl8811096 width=17 style='width:13pt'>:</td>
                    <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;width:197pt'><?= $resultDataCK5PLB['PERUSAHAAN']; ?></td>
                    <td class=xl8611096 style='border-left:none'>13.</td>
                    <td class=xl6911096 colspan=3>Nama Alamat</td>
                    <td class=xl6911096></td>
                    <td class=xl8811096 width=20 style='width:15pt'>:</td>
                    <td class=xl8711096 colspan=6 style="border-right: 0.5pt solid black;"><?= $resultDataCK5PLB['NAMA_PENERIMA_BARANG']; ?></td>
                </tr>
                <tr height=21 style='mso-height-source:userset;height:15.75pt'>
                    <td height=21 class=xl8611096 style='height:15.75pt'>&nbsp;</td>
                    <td class=xl8711096></td>
                    <td class=xl8811096 width=17 style='width:13pt'></td>
                    <td class=xl6911096 colspan=10>
                        <textarea class="for-area-one"><?= $resultDataCK5PLB['ALAMAT_PENGUSAHA']; ?></textarea>
                    </td>
                    <td class=xl8611096>&nbsp;</td>
                    <td class=xl11711096></td>
                    <td class=xl8911096 width=20 style='width:15pt'></td>
                    <td class=xl8911096 width=60 style='width:45pt'></td>
                    <td class=xl8911096 width=62 style='width:47pt'></td>
                    <td class=xl8811096 width=20 style='width:15pt'></td>
                    <td class=xl6911096 colspan=6 style='border-right:.5pt solid black'>
                        <textarea class="for-area-two"><?= $resultDataCK5PLB['ALAMAT_PENERIMA_BARANG']; ?></textarea>
                    </td>
                </tr>
                <tr height=21 style='mso-height-source:userset;height:15.75pt'>
                    <td height=21 class=xl8611096 style='height:15.75pt'>&nbsp;</td>
                    <td class=xl8711096></td>
                    <td class=xl6911096></td>
                    <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;width:197pt'></td>
                    <td class=xl8611096 style='border-left:none'>&nbsp;</td>
                    <td class=xl11711096></td>
                    <td class=xl8911096 width=20 style='width:15pt'></td>
                    <td class=xl8911096 width=60 style='width:45pt'></td>
                    <td class=xl8911096 width=62 style='width:47pt'></td>
                    <td class=xl8811096 width=20 style='width:15pt'></td>
                    <td class=xl8711096 colspan=6 style='border-right:.5pt solid black'></td>
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
                    <td class=xl8811096 width=20 style='width:15pt'></td>
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
                    <td class=xl6911096 colspan=6><?= $resultDataNamaKantor['URAIAN_KANTOR']; ?></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                    <td class=xl8511096 style='border-left:none'>14.</td>
                    <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>:</td>
                    <td class=xl6911096 colspan=6 style='border-right:.5pt solid black'><?= $resultDataNamaKantorTujuan['URAIAN_KANTOR']; ?></td>
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
                    <td colspan=3 class=xl14411096 style='border-right:.5pt solid black'><?= $resultDataCK5PLB['KPPBC']; ?></td>
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
                    <td class=xl7911096><?= $resultDataCK5PLB['KODE_KANTOR_TUJUAN']; ?></td>
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
                    <td class=xl6911096 colspan=8 style="background: red">97368072 ; 97368073 ; 97368074 ???</td>
                    <td class=xl7711096>&nbsp;</td>
                    <td class=xl8511096 style='border-left:none'>15.</td>
                    <td class=xl6911096 colspan=4>Nama Kode Negara Tujuan</td>
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>........................................</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <tr height=24 style='mso-height-source:userset;height:18.0pt'>
                    <td height=24 class=xl8511096 style='height:18.0pt'>6.</td>
                    <td class=xl6911096 colspan=2>Tanggal Invoice/Surat Jalan</td>
                    <td class=xl7611096>:</td>
                    <td class=xl12711096 colspan=4 style="background: red;">21 Maret 2018 ???</td>
                    <td class=xl12711096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096 colspan=4>a. Identitas (NPPBKC/NPP/NPWP)</td>
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>........................................</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <!-- Show Identitas Two -->
                <!-- NPPBKC -->
                <tr id="IdentitasTwoNPPBKC" height=24 style='mso-height-source:userset;height:18.0pt;display: none;'>
                    <td height=24 class=xl8511096 style='height:18.0pt'></td>
                    <td class=xl6911096 colspan=2></td>
                    <td class=xl7611096></td>
                    <td class=xl12711096 colspan=4></td>
                    <td class=xl12711096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096 colspan=4>&nbsp;&nbsp;&nbsp;&nbsp;NPPBKC</td>
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>
                        <input type="text" name="InputIdentitasTwoNPPBKC">
                    </td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <!-- End NPPBKC -->
                <!-- NPP -->
                <tr id="IdentitasTwoNPP" height=24 style='mso-height-source:userset;height:18.0pt;display: none;'>
                    <td height=24 class=xl8511096 style='height:18.0pt'></td>
                    <td class=xl6911096 colspan=2></td>
                    <td class=xl7611096></td>
                    <td class=xl12711096 colspan=4></td>
                    <td class=xl12711096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096 colspan=4>&nbsp;&nbsp;&nbsp;&nbsp;NPP</td>
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>
                        <input type="text" name="InputIdentitasTwoNPP">
                    </td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <!-- End NPP -->
                <!-- End Show Identitas Two -->
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
                    <td class=xl6911096 colspan=5><?= $resultDataCK5PLB['NOMOR_IJIN_TPB']; ?></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096 colspan=3>b. Nama Alamat</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>........................................</td>
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
                    <td class=xl12611096 colspan=5><?= date_indo($resultDataTanggalSKEP['for_tgl_skep']); ?></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                    <td class=xl7611096>17.</td>
                    <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>........................................</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl9111096 id="InputshowKodeOne"></td>
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
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>........................................</td>
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
                    <td class="xl7911096"><?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?></td>
                    <td class=xl9211096>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096>&nbsp;&nbsp;1. Darat 2. Laut 3. Udara</td>
                    <td class=xl6911096 colspan=3></td>
                    <td class=xl7711096 colspan=2>&nbsp;</td>
                    <td class=xl7611096>19.</td>
                    <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>........................................</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl9111096 id="InputshowKodeTwo"></td>
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
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>........................................</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl9311096><span style='mso-úspacerun:yes'></span></td>
                </tr>
                <tr height=24 style='mso-height-source:userset;height:18.0pt'>
                    <td height=24 class=xl8511096 style='height:18.0pt'>10.</td>
                    <td class=xl6911096>Jumlah Jenis Kemasan</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>:</td>
                    <td class=xl14111096 colspan=5 style="text-align: justify;background: transparent;"><?= $resultDataCK5PLBKemasan['JUMLAH_KEMASAN'] ?> <?= $resultDataCK5PLBKemasan['URAIAN_KEMASAN'] ?> = <?= $resultDataCK5PLBKemasan['MEREK_KEMASAN'] ?></td>
                    <td class=xl6911096></td>
                    <td colspan=2 class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                    <td class=xl7611096>21.</td>
                    <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096>:</td>
                    <td class=xl6911096 colspan=2>........................................</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl9111096 id="InputshowKodeThree"></td>
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
                    <td height=19 class=xl9411096 colspan=2 style='height:14.25pt'>F. Uraian Barang</td>
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
                    <td rowspan=3 height=51 class=xl13811096 width=82 style='border-bottom:.5pt solid black;height:38.25pt;width:74pt'>22.<br>No.Urut</td>
                    <td rowspan=3 class=xl13811096 width=158 style='border-bottom:.5pt solid black;width:119pt'>23. Perincian Jumlah Jenis Merk &amp; Nomor Koli</td>
                    <td colspan=7 rowspan=3 class=xl13211096 width=185 style='border-right:.5pt solid black;border-bottom:.5pt solid black;width:140pt'>24. Uraian jenis Barang Secara lengkap</td>
                    <td colspan=4 rowspan=3 class=xl13211096 width=92 style='border-right:.5pt solid black;border-bottom:.5pt solid black;width:70pt'>25. Jumlah dan Jenis Satuan barang<span style='mso-spacerun:yes'></span></td>
                    <td colspan=4 rowspan=3 class=xl13211096 width=164 style='border-right:.5pt solid black;border-bottom:.5pt solid black;width:123pt'>26. HJB HJP*) (Rp.)</td>
                    <td colspan=2 rowspan=3 class=xl13211096 width=82 style='border-right:.5pt solid black;border-bottom:.5pt solid black;width:62pt'>27. Tarif Cukai</td>
                    <td colspan=2 rowspan=3 class=xl13211096 width=111 style='border-right:.5pt solid black;border-bottom:.5pt solid black;width:83pt'>28. Jumlah Cukai (Rp.)</td>
                    <td colspan=3 rowspan=3 class=xl13211096 width=117 style='border-right:.5pt solid black;border-bottom:.5pt solid black;width:88pt'>29. Jumlah Devisa (USD)</td>
                    <td rowspan=3 class=xl13811096 width=97 style='border-bottom:.5pt solid black;width:73pt'>30.Keterangan</td>
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
                    <td class=xl9711096 style='border-left:none'><span style='mso-spacerun:yes'></span>
                        <center>======= Terlampir ======</center>
                    </td>
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
                    <td colspan=2 class=xl11311096 style='border-right:.5pt solid black;border-left:none'><span style='mso-spacerun:yes'></span>==== Terlampir===<span style='mso-spacerun:yes'></span></td>
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
                    <td height=21 class=xl10411096 colspan=2 style='height:15.75pt'>G.<span style='mso-spacerun:yes'></span>
                        <font class="font511096">Pemberitahuan</font>
                    </td>
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
                    <td class=xl10411096 colspan=5>H. <font class="font511096">Untuk Pembayaran / Jaminan</font>
                    </td>
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
                    <td class=xl6911096 colspan=2>Pembayaran&nbsp;:</td>
                    <td class="xl7911096">2</td>
                    <td></td>
                    <td class=xl6911096 colspan=2>1. Bank Devisa</td>
                    <td class=xl6911096 colspan=3>2. Kantor</td>
                    <td class=xl6911096 colspan=1 style='border-right:.5pt solid black'><span style='mso-spacerun:yes'></span>3. Kantor Pos</td>
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
                    <td class=xl6911096 colspan=2>Jaminan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                    <td class="xl7911096">2</td>
                    <td></td>
                    <td class=xl6911096 colspan=2>1. Tunai</td>
                    <td class=xl6911096 colspan=3>2. Bank Garansi</td>
                    <td class=xl10511096>3. Excise Bond</td>
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
                <!-- Others Jaminan -->
                <tr height=17 id="OthersJaminan" style='height:12.75pt;display: none;'>
                    <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
                    <td class=xl6911096 colspan=6></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096></td>
                    <td class=xl6911096 colspan=2>Lainnya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                    <td>
                        <input type="text" name="OthersJaminan">
                    </td>
                    <td></td>
                    <td class=xl6911096 colspan=2></td>
                    <td class=xl6911096 colspan=3></td>
                    <td class=xl10511096></td>
                </tr>
                <!-- End Others Jaminan -->
                <tr height=17 style='height:12.75pt'>
                    <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
                    <td class=xl6911096>Nama Alamat</td>
                    <td class=xl7611096>:</td>
                    <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;width:197pt'><?= $resultDataCK5PLB['PERUSAHAAN']; ?></td>
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
                    <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;width:197pt'>
                        <textarea class="for-area-one"><?= $resultDataCK5PLB['ALAMAT_PENGUSAHA']; ?></textarea>
                    </td>
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
                    <td class=xl6911096 colspan=10 style='border-right:.5pt solid black'></td>
                    <td class=xl7811096 style='border-left:none'>&nbsp;</td>
                    <td class=xl7611096>c.</td>
                    <td class=xl6911096 colspan=6>No. Bukti Pembayaran/Jaminan</td>
                    <td class=xl6911096 colspan=4 style='border-right:.5pt solid black'>:........................................</td>
                </tr>
                <tr height=17 style='height:12.75pt'>
                    <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
                    <td class=xl6911096>Identitas</td>
                    <td class=xl7611096>:</td>
                    <td colspan=6 class=xl7511096 style="background: transparent;"><?= $resultDataNPPBKCPemasok['NPPBKC']; ?></td>
                    <td colspan=4 class=xl7611096 style='border-right:.5pt solid black'><span style='mso-spacerun:yes'></span></td>
                    <td class=xl7811096 style='border-left:none'>&nbsp;</td>
                    <td class=xl7611096>d.</td>
                    <td class=xl6911096 colspan=6>Tanggal Bukti Pembayaran/Jaminan</td>
                    <td class=xl6911096 colspan=4 style='border-right:.5pt solid black'>:........................................</td>
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
                    <td class=xl6911096 colspan=4 style='border-right:.5pt solid black'>:........................................</td>
                </tr>
                <tr height=17 style='height:12.75pt'>
                    <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td colspan=10 class=xl7611096 style='border-right:.5pt solid black'>Jakarta,<span style='mso-spacerun:yes'></span> <?= date_indo(date('Y-m-d')); ?></td>
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
                    <td colspan=10 class=xl7611096 style='border-right:.5pt solid black'><?= $resultDataCK5PLB['PERUSAHAAN']; ?></td>
                    <td class=xl7811096 style='border-left:none'>&nbsp;</td>
                    <td class=xl6911096></td>
                    <td colspan=5 class=xl7511096>&nbsp;&nbsp;Pejabat Penerima</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td colspan=3 class=xl7511096 style='border-right:.5pt solid black'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama/Stempel/ttd</td>
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
                    <td colspan=10 class=xl12811096 style='border-right:.5pt solid black'><?= $resultDataCK5PLB['NAMA_TTD']; ?></td>
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
                    <td colspan=10 class=xl7611096 style='border-right:.5pt solid black'>&nbsp;<?= $resultDataCK5PLB['JABATAN_TTD']; ?></td>
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
                    <td height=17 class=xl10711096 style='height:12.75pt;border-top:none'>I.<span style='mso-spacerun:yes'></span></td>
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
                    <td class=xl6911096 colspan=11>Pengangkutan ke tempat tujuan / pelabuhan muat *) wajib diselesaikan</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td colspan=5 class=xl7511096 style='border-right:.5pt solid black'>Nomor Buku Rekening</td>
                    <td class=xl9511096 style='border-left:none'>
                    </td>
                    <td colspan=4 class=xl8511096 style='border-right:.5pt solid black'></td>
                </tr>
                <tr height=17 style='height:12.75pt'>
                    <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
                    <td class=xl6911096 colspan=12>dalam jangka waktu selambat-lambatnya pada hari ke………………………</td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td colspan=5 class=xl7511096 style='border-right:.5pt solid black'>Barang Kena Cukai</td>
                    <td class=xl10011096 style='border-left:none'>
                        <textarea type="text" class="area-big" name="InputNBRBarangKenaCukai"></textarea>
                    </td>
                    <td class=xl6911096></td>
                    <td class=xl6911096 colspan=3 style='border-right:.5pt solid black'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jakarta, <span style='mso-spacerun:yes'></span><?= date_indo(date('Y-m-d')); ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pejabat Bea dan Cukai</td>
                </tr>
                <tr height=17 style='height:12.75pt'>
                    <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
                    <td class=xl6911096 colspan=12>setelah tanggal selesai keluarnya Barang Kena Cukai. Jika jangka waktu</td>
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
                    <td class=xl6911096 colspan=12>telah dilewati, maka Pengusaha dikenakan sanksi sesuai ketentuan yang<span style='mso-spacerun:yes'></span></td>
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
                    <td class=xl6911096><span style='mso-spacerun:yes'></span></td>
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
                    <td colspan=5 class=xl7511096 style='border-right:.5pt solid black'>Nomor Buku Rekening<span style='mso-spacerun:yes'></span></td>
                    <td class=xl9511096 style='border-left:none'></td>
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
                    <td class=xl10011096 style='border-left:none'>
                        <textarea type="text" class="area-big" name="InputNBRKredit"></textarea>
                    </td>
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
                    <td class=xl6911096 colspan=3 style='border-right:.5pt solid black'>Nip :………………………….</td>
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
            </table>
            <br>
            <table border=0 cellpadding=0 cellspacing=0 width=695 class=xl6912727 style='border-collapse:collapse;table-layout:fixed;width:100%'>
                <col class=xl6912727 width=64 span=8 style='width:48pt'>
                <col class=xl6912727 width=15 style='mso-width-source:userset;mso-width-alt:548;width:11pt'>
                <col class=xl6912727 width=168 style='mso-width-source:userset;mso-width-alt:6144;width:126pt'>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7312727 colspan=10 width=695 style='height:14.25pt;border-right:.5pt solid black;width:521pt'><a name="RANGE!A1:J78">I. CATATAN HASIL PEMERIKSAAN / PENYEGELAN BKC YANG AKAN DIKELUARKAN :</a></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'><br>Pengusaha/Pejabat Bea dan Cukai</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727><span style='mso-spacerun:yes'></span></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>Nama</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=4 style='height:14.25pt'>Penyegelan dilakukan terhadap :</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>N.I.P</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8412727 colspan=3 style='height:14.25pt'>Jenis dan Nomor Segel :</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl8512727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8612727 colspan=6 style='height:14.25pt'>J. CATATAN HASIL PEMERIKSAAN / PENGELUARAN :</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>(Disegel / Tidak disegel *)</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>(Sesuai / Tidak Sesuai *)</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Tempat, Tanggal Pemeriksaan</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Pengusaha/Pejabat Bea dan Cukai</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl8212727></td>
                    <td class=xl8212727></td>
                    <td class=xl8312727>&nbsp;</td>
                </tr>
                <tr height=6 style='mso-height-source:userset;height:4.5pt'>
                    <td height=6 class=xl7612727 style='height:4.5pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>Jenis Alat Angkut<span style='mso-spacerun:yes'></span>:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>Nama</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>Nomor Polisi<span style='mso-spacerun:yes'></span>:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>N.I.P</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8412727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl8512727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8612727 colspan=10 style='height:14.25pt;border-right:.5pt solid black'>K. CATATAN HASIL PEMERIKSAAN PEMASUKAN BKC DI TEMPAT TUJUAN/TEMPAT PENIMBUNAN TERAKHIR :</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=5 style='height:14.25pt'>Sesuai / Tidak Sesuai karena*) …………….</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'><br>Tempat, Tanggal Pemeriksaan</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Pengusaha/Pejabat Bea dan Cukai</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>Nama</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>N.I.P</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8412727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl8512727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8612727 colspan=10 style='height:14.25pt;border-right:.5pt solid black'>N. CATATAN BENDAHARAWAN KPPBC YANG MENGAWASI TEMPAT TUJUAN / PELABUHAN MUAT :</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=5 style='height:14.25pt'>Sesuai / Tidak Sesuai karena*) …………….</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=4 style='height:14.25pt'>Nomor Buku Pengawasan<span style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Tempat, Tanggal Pemeriksaan</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>Nomor Surat Pengantar<span style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Pengusaha/Pejabat Bea dan Cukai</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>Tanggal<span style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727 colspan=2></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl8212727></td>
                    <td class=xl8212727></td>
                    <td class=xl8312727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>Nama</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8712727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>N.I.P</td>
                    <td class=xl7012727>:</td>
                    <td class=xl8512727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl6812727 colspan=3 style='height:14.25pt'>*)<span style='mso-spacerun:yes'></span>Coret yang tidak perlu</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                </tr>
                <tr height=0 style='display:none'>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=15 style='width:11pt'></td>
                    <td width=168 style='width:126pt'></td>
                </tr>
            </table>
        </div>
    </div>
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
<?php
// include "include/panel.php"; 
?>
<!-- <script src="../assets/js/app.min.js"></script> -->
<script src="../assets/js/theme/default.min.js"></script>
<script src="../assets/plugins/d3/d3.min.js"></script>
<script src="../assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="../assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="../assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="../assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script src="../assets/plugins/gritter/js/jquery.gritter.js"></script>
<script>
    // Show and Hidden
    $(function() {
        $("#IDJenisBarangKenaCukai").change(function() {
            if ($(this).val() == 4) {
                $("#OthersJenisBarangKenaCukai").show();
            } else {
                $("#OthersJenisBarangKenaCukai").hide();
            }
        });
    });
    $(function() {
        $("#IDJenisPemberitahuan").change(function() {
            if ($(this).val() == 4) {
                $("#OthersJenisPemberitahuan").show();
            } else {
                $("#OthersJenisPemberitahuan").hide();
            }
        });
    });
    // IDNamaKodeNegaraTujuan
    $(function() {
        $("#IDNamaKodeNegaraTujuan").change(function() {
            if ($(this).val() == 'NPPBKC') {
                $("#IdentitasTwoNPPBKC").show();
                $("#IdentitasTwoNPP").hide();
            } else if ($(this).val() == 'NPP') {
                $("#IdentitasTwoNPPBKC").hide();
                $("#IdentitasTwoNPP").show();
            } else {
                $("#IdentitasTwoNPPBKC").hide();
                $("#IdentitasTwoNPP").hide();
            }
        });
    });
    // show-address-identitas-two
    function showAddress(c_str) {
        if (c_str == "") {
            document.getElementById("show-address-identitas-two").innerHTML = "";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("show-address-identitas-two").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "function/function_get.php/get_c_client?c_id=" + c_str, true);
        xmlhttp.send();
    }

    // showKodeOne
    function showKodeOne(kode_one) {
        if (kode_one == "") {
            document.getElementById("InputshowKodeOne").innerHTML = "";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("InputshowKodeOne").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "function/function_get.php/get_kode_one?c_kode_one=" + kode_one, true);
        xmlhttp.send();
    }
    // showKodeTwo
    function showKodeTwo(kode_two) {
        if (kode_two == "") {
            document.getElementById("InputshowKodeTwo").innerHTML = "";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("InputshowKodeTwo").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "function/function_get.php/get_kode_two?c_kode_two=" + kode_two, true);
        xmlhttp.send();
    }
    // showKodeThree
    function showKodeThree(kode_three) {
        if (kode_three == "") {
            document.getElementById("InputshowKodeThree").innerHTML = "";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("InputshowKodeThree").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "function/function_get.php/get_kode_three?c_kode_three=" + kode_three, true);
        xmlhttp.send();
    }
    // Show and Hide
    $(function() {
        $("#IDJaminan").change(function() {
            if ($(this).val() == 4) {
                $("#OthersJaminan").show();
            } else {
                $("#OthersJaminan").hide();
            }
        });
    });
</script>
</body>
</html>