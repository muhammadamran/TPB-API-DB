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

// BAHANBAKUTARIF view_plb_barangtarif
$DataCK5PLB = $dbcon->query("SELECT KODE_KOMODITI_CUKAI FROM view_plb_barangtarif WHERE NOMOR_AJU='$dataGETAJU' GROUP BY NOMOR_AJU");
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

// Simpan CKl5plb
if (isset($_POST["SimpanCK5PLB"])) {
    $ID = $_GET['AJU'];
    // FOR UPDATE DATA
    // KODE_KOMODITI_CUKAI // plb_bahanbakutarif
    // KODE_KOMODITI_CUKAI_LAINNYA // plb_bahanbakutarif
    $InputJenisBarangKenaCukai          = $_POST['InputJenisBarangKenaCukai'];
    if ($InputJenisBarangKenaCukai == 4) {
       $InputOthersJenisBarangKenaCukai = $_POST['InputOthersJenisBarangKenaCukai'];
    } else {
       $InputOthersJenisBarangKenaCukai = NULL;
    }

    // KODE_CARA_BAYAR // plb_header
    $InputCaraPelunasan                 = $_POST['InputCaraPelunasan'];
    // KODE_FASILITAS // plb_header
    $InputStatusCukai                   = $_POST['InputStatusCukai'];

    // KODE_JENIS_PEMBERITAHUAN // plb_header
    // KODE_JENIS_PEMBERITAHUAN_LAINNYA // plb_header
    $InputJenisPemberitahuan            = $_POST['InputJenisPemberitahuan'];
    if ($InputJenisPemberitahuan == 4) {
       $InputOthersJenisPemberitahuan   = $_POST['InputOthersJenisPemberitahuan'];
    } else {
       $InputOthersJenisPemberitahuan = NULL;
    }

    // TEMPAT ASAL PEMASOK
    // ID_PENGUSAHA // plb_header
    $NameNPWPUpdatePemasok              = $_POST['NameNPWPUpdatePemasok'];
    // PENGUSAHA // plb_header
    $InputNamaTempatAsalPemasok         = $_POST['InputNamaTempatAsalPemasok'];
    // ALAMAT_PENGUSAHA // plb_header
    $NameAlamatUpdatePemasok            = $_POST['NameAlamatUpdatePemasok'];

    // KPPBC // plb_header
    $InputNamaKodeOne                   = $_POST['InputNamaKodeOne'];

    // TEMPAT TUJUAN PENGGUNA
    // ID_PENERIMA_BARANG
    $NameNPWPUpdateTempatTujuan         = $_POST['NameNPWPUpdateTempatTujuan'];
    // NAMA_PENERIMA_BARANG
    $InputNamaTempatTujuan              = $_POST['InputNamaTempatTujuan'];
    // ALAMAT_PENERIMA_BARANG
    $NameAlamatUpdateTempatTujuan       = $_POST['NameAlamatUpdateTempatTujuan'];

    // KODE_KANTOR_TUJUAN // plb_header
    $InputNamaKodeTwo                   = $_POST['InputNamaKodeTwo'];

    // KODE_CARA_ANGKUT // plb_header
    $InputCaraPengangkutan              = $_POST['InputCaraPengangkutan'];

    // UNTUK PEMBAYARAN / JAMINAN
    // KODE_PEMBAYAR // plb_header
    $InputPembayaran                    = $_POST['InputPembayaran'];

    // KODE_JAMINAN // plb_header
    // KODE_JAMINAN_LAINNYA // plb_header
    $InputJaminan                       = $_POST['InputJaminan'];
    if ($InputJaminan == 4) {
       $OthersJaminan   = $_POST['OthersJaminan'];
    } else {
       $OthersJaminan = NULL;
    }

    $query = $dbcon->query("UPDATE plb_bahanbakutarif SET KODE_KOMODITI_CUKAI='$InputJenisBarangKenaCukai',
                                                          KODE_KOMODITI_CUKAI_LAINNYA='$InputOthersJenisBarangKenaCukai'
                                                      WHERE NOMOR_AJU='$ID'");

    // var_dump($query);exit;

    $query .= $dbcon->query("UPDATE plb_header SET KODE_CARA_BAYAR='$InputCaraPelunasan',
                                                   KODE_FASILITAS='$InputStatusCukai',
                                                   KODE_JENIS_PEMBERITAHUAN='$InputJenisPemberitahuan',
                                                   KODE_JENIS_PEMBERITAHUAN_LAINNYA='$InputOthersJenisPemberitahuan',
                                                   ID_PENGUSAHA='$NameNPWPUpdatePemasok',
                                                   PENGUSAHA='$InputNamaTempatAsalPemasok',
                                                   ALAMAT_PENGUSAHA='$NameAlamatUpdatePemasok',
                                                   KPPBC='$InputNamaKodeOne',
                                                   ID_PENERIMA_BARANG='$NameNPWPUpdateTempatTujuan',
                                                   NAMA_PENERIMA_BARANG='$InputNamaTempatTujuan',
                                                   ALAMAT_PENERIMA_BARANG='$NameAlamatUpdateTempatTujuan',
                                                   KODE_KANTOR_TUJUAN='$InputNamaKodeTwo',
                                                   KODE_CARA_ANGKUT='$InputCaraPengangkutan',
                                                   KODE_PEMBAYAR='$InputPembayaran',
                                                   KODE_JAMINAN='$InputJaminan',
                                                   KODE_JAMINAN_LAINNYA='$OthersJaminan'
                                               WHERE NOMOR_AJU='$ID'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Departemen';
    $InputDescription     = $me . " Insert Data: " .  $NameDepartment .", Simpan Data Sebagai Log Departemen";
    $InputAction          = 'Insert';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='report_ck5_plb_hal_1_edit.php?AJU=$ID';</script>";
    } else {
        echo "<script>window.location.href='report_ck5_plb_hal_1_edit.php?AJU=$ID';</script>";
    }
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
    <title>Laporan CK5 PLB - Halaman 1</title>
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
    <!-- <link href="assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" /> -->
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
    <form action="" method="POST">
        <div class="invoice-company">
            <div style="display: flex;justify-content: space-between;margin-bottom: -18px;">
                <div>
                </div>
                <div>
                    <a href="./report_ck5_plb_hal_1.php?AJU=<?= $_GET['AJU']; ?>" class="btn btn-sm btn-white m-b-10" title="Update CK5PLB" style="padding: 7px;">
                        <div style="display: flex;justify-content: space-between;align-items: end;">
                            <i class="far fa-arrow-alt-circle-left" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Kembali
                        </div>
                    </a>
                    <button type="submit" name="SimpanCK5PLB" class="btn btn-sm btn-primary m-b-10" title="Update CK5PLB" style="padding: 7px;">
                        <div style="display: flex;justify-content: space-between;align-items: end;">
                            <i class="fas fa-save" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Simpan CK5 PLB
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <br>
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
                <div style="display: grid;justify-content: left;">
                    <font style="font-size: 24px;font-weight: 800;">LAPORAN CK5 PLB - Halaman 1</font>
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
                        <td colspan=24 height=21 class=xl14911096 style='height:15.75pt;border-top: 0.5pt solid windowtext;border-left: 0.5pt solid windowtext;border-right: 0.5pt solid windowtext;'>PEMBERITAHUAN MUTASI BARANG KENA CUKAI ( PMBKC )</td>
                        <td class=xl7011096 style="border-top: 0.5pt solid windowtext;border-right: 0.5pt solid windowtext;">CK<span style='mso-spacerun:yes'></span>5</td>
                    </tr>
                    <tr height=23 style='mso-height-source:userset;height:17.25pt'>
                        <td colspan=25 class=xl8311096 colspan=2 style="height:17.25pt;text-transform: uppercase;font-weight: 800;border-top: 0.5pt solid windowtext;border-left: 0.5pt solid windowtext;border-right: 0.5pt solid windowtext;">HEADER</td>
                    </tr>
                    <tr height=17 style='height:12.75pt'>
                        <td class=xl15011096 ></td>
                        <td colspan=1 style="height:12.75pt;border-top: 0.5pt solid windowtext;" height=17 style='height:12.75pt'>Kantor</td>
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
                        <td class=xl7411096></td>
                        <td colspan=1 style="height:12.75pt;" height=17 style='height:12.75pt'>Nomor Pengajuan</td>
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
                        <td class=xl7411096></td>
                        <td colspan=1 style="height:12.75pt;" height=18 style='height:13.5pt'>Nomor Pendaftaran</td>
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
                    <tr height=18 style='mso-height-source:userset;height:13.5pt;background: yellow;'>
                        <td class=xl7811096></td>
                        <td height=18 style='height:13.5pt'>A. Jenis Barang Kena Cukai</td>
                        <td class=xl6911096></td>
                        <td class=xl7611096>:</td>
                        <!-- <td class="xl7911096"><?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?></td> -->
                        <td>
                            <select style="border: 1;background: transparent;width: 90px;" name="InputJenisBarangKenaCukai" id="IDJenisBarangKenaCukai">
                            	<?php if ($resultBahanBakuTarif['KODE_KOMODITI_CUKAI'] == NULL || $resultBahanBakuTarif['KODE_KOMODITI_CUKAI'] == '') { ?>
    	                            <option>-- Pilih --</option>
                            	<?php } else { ?> 
    	                            <option value="<?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?>"><?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?></option>
    	                            <option>-- Pilih --</option>
                            	<?php } ?>
                                <option value="1">1 - Etil Alkohol</option>
                                <option value="2">2 - MMEA</option>
                                <option value="3">3 - Hasil Tembakau</option>
                                <option value="4">4 - Lainnya</option>
                            </select>
                        </td>
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
                        <td class=xl7811096></td>
                        <td height=18 style='height:13.5pt'><font style="color: transparent;">A. </font>Lainnya</td>
                        <td class=xl6911096></td>
                        <td class=xl7611096>:</td>
                        <!-- <td class="xl7911096"><?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?></td> -->
                        <td colspan=21 style="border-right: 0.5pt solid windowtext;">
                            <input type="text" name="InputOthersJenisBarangKenaCukai">
                        </td>
                    </tr>
                    <!-- End Show Jenis Barang Kena Cukai -->
                    <tr height=17 style='height:12.75pt;background: yellow;'>
                        <td class=xl7811096></td>
                        <td height=17 style='height:12.75pt'>B. Cara Pelunasan</td>
                        <td class=xl6911096></td>
                        <td class=xl7611096>:</td>
                        <!-- <td class="xl7911096"><?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?></td> -->
                        <td>
                            <select style="border: 1;background: transparent;width: 90px;" name="InputCaraPelunasan">
                            	<?php if ($resultDataCK5PLB['KODE_CARA_BAYAR'] == NULL || $resultDataCK5PLB['KODE_CARA_BAYAR'] == '') { ?>
    	                            <option>-- Pilih --</option>
                        		<?php } else { ?>
    	                        	<option value="<?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?>"><?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?></option>
    	                            <option>-- Pilih --</option>
                        		<?php } ?>
                                <option value="1">1 - Pembayaran</option>
                                <option value="2">2 - Pelekatan Pita Cukai</option>
                                <option value="3">3 - Pembubuhan Tanda Lunas Cukai Lainnya</option>
                            </select>
                        </td>
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
                    <tr height=17 style='height:12.75pt;background: yellow;'>
                        <td class=xl7811096></td>
                        <td height=17 style='height:12.75pt'>C. Status Cukai</td>
                        <td class=xl6911096></td>
                        <td class=xl7611096>:</td>
                        <!-- <td class="xl7911096"><?= $resultDataCK5PLB['KODE_FASILITAS'] ?></td> -->
                        <td>
                            <select style="border: 1;background: transparent;width: 90px;" name="InputStatusCukai">
                                <?php if ($resultDataCK5PLB['KODE_FASILITAS'] == NULL || $resultDataCK5PLB['KODE_FASILITAS'] == '') { ?>
    	                            <option>-- Pilih --</option>
                        		<?php } else { ?>
    	                        	<option value="<?= $resultDataCK5PLB['KODE_FASILITAS']; ?>"><?= $resultDataCK5PLB['KODE_FASILITAS']; ?></option>
    	                            <option>-- Pilih --</option>
                        		<?php } ?>
                                <option value="1">1 - Belum Dilunasi</option>
                                <option value="2">2 - Sudah Dilunasi</option>
                            </select>
                        </td>
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
                    <tr height=17 style='height:12.75pt; background: yellow;'>
                        <td class=xl7811096></td>
                        <td height=17 style='height:12.75pt'>D. Jenis Pemberitahuan</td>
                        <td class=xl6911096></td>
                        <td class=xl7611096>:</td>
                        <!-- <td class="xl7911096"><?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] ?></td> -->
                        <td>
                            <select style="border: 1;background: transparent;width: 90px;" name="InputJenisPemberitahuan" id="IDJenisPemberitahuan">
                                <?php if ($resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] == NULL || $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] == '') { ?>
    	                            <option>-- Pilih --</option>
                        		<?php } else { ?>
    	                        	<option value="<?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?>"><?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?></option>
    	                            <option>-- Pilih --</option>
                        		<?php } ?>
                                <option value="1">1 - Dibayar</option>
                                <option value="2">2 - Tidak Dipungut</option>
                                <option value="3">3 - Dibebaskan</option>
                                <option value="4">4 - Lainnya</option>
                            </select>
                        </td>
                        <td class=xl6911096></td>
                        <td class=xl7611096>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td class=xl6911096 colspan=3>1. Dibayar</td>
                        <td class=xl7611096>2.</td>
                        <td class=xl6911096 colspan=4>Tidak Dipungut</td>
                        <td class=xl7611096>3.</td>
                        <td class=xl6911096 colspan=1>Dibebaskan</td>
                        <td class=xl6911096></td>
                        <td class=xl6911096></td>
                        <td class=xl6911096></td>
                        <td class=xl6911096></td>
                        <td class=xl7611096>4.</td>
                        <td class=xl6911096 colspan=2>Lainnya……..</td>
                        <td class=xl7711096>&nbsp;</td>
                    </tr>
                    <!-- Show Jenis Pemberitahuan -->
                    <tr id="OthersJenisPemberitahuan" height=18 style='mso-height-source:userset;height:13.5pt;display: none;'>
                        <td class=xl7811096></td>
                        <td height=18 style='height:13.5pt'><font style="color: transparent;">A. </font>Lainnya</td>
                        <td class=xl6911096></td>
                        <td class=xl7611096>:</td>
                        <td colspan=21 style="border-right: 0.5pt solid windowtext;">
                            <input type="text" name="InputOthersJenisPemberitahuan">
                        </td>
                    </tr>
                    <!-- End Show Jenis Pemberitahuan -->
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
                        <td colspan=25 class=xl8311096 colspan=2 style="height:17.25pt;text-transform: uppercase;font-weight: 800;border-left: 0.5pt solid windowtext;border-right: 0.5pt solid windowtext;">E. <u>Data Pemberitahuan</u></td>
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
                    <tr height=21 style='mso-height-source:userset;height:15.75pt;background: yellow;'>
                        <td height=21 class=xl8611096 style='height:15.75pt'>3.</td>
                        <td class=xl8711096>Nama Alamat</td>
                        <td class=xl8811096 width=17 style='width:13pt'>:</td>
                        <!-- <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;width:197pt'><?= $resultDataCK5PLB['PERUSAHAAN']; ?></td> -->
                        <td colspan=10 class=xl8911096 width=260 style='border-right:.5pt solid black;width:197pt'>
                            <select style="border: transparent;background: transparent;width: 215px;" name="InputNamaTempatAsalPemasok" id="IDNamaTempatAsalPemasok" onchange="showTempatAsalPemasok(this.value)">
                                <?php if ($resultDataCK5PLB['PERUSAHAAN'] == NULL || $resultDataCK5PLB['PERUSAHAAN'] == '') { ?>
                                    <option>-- Nama Pengusaha --</option>
                                <?php } else { ?>
                                    <option value="<?= $resultDataCK5PLB['PERUSAHAAN'] ?>"><?= $resultDataCK5PLB['PERUSAHAAN'] ?></option>
                                    <option>-- Nama Pengusaha --</option>
                                <?php } ?>
                                <?php
                                $resultIdentitasTwo = $dbcon->query("SELECT ID,NPWP,NAMA FROM referensi_pengusaha WHERE NPWP!='' ORDER BY ID ASC");
                                foreach ($resultIdentitasTwo as $rowIdentitasTwo) {
                                ?>
                                    <option value="<?= $rowIdentitasTwo['ID'] ?>"><?= $rowIdentitasTwo['NPWP'] ?> - <?= $rowIdentitasTwo['NAMA'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class=xl8611096 style='border-left:none'>13.</td>
                        <td class=xl6911096 colspan=3>Nama Alamat</td>
                        <td class=xl6911096></td>
                        <td class=xl8811096 width=20 style='width:15pt'>:</td>
                        <!-- <td class=xl8711096 colspan=6 style="border-right: 0.5pt solid black;"><?= $resultDataCK5PLB['NAMA_PENERIMA_BARANG']; ?></td> -->
                        <td class=xl8711096 colspan=6 style="border-right: 0.5pt solid black;">
                            <select style="border: transparent;background: transparent;width: 215px;" name="InputNamaTempatTujuan" id="IDNamaTempatTujuan" onchange="showTempatTujuan(this.value)">
                                <?php if ($resultDataCK5PLB['NAMA_PENERIMA_BARANG'] == NULL || $resultDataCK5PLB['NAMA_PENERIMA_BARANG'] == '') { ?>
                                    <option>-- Nama Pengusaha --</option>
                                <?php } else { ?>
                                    <option value="<?= $resultDataCK5PLB['NAMA_PENERIMA_BARANG'] ?>"><?= $resultDataCK5PLB['NAMA_PENERIMA_BARANG'] ?></option>
                                    <option>-- Nama Pengusaha --</option>
                                <?php } ?>
                                <?php
                                $resultIdentitasTwo = $dbcon->query("SELECT ID,NPWP,NAMA FROM referensi_pengusaha WHERE NPWP!='' ORDER BY ID ASC");
                                foreach ($resultIdentitasTwo as $rowIdentitasTwo) {
                                ?>
                                    <option value="<?= $rowIdentitasTwo['ID'] ?>"><?= $rowIdentitasTwo['NPWP'] ?> - <?= $rowIdentitasTwo['NAMA'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
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
                    <tr height=21 style='mso-height-source:userset;height:15.75pt;background: yellow;'>
                        <td height=21 class=xl8511096 style='height:15.75pt'>4.</td>
                        <td class=xl6911096>Nama, Kode Kantor</td>
                        <td class=xl7611096>:</td>
                        <!-- <td class=xl6911096 colspan=6><?= $resultDataNamaKantor['URAIAN_KANTOR']; ?></td> -->
                        <td class=xl6911096 style="background: yellow" colspan=6>
                            <select style="border: transparent;background: transparent;width: 215px;" name="InputNamaKodeOne" id="IDNamaKodeOne" onchange="showKodeOne(this.value)">
                                <?php if ($resultDataCK5PLB['KPPBC'] == NULL || $resultDataCK5PLB['KPPBC'] == '') { ?>
                                    <option>-- Kantor Pabean --</option>
                                <?php } else { ?>
                                    <option value="<?= $resultDataCK5PLB['KPPBC']; ?>"><?= $resultDataCK5PLB['KPPBC']; ?> - <?= $resultDataNamaKantor['URAIAN_KANTOR']; ?></option>
                                    <option>-- Kantor Pabean --</option>
                                <?php } ?>
                                <?php
                                $resultKodeOne = $dbcon->query("SELECT * FROM referensi_kantor_pabean 
                                                                ORDER BY ID ASC");
                                foreach ($resultKodeOne as $rowKodeOne) {
                                ?>
                                    <option value="<?= $rowKodeOne['KODE_KANTOR'] ?>"><?= $rowKodeOne['KODE_KANTOR'] ?> - <?= $rowKodeOne['URAIAN_KANTOR'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class=xl6911096></td>
                        <td class=xl6911096></td>
                        <td class=xl6911096></td>
                        <td class=xl7711096>&nbsp;</td>
                        <td class=xl8511096 style='border-left:none'>14.</td>
                        <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
                        <td class=xl6911096></td>
                        <td class=xl7611096>:</td>
                        <!-- <td class=xl6911096 colspan=6 style='border-right:.5pt solid black'><?= $resultDataNamaKantorTujuan['URAIAN_KANTOR']; ?></td> -->
                        <td class=xl6911096 style="background: yellow" colspan=6>
                            <select style="border: transparent;background: transparent;width: 215px;" name="InputNamaKodeTwo" id="IDNamaKodeTwo" onchange="showKodeTwo(this.value)">
                                <?php if ($resultDataCK5PLB['KODE_KANTOR_TUJUAN'] == NULL || $resultDataCK5PLB['KODE_KANTOR_TUJUAN'] == '') { ?>
                                    <option>-- Kantor Pabean --</option>
                                <?php } else { ?>
                                    <option value="<?= $resultDataCK5PLB['KODE_KANTOR_TUJUAN']; ?>"><?= $resultDataCK5PLB['KODE_KANTOR_TUJUAN']; ?> - <?= $resultDataNamaKantorTujuan['URAIAN_KANTOR']; ?></option>
                                    <option>-- Kantor Pabean --</option>
                                <?php } ?>
                                <?php
                                $resultKodeTwo = $dbcon->query("SELECT * FROM referensi_kantor_pabean 
                                                                ORDER BY ID ASC");
                                foreach ($resultKodeTwo as $rowKodeTwo) {
                                ?>
                                    <option value="<?= $rowKodeTwo['KODE_KANTOR'] ?>"><?= $rowKodeTwo['KODE_KANTOR'] ?> - <?= $rowKodeTwo['URAIAN_KANTOR'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
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
                        <td colspan=3 class=xl14411096 style='border-right:.5pt solid black' id="InputshowKodeOne"><?= $resultDataCK5PLB['KPPBC']; ?></td>
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
                        <td class=xl7911096 id="InputshowKodeTwo"><?= $resultDataCK5PLB['KODE_KANTOR_TUJUAN']; ?></td>
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
                        <td class=xl6911096 colspan=8 style="background: transparent">
                            <div style="display: grid;">
                                <?php
                                $dataNISJ = $dbcon->query("SELECT NOMOR_AJU, NOMOR_DOKUMEN, TANGGAL_DOKUMEN FROM plb_dokumen WHERE NOMOR_AJU='$dataGETAJU'");
                                    if (mysqli_num_rows($dataNISJ) > 0) {
                                        while ($rowdataNISJ = mysqli_fetch_array($dataNISJ)) {
                                ?>
                                    <font><?= $rowdataNISJ['NOMOR_DOKUMEN']; ?></font>
                                <?php } ?>
                                <?php } else { ?>
                                    Kosong
                                <?php } ?>
                            </div>
                        </td>
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
                        <td class=xl12711096 colspan=4 style="background: transparent;">
                            <div style="display: grid;">
                                <?php
                                $dataNISJTanggal = $dbcon->query("SELECT NOMOR_AJU, NOMOR_DOKUMEN, TANGGAL_DOKUMEN FROM plb_dokumen WHERE NOMOR_AJU='$dataGETAJU'");
                                    if (mysqli_num_rows($dataNISJTanggal) > 0) {
                                        while ($rowdataNISJTanggal = mysqli_fetch_array($dataNISJTanggal)) {
                                ?>
                                    <font><?= $rowdataNISJTanggal['TANGGAL_DOKUMEN']; ?></font>
                                <?php } ?>
                                <?php } else { ?>
                                    Kosong
                                <?php } ?>
                            </div>
                        </td>
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
                        <td style="background: yellow;" height=21 class=xl8511096 style='height:15.75pt'>9.</td>
                        <td style="background: yellow;" class=xl6911096>Cara Pengangkutan</td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl7611096>:</td>
                        <!-- <td style="background: yellow;" class="xl7911096"><?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?></td> -->
                        <td style="background: yellow;">
                            <select style="border: 1;background: transparent;width: 80px;" name="InputCaraPengangkutan">
                            	<?php if ($resultDataCK5PLB['KODE_CARA_ANGKUT'] == NULL || $resultDataCK5PLB['KODE_CARA_ANGKUT'] == '') { ?>
    	                            <option>-- Pilih --</option>
                        		<?php } else { ?>
    	                            <option value="<?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?>"><?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?></option>
    	                            <option>-- Pilih --</option>
    	                		<?php } ?>
                                <option value="1">1 - Darat</option>
                                <option value="2">2 - Laut</option>
                                <option value="3">3 - Udara</option>
                            </select>
                        </td>
                        <td style="background: yellow;" class=xl9211096>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl6911096>&nbsp;&nbsp;1. Darat 2. Laut 3. Udara</td>
                        <td style="background: yellow;" class=xl6911096 colspan=3></td>
                        <td style="background: yellow;" class=xl7711096 colspan=2>&nbsp;</td>
                        <td class=xl7611096>19.</td>
                        <td class=xl6911096 colspan=3>Nama, Kode Kantor</td>
                        <td class=xl6911096></td>
                        <td class=xl6911096>:</td>
                        <td class=xl6911096 colspan=2>........................................</td>
                        <td class=xl6911096></td>
                        <td class=xl6911096></td>
                        <td class=xl6911096></td>
                        <td class=xl9111096></td>
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
                        <td colspan=25 class=xl8311096 colspan=2 style="height:17.25pt;text-transform: uppercase;font-weight: 800;border-left: 0.5pt solid windowtext;border-right: 0.5pt solid windowtext;">F. <u>Uraian Barang</u></td>
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
                        <td height=21 class=xl10411096 colspan=2 style="height:15.75pt;font-weight: 800;text-transform: uppercase;">G. <u>Pemberitahuan</u><span style='mso-spacerun:yes'></span>
                            <font class="font511096"></font>
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
                        <td class=xl10411096 colspan=5 style="height:15.75pt;font-weight: 800;text-transform: uppercase;">H. <u>Untuk Pembayaran / Jaminan</u></td>
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
                        <td class=xl6911096 colspan=10>Dengan ini saya menyatakan bertanggung jawab atas kebenaran</td>
                        <td class=xl6911096></td>
                        <td class=xl7711096>&nbsp;</td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl7611096>a.</td>
                        <td style="background: yellow;" class=xl6911096 colspan=2>Pembayaran&nbsp;:</td>
                        <!-- <td style="background: yellow;" class="xl7911096"><?= $resultDataCK5PLB['KODE_PEMBAYAR'] ?></td> -->
                        <td style="background: yellow;" style="background: yellow;">
                            <select style="border: 1;background: transparent;width: 90px;" name="InputPembayaran">
                                <?php if ($resultDataCK5PLB['KODE_PEMBAYAR'] == NULL || $resultDataCK5PLB['KODE_PEMBAYAR'] == '') { ?>
    	                            <option>-- Pilih --</option>
                            	<?php } else { ?>
    	                        	<option value="<?= $resultDataCK5PLB['KODE_PEMBAYAR'] ?>"><?= $resultDataCK5PLB['KODE_PEMBAYAR'] ?></option>
    	                            <option>-- Pilih --</option>
                            	<?php } ?>
                                <option value="1">1 - Bank Devisa</option>
                                <option value="2">2 - Kantor</option>
                                <option value="3">3 - Kantor Pos</option>
                            </select>
                        </td>
                        <td style="background: yellow;"></td>
                        <td style="background: yellow;" class=xl6911096 colspan=2>1. Bank Devisa</td>
                        <td style="background: yellow;" class=xl6911096 colspan=3>2. Kantor</td>
                        <td style="background: yellow;border-right:.5pt solid black" class=xl6911096><span style='mso-spacerun:yes'></span>3. Kantor Pos</td>
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
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl7611096>b.</td>
                        <td style="background: yellow;" class=xl6911096 colspan=2>Jaminan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                        <!-- <td style="background: yellow;" class="xl7911096"><?= $resultDataCK5PLB['KODE_JAMINAN'] ?></td> -->
                        <td style="background: yellow;">
                            <select style="border: 1;background: transparent;width: 90px;" name="InputJaminan" id="IDJaminan">
                                <?php if ($resultDataCK5PLB['KODE_JAMINAN'] == NULL || $resultDataCK5PLB['KODE_JAMINAN'] == '') { ?>
    	                            <option>-- Pilih --</option>
                            	<?php } else { ?>
    	                        	<option value="<?= $resultDataCK5PLB['KODE_JAMINAN'] ?>"><?= $resultDataCK5PLB['KODE_JAMINAN'] ?></option>
    	                            <option>-- Pilih --</option>
                            	<?php } ?>
                                <option value="1">1 - Tunai</option>
                                <option value="2">2 - Bank Garansi</option>
                                <option value="3">3 - Excise Bond</option>
                                <option value="4">4 - Lainnya</option>
                            </select>
                        </td>
                        <td style="background: yellow;"></td>
                        <td style="background: yellow;" class=xl6911096 colspan=2>1. Tunai</td>
                        <td style="background: yellow;" class=xl6911096 colspan=3>2. Bank Garansi</td>
                        <td style="background: yellow;" class=xl10511096>3. Excise Bond</td>
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
                        <td style="background: yellow;" class=xl7811096 style='border-left:none'>&nbsp;</td>
                        <td style="background: yellow;" class=xl7611096></td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl6911096 colspan=2>4. Lainnya</td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl6911096></td>
                        <td style="background: yellow;" class=xl7711096>&nbsp;</td>
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
                        <td colspan=10 class=xl12811096 style='border-right:.5pt solid black'><?= $resultHeadSetting['pic_name']; ?></td>
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
                        <td colspan=10 class=xl7611096 style='border-right:.5pt solid black'>&nbsp;<?= $resultHeadSetting['pic_title']; ?></td>
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
                        <td height=17 style="border-left: 0.5pt solid windowtext;text-transform: uppercase;font-weight: 800;">I. <u>Diisi Oleh Pejabat Bea dan Cukai :</u><span style='mso-spacerun:yes'></span></td>
                        <td class=xl10811096 colspan=5></td>
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
                        <td class=xl9511096 style='border-left:none'></td>
                        <td colspan=4 class=xl8511096 style='border-right:.5pt solid black'></td>
                    </tr>
                    <tr height=17 style='height:12.75pt'>
                        <td height=17 class=xl7811096 style='height:12.75pt'>&nbsp;</td>
                        <td class=xl6911096 colspan=12>dalam jangka waktu selambat-lambatnya pada hari ke………………………</td>
                        <td class=xl6911096></td>
                        <td class=xl6911096></td>
                        <td colspan=5 class=xl7511096 style='border-right:.5pt solid black'>Barang Kena Cukai</td>
                        <td class=xl10011096 style='border-left:none'></td>
                        <td class=xl6911096></td>
                        <td class=xl6911096 colspan=3 style='border-right:.5pt solid black'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jakarta, <span style='mso-spacerun:yes'></span><?= date_indo(date('Y-m-d')); ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pejabat Bea dan Cukai</td>
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
                        <td class=xl10011096 style='border-left:none'></td>
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
                <br>
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
    </form>
</div>
<?php
// include "include/panel.php"; 
?>
	<script src="assets/js/app.min.js"></script>
	<script src="assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/d3/d3.min.js"></script>
	<script src="assets/plugins/nvd3/build/nv.d3.js"></script>
	<script src="assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
	<script src="assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
	<script src="assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
	<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
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
        // TempatAsalPemasok
        function showTempatAsalPemasok(v_tap) {
          if (v_tap == "") {
            document.getElementById("TempatAsalPemasok").innerHTML = "";
            return;
          }
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("TempatAsalPemasok").innerHTML = this.responseText;
            }
          }
          xmlhttp.open("GET", "function/function_get.php/get_npwp_tap?v_tap=" + v_tap, true);
          xmlhttp.send();
        }

        // TempatTujuan
        function showTempatTujuan(v_ttp) {
          if (v_ttp == "") {
            document.getElementById("TempatTujuan").innerHTML = "";
            return;
          }
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("TempatTujuan").innerHTML = this.responseText;
            }
          }
          xmlhttp.open("GET", "function/function_get.php/get_npwp_tap?v_ttp=" + v_ttp, true);
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