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

// plb_barangtarif
$DataCK5PLB = $dbcon->query("SELECT * FROM plb_barangtarif WHERE NOMOR_AJU='$dataGETAJU' GROUP BY NOMOR_AJU");
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

if (isset($_POST["update_ck5plb_oke"])) {

    $ID = $_POST['AJUDATA'];

    $DataCheckPemasok              = $_POST['DataCheckPemasok'];
    if ($DataCheckPemasok == 1) {
        // TEMPAT ASAL PEMASOK
        // ID_PENGUSAHA // plb_header
        $NameNPWPUpdatePemasok              = $_POST['NameNPWPUpdatePemasok'];
        // PENGUSAHA // plb_header
        $InputNamaTempatAsalPemasok         = $_POST['InputNamaTempatAsalPemasok'];
        // ALAMAT_PENGUSAHA // plb_header
        $NameAlamatUpdatePemasok            = $_POST['NameAlamatUpdatePemasok'];
    } else {
        // TEMPAT ASAL PEMASOK
        // ID_PENGUSAHA // plb_header
        $NameNPWPUpdatePemasok              = $_POST['OnePemasok'];
        // PENGUSAHA // plb_header
        $InputNamaTempatAsalPemasok         = $_POST['TwoPemasok'];
        // ALAMAT_PENGUSAHA // plb_header
        $NameAlamatUpdatePemasok            = $_POST['ThreePemasok'];
    }

    $DataCheckTujuan              = $_POST['DataCheckTujuan'];
    if ($DataCheckTujuan == 1) {
        // TEMPAT TUJUAN PENGGUNA
        // ID_PENERIMA_BARANG
        $NameNPWPUpdateTempatTujuan         = $_POST['NameNPWPUpdateTempatTujuan'];
        // NAMA_PENERIMA_BARANG
        $InputNamaTempatTujuan              = $_POST['InputNamaTempatTujuan'];
        // ALAMAT_PENERIMA_BARANG
        $NameAlamatUpdateTempatTujuan       = $_POST['NameAlamatUpdateTempatTujuan'];
    } else {
        // TEMPAT TUJUAN PENGGUNA
        // ID_PENERIMA_BARANG
        $NameNPWPUpdateTempatTujuan         = $_POST['OneTujuan'];
        // NAMA_PENERIMA_BARANG
        $InputNamaTempatTujuan              = $_POST['TwoTujuan'];
        // ALAMAT_PENERIMA_BARANG
        $NameAlamatUpdateTempatTujuan       = $_POST['ThreeTujuan'];
    }

    // var_dump($NameAlamatUpdatePemasok);exit;


    // KODE_KOMODITI_CUKAI // plb_bahanbakutarif
    // KODE_KOMODITI_CUKAI_LAINNYA // plb_bahanbakutarif
    $InputJenisBarangKenaCukai          = $_POST['InputJenisBarangKenaCukai'];
    if ($InputJenisBarangKenaCukai == 4) {
       $InputJenisBarangKenaCukaiLainnya = $_POST['InputJenisBarangKenaCukaiLainnya'];
    } else {
       $InputJenisBarangKenaCukaiLainnya = NULL;
    }
 
    // KODE_CARA_BAYAR // plb_header
    $InputCaraPelunasan                 = $_POST['InputCaraPelunasan'];
    // KODE_FASILITAS // plb_header
    $InputStatusCukai                   = $_POST['InputStatusCukai'];

    // KODE_JENIS_PEMBERITAHUAN // plb_header
    // KODE_JENIS_PEMBERITAHUAN_LAINNYA // plb_header
    $InputJenisPemberitahuan            = $_POST['InputJenisPemberitahuan'];
    if ($_POST['InputJenisPemberitahuan'] == 4) {
       $InputJenisPemberitahuanLainnya   = $_POST['InputJenisPemberitahuanLainnya'];
    } else {
       $InputJenisPemberitahuanLainnya = NULL;
    }

    // var_dump($InputJenisPemberitahuanLainnya);exit;

    // KPPBC // plb_header
    $InputNamaKodeOne                   = $_POST['InputNamaKodeOne'];

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
       $InputJaminanLainnya             = $_POST['InputJaminanLainnya'];
    } else {
       $InputJaminanLainnya             = NULL;
    }

    $IDSetting                          = $_POST['InputID'];
    $InputNamaPIC                       = $_POST['InputNamaPIC'];
    $InputJabatanPIC                    = $_POST['InputJabatanPIC'];

    $query = $dbcon->query("UPDATE plb_barangtarif SET KODE_KOMODITI_CUKAI='$InputJenisBarangKenaCukai',
                                                       KODE_KOMODITI_CUKAI_LAINNYA='$InputJenisBarangKenaCukaiLainnya'  
                                                      WHERE NOMOR_AJU='$ID'");


    $query .= $dbcon->query("UPDATE plb_header SET KODE_CARA_BAYAR='$InputCaraPelunasan',
                                                   KODE_FASILITAS='$InputStatusCukai',
                                                   KODE_JENIS_PEMBERITAHUAN='$InputJenisPemberitahuan',
                                                   KODE_JENIS_PEMBERITAHUAN_LAINNYA='$InputJenisPemberitahuanLainnya',
                                                   ID_PENGUSAHA='$NameNPWPUpdatePemasok',
                                                   PERUSAHAAN='$InputNamaTempatAsalPemasok',
                                                   ALAMAT_PENGUSAHA='$NameAlamatUpdatePemasok',
                                                   KPPBC='$InputNamaKodeOne',
                                                   ID_PENERIMA_BARANG='$NameNPWPUpdateTempatTujuan',
                                                   NAMA_PENERIMA_BARANG='$InputNamaTempatTujuan',
                                                   ALAMAT_PENERIMA_BARANG='$NameAlamatUpdateTempatTujuan',
                                                   KODE_KANTOR_TUJUAN='$InputNamaKodeTwo',
                                                   KODE_CARA_ANGKUT='$InputCaraPengangkutan',
                                                   KODE_PEMBAYAR='$InputPembayaran',
                                                   KODE_JAMINAN='$InputJaminan',
                                                   KODE_JAMINAN_LAINNYA='$InputJaminanLainnya'
                                               WHERE NOMOR_AJU='$ID'");

    $query = $dbcon->query("UPDATE tbl_setting SET pic_name='$InputNamaPIC',
                                                   pic_title='$InputJabatanPIC'  
                                                   WHERE id='$IDSetting'");

    // var_dump($query);exit;

    // // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'LAPORAN CK5 PLB - Halaman 1';
    $InputDescription     = $me . " Update Data: " .  $NameDepartment .", Simpan Data Sebagai Log LAPORAN CK5 PLB - Halaman 1";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        // echo "<script>window.location.href='report_ck5_plb_hal_1.php?UpdateSuccess=true';</script>";
        echo "<script>window.location.href='report_ck5_plb_hal_1.php?AJU=$ID';</script>";
    } else {
        // echo "<script>window.location.href='report_ck5_plb_hal_1.php?UpdateFailed=true';</script>";
        echo "<script>window.location.href='report_ck5_plb_hal_1.php?AJU=$ID';</script>";
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
    <link href="assets/css/ck5plb.css" rel="stylesheet" />

    <!-- Select2 -->
    <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <link href="assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
    <link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
    <link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
    <link href="assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
    
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/default/app.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    <link href="assets/css/tpb.css" rel="stylesheet" />
    <!-- Alert -->
    <script src="assets/sweet/sweetalert2.all.js"></script>
    <script src="assets/sweet/sweetalert2.all.min.js"></script>
    <script src="assets/sweet/sweetalert2.js"></script>
    <script src="assets/sweet/sweetalert2.min.js"></script>
    <!-- Font Poppins -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <!-- FONTAWESON 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/solid.css" integrity="sha384-DhmF1FmzR9+RBLmbsAts3Sp+i6cZMWQwNTRsew7pO/e4gvzqmzcpAzhDIwllPonQ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/fontawesome.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q66YLEFFZ2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-Q66YLEFFZ2');
    </script>
</head>
<?php
// include "include/cssForm.php";
// include "include/cssDatatables.php";
?>
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
                <a href="./report_ck5_plb_hal_1.php?AJU=<?= $_GET['AJU']; ?>" class="btn btn-sm btn-primary m-b-10" title="Halaman 1 CK5PLB" style="padding: 7px;">
                    <div style="display: flex;justify-content: space-between;align-items: end;">
                        <i class="fas fa-file" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Hal 1
                    </div>
                </a>
                <a href="./report_ck5_plb_hal_1A.php?AJU=<?= $_GET['AJU']; ?>" class="btn btn-sm btn-default m-b-10" title="Halaman 1A CK5PLB" style="padding: 7px;">
                    <div style="display: flex;justify-content: space-between;align-items: end;">
                        <i class="fas fa-file" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Hal 1A
                    </div>
                </a>
                <a href="./report_ck5_plb_hal_detail_barang.php?AJU=<?= $_GET['AJU']; ?>" class="btn btn-sm btn-default m-b-10" title="Halaman Detail Barang CK5PLB" style="padding: 7px;">
                    <div style="display: flex;justify-content: space-between;align-items: end;">
                        <i class="fas fa-file" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Hal Detail Barang
                    </div>
                </a>
            </div>
            <!-- <div>
                <a href="javascript:;" class="btn btn-sm btn-white m-b-10">
                    <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel"> Export Excel
                </a>
                <a href="report_ck5_plb_detail_print.php" class="btn btn-sm btn-white m-b-10">
                    <img src="assets/img/favicon/print.png" class="icon-primary-print" alt="Print"> Print
                </a>
            </div> -->
            <div>
                <a href="./report_ck5_plb.php" class="btn btn-sm btn-white m-b-10" title="Update CK5PLB" style="padding: 7px;">
                    <div style="display: flex;justify-content: space-between;align-items: end;">
                        <i class="far fa-arrow-alt-circle-left" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Kembali
                    </div>
                </a>
                <!-- Update CK5 PLB -->
                <a href="#modal-updateck5plb" class="btn btn-sm btn-warning m-b-10" data-toggle="modal" title="Update CK5PLB" style="padding: 7px;">
                <!-- <a href="./report_ck5_plb_hal_1_edit.php?AJU=<?= $_GET['AJU']; ?>" class="btn btn-sm btn-warning m-b-10" title="Update CK5PLB" style="padding: 7px;"> -->
                    <div style="display: flex;justify-content: space-between;align-items: end;">
                        <i class="fas fa-edit" style="font-size: 18px;margin-top: -10px;"></i>&nbsp;Update CK5 PLB
                    </div>
                </a>
                <div class="modal fade" id="modal-updateck5plb">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="report_ck5_plb_hal_1.php" method="POST">
                                <div class="modal-header">
                                    <h4 class="modal-title">[Update CK5 PLB] AJU <?= $dataGETAJU ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12" style="background: #ddd;display: flex;justify-content: left;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #000;font-size: 14px;font-weight: 800;border-radius: 5px;">
                                                        <label for="IDHEADER">HEADER</label>
                                                    </div>
                                                </div>
                                                <!-- A -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="IdJenisBarangKenaCukai">A. Jenis Barang Kena Cukai</label>
                                                            <select class="default-select2 form-control" name="InputJenisBarangKenaCukai" id="IdJenisBarangKenaCukai">
                                                                <?php if ($resultBahanBakuTarif['KODE_KOMODITI_CUKAI'] == NULL || $resultBahanBakuTarif['KODE_KOMODITI_CUKAI'] == '') { ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } else { ?> 
                                                                    <?php if ($resultBahanBakuTarif['KODE_KOMODITI_CUKAI'] == 1) { ?>
                                                                        <option value="<?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?>"><?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?> - Etil Alkohol</option>
                                                                        <?php } elseif ($resultBahanBakuTarif['KODE_KOMODITI_CUKAI'] == 2) { ?>
                                                                        <option value="<?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?>"><?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?> - MMEA</option>
                                                                        <?php } elseif ($resultBahanBakuTarif['KODE_KOMODITI_CUKAI'] == 3) { ?>
                                                                        <option value="<?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?>"><?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?> - Hasil Tembakau</option>
                                                                        <?php } elseif ($resultBahanBakuTarif['KODE_KOMODITI_CUKAI'] == 4) { ?>
                                                                        <option value="<?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?>"><?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?> - <?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI_LAINNYA']; ?></option>
                                                                        <?php } ?>
                                                                        <option>-- Pilih --</option>
                                                                <?php } ?>
                                                                <option value="1">1 - Etil Alkohol</option>
                                                                <option value="2">2 - MMEA</option>
                                                                <option value="3">3 - Hasil Tembakau</option>
                                                                <option value="4">4 - Lainnya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" id="LainnyaHeaderA" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="IdJenisBarangKenaCukaiLainnya">Jenis Barang Kena Cukai Lainnya</label>
                                                            <input type="text" class="form-control" name="InputJenisBarangKenaCukaiLainnya" id="IdJenisBarangKenaCukaiLainnya" placeholder="Jenis Barang Kena Cukai Lainnya ..." value="<?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI_LAINNYA']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End A -->
                                                <!-- B -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="IdCaraPelunasan">B. Cara Pelunasan</label>
                                                            <select class="form-control" name="InputCaraPelunasan" id="IdCaraPelunasan">
                                                                <?php if ($resultDataCK5PLB['KODE_CARA_BAYAR'] == NULL || $resultDataCK5PLB['KODE_CARA_BAYAR'] == '') { ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } else { ?> 
                                                                    <?php if ($resultDataCK5PLB['KODE_CARA_BAYAR'] == 1) { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?>"><?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?> - Pembayaran</option>
                                                                        <?php } elseif ($resultDataCK5PLB['KODE_CARA_BAYAR'] == 2) { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?>"><?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?> - Pelekatan Pita Cukai</option>
                                                                        <?php } elseif ($resultDataCK5PLB['KODE_CARA_BAYAR'] == 3) { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?>"><?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?> - Pembubuhan Tanda Lunas Cukai Lainnya</option>
                                                                        <?php } ?>
                                                                        <option>-- Pilih --</option>
                                                                <?php } ?>
                                                                <option value="1">1 - Pembayaran</option>
                                                                <option value="2">2 - Pelekatan Pita Cukai</option>
                                                                <option value="3">3 - Pembubuhan Tanda Lunas Cukai Lainnya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                </div>
                                                <!-- End B -->
                                                <!-- C -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="IdStatusCukai">C. Status Cukai</label>
                                                            <select class="form-control" name="InputStatusCukai" id="IdStatusCukai">
                                                                <?php if ($resultDataCK5PLB['KODE_FASILITAS'] == NULL || $resultDataCK5PLB['KODE_FASILITAS'] == '') { ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } else { ?> 
                                                                    <?php if ($resultDataCK5PLB['KODE_FASILITAS'] == 1) { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_FASILITAS']; ?>"><?= $resultDataCK5PLB['KODE_FASILITAS']; ?> - Belum Dilunasi</option>
                                                                        <?php } elseif ($resultDataCK5PLB['KODE_FASILITAS'] == 2) { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_FASILITAS']; ?>"><?= $resultDataCK5PLB['KODE_FASILITAS']; ?> - Sudah Dilunasi</option>
                                                                        <?php } ?>
                                                                        <option>-- Pilih --</option>
                                                                <?php } ?>
                                                                <option value="1">1 - Belum Dilunasi</option>
                                                                <option value="2">2 - Sudah Dilunasi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                </div>
                                                <!-- End C -->
                                                <!-- D -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="IdJenisPemberitahuan">D. Jenis Pemberitahuan</label>
                                                            <select class="form-control" name="InputJenisPemberitahuan" id="IdJenisPemberitahuan">
                                                                <?php if ($resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] == NULL || $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] == '') { ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } else { ?> 
                                                                        <?php if ($resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] == 1) { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?>"><?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?> - Dibayar</option>
                                                                        <?php } elseif ($resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] == 2) { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?>"><?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?> - Tidak Dipungut</option>
                                                                        <?php } elseif ($resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] == 3) { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?>"><?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?> - Dibebaskan</option>
                                                                        <?php } elseif ($resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] == 4) { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?>"><?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN']; ?> - <?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN_LAINNYA']; ?></option>
                                                                        <?php } ?>
                                                                        <option>-- Pilih --</option>
                                                                <?php } ?>
                                                                <option value="1">1 - Dibayar</option>
                                                                <option value="2">2 - Tidak Dipungut</option>
                                                                <option value="3">3 - Dibebaskan</option>
                                                                <option value="4">4 - Lainnya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" id="LainnyaHeaderD" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="IdJenisPemberitahuanLainnya">Jenis Pemberitahuan Lainnya</label>
                                                            <input type="text" class="form-control" name="InputJenisPemberitahuanLainnya" id="IdJenisPemberitahuanLainnya" placeholder="Jenis Pemberitahuan Lainnya ..." value="<?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN_LAINNYA']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End D -->
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12" style="background: #ddd;display: flex;justify-content: left;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #000;font-size: 14px;font-weight: 800;border-radius: 5px;">
                                                        <label for="IDDATAPEMBERITAHUAN">E. DATA PEMBERITAHUAN</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="IDTEMPATASALPEMASOK"><u>TEMPAT ASAL PEMASOK</u></label>
                                                        <div style="display: flex;justify-content: flex-start;align-items: center;font-size: 12px;font-weight: 500;">
                                                            <input type="checkbox" id="myCheck" onclick="myFunction()" name="DataCheckPemasok" value="1" >
                                                            <font style="margin-left: 5px;">Ganti Data Pemasok</font>
                                                        </div>
                                                        <div class="form-group" id="text" style="display:none;background-color: yellow">
                                                            <label for="IdNamaTempatAsalPemasok">Nama</label>
                                                            <input type="hidden" name="OnePemasok" value="<?= $resultDataCK5PLB['ID_PENGUSAHA'] ?>">
                                                            <input type="hidden" name="TwoPemasok" value="<?= $resultDataCK5PLB['PERUSAHAAN'] ?>">
                                                            <input type="hidden" name="ThreePemasok" value="<?= $resultDataCK5PLB['ALAMAT_PENGUSAHA'] ?>">
                                                            <select class="form-control" name="InputNamaTempatAsalPemasok" id="IdNamaTempatAsalPemasok" onchange="showTempatAsalPemasok(this.value)" style="background: yellow;">
                                                                <option>-- Nama Pengusaha --</option>
                                                                <?php
                                                                $resultIdentitasTwo = $dbcon->query("SELECT ID,NPWP,NAMA FROM referensi_pengusaha WHERE NPWP!='' ORDER BY NAMA ASC");
                                                                foreach ($resultIdentitasTwo as $rowIdentitasTwo) {
                                                                ?>
                                                                    <option value="<?= $rowIdentitasTwo['NAMA'] ?>"><?= $rowIdentitasTwo['NAMA'] ?> - <?= $rowIdentitasTwo['NPWP'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div id="TempatAsalPemasok"></div>
                                                        <div class="form-group">
                                                            <label for="IdNamaKodeOne">Nama, Kode Kantor</label>
                                                            <div class="input-group bootstrap-NULL bootstrap-touchspin-injected">
                                                                <select class="form-control" name="InputNamaKodeOne" id="IdNamaKodeOne" onchange="showKodeOne(this.value)">
                                                                    <?php if ($resultDataCK5PLB['KPPBC'] == NULL || $resultDataCK5PLB['KPPBC'] == '') { ?>
                                                                        <option>-- Kantor Pabean --</option>
                                                                    <?php } else { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KPPBC']; ?>"><?= $resultDataNamaKantor['URAIAN_KANTOR']; ?> - <?= $resultDataCK5PLB['KPPBC']; ?></option>
                                                                        <option>-- Kantor Pabean --</option>
                                                                    <?php } ?>
                                                                    <?php
                                                                    $resultKodeOne = $dbcon->query("SELECT * FROM referensi_kantor_pabean 
                                                                                                    ORDER BY URAIAN_KANTOR ASC");
                                                                    foreach ($resultKodeOne as $rowKodeOne) {
                                                                    ?>
                                                                        <option value="<?= $rowKodeOne['KODE_KANTOR'] ?>"><?= $rowKodeOne['URAIAN_KANTOR'] ?> - <?= $rowKodeOne['KODE_KANTOR'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="input-group-btn input-group-append">
                                                                    <a href="#!" class="btn btn-default bootstrap-touchspin-profil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Kode Kantor">
                                                                        <div id="InputshowKodeOne">KD</div>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="IDTEMPATTUJUANPENGGUNA"><u>TEMPAT TUJUAN PENGGUNA</u></label>
                                                        <div style="display: flex;justify-content: flex-start;align-items: center;font-size: 12px;font-weight: 500;">
                                                            <input type="checkbox" id="myCheckTujuan" onclick="myFunctionTujuan()" name="DataCheckTujuan" value="1" >
                                                            <font style="margin-left: 5px;">Ganti Data Tujuan</font>
                                                        </div>
                                                        <div class="form-group" id="textTujuan" style="display:none;background-color: yellow;">
                                                            <label for="IdNamaNamaTempatTujuan">Nama</label>
                                                            <input type="hidden" name="OneTujuan" value="<?= $resultDataCK5PLB['ID_PENERIMA_BARANG'] ?>">
                                                            <input type="hidden" name="TwoTujuan" value="<?= $resultDataCK5PLB['NAMA_PENERIMA_BARANG'] ?>">
                                                            <input type="hidden" name="ThreeTujuan" value="<?= $resultDataCK5PLB['ALAMAT_PENERIMA_BARANG'] ?>">
                                                            <select class="form-control" name="InputNamaTempatTujuan" id="IdNamaNamaTempatTujuan" onchange="showTempatTujuan(this.value)" style="background: yellow;">
                                                                <option>-- Nama Pengusaha --</option>
                                                                <?php
                                                                $resultIdentitasTwo = $dbcon->query("SELECT ID,NPWP,NAMA FROM referensi_pengusaha WHERE NPWP!='' ORDER BY NAMA ASC");
                                                                foreach ($resultIdentitasTwo as $rowIdentitasTwo) {
                                                                ?>
                                                                    <option value="<?= $rowIdentitasTwo['NAMA'] ?>"><?= $rowIdentitasTwo['NAMA'] ?> - <?= $rowIdentitasTwo['NPWP'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div id="TempatTujuan"></div>
                                                        <div class="form-group">
                                                            <label for="IdNamaKodeTwo">Nama, Kode Kantor</label>
                                                            <div class="input-group bootstrap-NULL bootstrap-touchspin-injected">
                                                                <select class="default-select2 form-control" name="InputNamaKodeTwo" id="IdNamaKodeTwo" onchange="showKodeTwo(this.value)">
                                                                    <?php if ($resultDataCK5PLB['KODE_KANTOR_TUJUAN'] == NULL || $resultDataCK5PLB['KODE_KANTOR_TUJUAN'] == '') { ?>
                                                                        <option>-- Kantor Pabean --</option>
                                                                    <?php } else { ?>
                                                                        <option value="<?= $resultDataCK5PLB['KODE_KANTOR_TUJUAN']; ?>"><?= $resultDataNamaKantorTujuan['URAIAN_KANTOR']; ?> - <?= $resultDataCK5PLB['KODE_KANTOR_TUJUAN']; ?></option>
                                                                        <option>-- Kantor Pabean --</option>
                                                                    <?php } ?>
                                                                    <?php
                                                                    $resultKodeTwo = $dbcon->query("SELECT * FROM referensi_kantor_pabean 
                                                                                                    ORDER BY URAIAN_KANTOR ASC");
                                                                    foreach ($resultKodeTwo as $rowKodeTwo) {
                                                                    ?>
                                                                        <option value="<?= $rowKodeTwo['KODE_KANTOR'] ?>"><?= $rowKodeTwo['URAIAN_KANTOR'] ?> - <?= $rowKodeTwo['KODE_KANTOR'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="input-group-btn input-group-append">
                                                                    <a href="#!" class="btn btn-default bootstrap-touchspin-profil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Kode Kantor">
                                                                        <div id="InputshowKodeTwo">KD</div>
                                                                    </a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="IdCaraPengangkutan">Cara Pengangkutan</label>
                                                            <select class="form-control" name="InputCaraPengangkutan" id="IdCaraPengangkutan">
                                                                <?php if ($resultDataCK5PLB['KODE_CARA_ANGKUT'] == NULL || $resultDataCK5PLB['KODE_CARA_ANGKUT'] == '') { ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } else { ?>
                                                                    <?php if ($resultDataCK5PLB['KODE_CARA_ANGKUT'] == 1) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?>"><?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?> - Darat</option>
                                                                    <?php } elseif ($resultDataCK5PLB['KODE_CARA_ANGKUT'] == 2) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?>"><?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?> - Laut</option>
                                                                    <?php } elseif ($resultDataCK5PLB['KODE_CARA_ANGKUT'] == 3) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?>"><?= $resultDataCK5PLB['KODE_CARA_ANGKUT']; ?> - Udara</option>
                                                                    <?php } ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } ?>
                                                                <option value="1">1 - Darat</option>
                                                                <option value="2">2 - Laut</option>
                                                                <option value="3">3 - Udara</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12" style="background: #ddd;display: flex;justify-content: left;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #000;font-size: 14px;font-weight: 800;border-radius: 5px;">
                                                        <label for="IDPEMBERITAHUAN">G. PEMBERITAHUAN</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="IdNamaPIC">Nama PIC</label>
                                                            <input type="hidden" class="form-control" name="InputID" id="IdID" value="<?= $resultHeadSetting['id']; ?>">
                                                            <input type="text" class="form-control" name="InputNamaPIC" id="IdNamaPIC" value="<?= $resultHeadSetting['pic_name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="IdJabatanPIC">Jabatan PIC</label>
                                                            <input type="text" class="form-control" name="InputJabatanPIC" id="IdJabatanPIC" value="<?= $resultHeadSetting['pic_title']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12" style="background: #ddd;display: flex;justify-content: left;align-items: center;padding: 10px 0 0 10px;margin-bottom: 10px;color: #000;font-size: 14px;font-weight: 800;border-radius: 5px;">
                                                        <label for="IDUNTUKPEMBAYARANJAMINAN">H. UNTUK PEMBAYARAN / JAMINAN</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="IdPembayaran">Pembayaran</label>
                                                            <select class="form-control" name="InputPembayaran" id="IdPembayaran">
                                                                <?php if ($resultDataCK5PLB['KODE_PEMBAYAR'] == NULL || $resultDataCK5PLB['KODE_PEMBAYAR'] == '') { ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } else { ?>
                                                                    <?php if ($resultDataCK5PLB['KODE_PEMBAYAR'] == 1) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_PEMBAYAR']; ?>"><?= $resultDataCK5PLB['KODE_PEMBAYAR']; ?> - Bank Devisa</option>
                                                                    <?php } elseif ($resultDataCK5PLB['KODE_PEMBAYAR'] == 2) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_PEMBAYAR']; ?>"><?= $resultDataCK5PLB['KODE_PEMBAYAR']; ?> - Kantor</option>
                                                                    <?php } elseif ($resultDataCK5PLB['KODE_PEMBAYAR'] == 3) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_PEMBAYAR']; ?>"><?= $resultDataCK5PLB['KODE_PEMBAYAR']; ?> - Kantor Pos</option>
                                                                    <?php } ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } ?>
                                                                <option value="1">1 - Bank Devisa</option>
                                                                <option value="2">2 - Kantor</option>
                                                                <option value="3">3 - Kantor Pos</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="IdJaminan">Jaminan</label>
                                                            <select class="form-control" name="InputJaminan" id="IdJaminan">
                                                                <?php if ($resultDataCK5PLB['KODE_JAMINAN'] == NULL || $resultDataCK5PLB['KODE_JAMINAN'] == '') { ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } else { ?>
                                                                    <?php if ($resultDataCK5PLB['KODE_JAMINAN'] == 1) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_JAMINAN']; ?>"><?= $resultDataCK5PLB['KODE_JAMINAN']; ?> - Tunai</option>
                                                                    <?php } elseif ($resultDataCK5PLB['KODE_JAMINAN'] == 2) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_JAMINAN']; ?>"><?= $resultDataCK5PLB['KODE_JAMINAN']; ?> - Bank Garansi</option>
                                                                    <?php } elseif ($resultDataCK5PLB['KODE_JAMINAN'] == 3) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_JAMINAN']; ?>"><?= $resultDataCK5PLB['KODE_JAMINAN']; ?> - Excise Bond</option>
                                                                    <?php } elseif ($resultDataCK5PLB['KODE_JAMINAN'] == 4) { ?>
                                                                    <option value="<?= $resultDataCK5PLB['KODE_JAMINAN']; ?>"><?= $resultDataCK5PLB['KODE_JAMINAN']; ?> - <?= $resultDataCK5PLB['KODE_JAMINAN_LAINNYA']; ?></option>
                                                                    <?php } ?>
                                                                    <option>-- Pilih --</option>
                                                                <?php } ?>
                                                                <option value="1">1 - Tunai</option>
                                                                <option value="2">2 - Bank Garansi</option>
                                                                <option value="3">3 - Excise Bond</option>
                                                                <option value="4">4 - Lainnya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" id="LainnyaJaminan" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="IdJaminanLainnya">Jaminan Lainnya</label>
                                                            <input type="text" class="form-control" name="InputJaminanLainnya" id="IdJaminanLainnya" placeholder="Jaminan Lainnya ..." value="<?= $resultDataCK5PLB['KODE_JAMINAN_LAINNYA']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                    <input type="hidden" name="AJUDATA" value="<?= $_GET['AJU']; ?>">
                                    <button type="submit" name="update_ck5plb_oke" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Update CK5 PLB -->
                <a href="report_ck5_plb_hal_1_excel.php?AJU=<?= $_GET['AJU']; ?>" target="_blank" class="btn btn-sm btn-white m-b-10">
                    <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel"> Export Excel Hal. 1
                </a>
                <a href="report_ck5_plb_hal_1_print.php?AJU=<?= $_GET['AJU']; ?>" target="_blank" class="btn btn-sm btn-white m-b-10">
                    <img src="assets/img/favicon/print.png" class="icon-primary-print" alt="Print"> Print Hal. 1
                </a>
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
                <tr height=18 style='mso-height-source:userset;height:13.5pt'>
                    <td class=xl7811096></td>
                    <td height=18 style='height:13.5pt'>A. Jenis Barang Kena Cukai</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>:</td>
                    <td class="xl7911096"><?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI']; ?></td>
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
                    <?php if ($resultBahanBakuTarif['KODE_KOMODITI_CUKAI_LAINNYA'] == NULL || $resultBahanBakuTarif['KODE_KOMODITI_CUKAI_LAINNYA'] == '' || $resultBahanBakuTarif['KODE_KOMODITI_CUKAI_LAINNYA'] == 'Kosong') { ?>
                        <td class=xl6911096 colspan=2>Lainnya……..</td>
                    <?php } else { ?>
                        <td class=xl6911096 colspan=2>Lainnya: <?= $resultBahanBakuTarif['KODE_KOMODITI_CUKAI_LAINNYA'] ?></td>
                    <?php } ?>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
                <tr height=17 style='height:12.75pt'>
                    <td class=xl7811096></td>
                    <td height=17 style='height:12.75pt'>B. Cara Pelunasan</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>:</td>
                    <td class="xl7911096"><?= $resultDataCK5PLB['KODE_CARA_BAYAR']; ?></td>
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
                    <td class=xl7811096></td>
                    <td height=17 style='height:12.75pt'>C. Status Cukai</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>:</td>
                    <td class="xl7911096"><?= $resultDataCK5PLB['KODE_FASILITAS'] ?></td>
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
                    <td class=xl7811096></td>
                    <td height=17 style='height:12.75pt'>D. Jenis Pemberitahuan</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>:</td>
                    <td class="xl7911096"><?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN'] ?></td>
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
                    <?php if ($resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN_LAINNYA'] == NULL || $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN_LAINNYA'] == '' || $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN_LAINNYA'] == 'Kosong') { ?>
                        <td class=xl6911096 colspan=2>Lainnya……..</td>
                    <?php } else { ?>
                        <td class=xl6911096 colspan=2>Lainnya: <?= $resultDataCK5PLB['KODE_JENIS_PEMBERITAHUAN_LAINNYA'] ?></td>
                    <?php } ?>
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
                    <td class=xl9111096></td>
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
                    <td class=xl9111096></td>
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
                    <td class=xl6911096 colspan=10>Dengan ini saya menyatakan bertanggung jawab
                        atas kebenaran</td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                    <td class=xl6911096></td>
                    <td class=xl7611096>a.</td>
                    <td class=xl6911096 colspan=2>Pembayaran&nbsp;:</td>
                    <td class="xl7911096"><?= $resultDataCK5PLB['KODE_PEMBAYAR'] ?></td>
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
                    <td class="xl7911096"><?= $resultDataCK5PLB['KODE_JAMINAN'] ?></td>
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
                    <!-- <td class=xl6911096 colspan=2>4. Lainnya ...</td> -->
                    <?php if ($resultDataCK5PLB['KODE_JAMINAN_LAINNYA'] == NULL || $resultDataCK5PLB['KODE_JAMINAN_LAINNYA'] == '' || $resultDataCK5PLB['KODE_JAMINAN_LAINNYA'] == 'Kosong') { ?>
                        <td class=xl6911096 colspan=2>4. Lainnya……..</td>
                    <?php } else { ?>
                        <td class=xl6911096 colspan=2>4. Lainnya: <?= $resultDataCK5PLB['KODE_JAMINAN_LAINNYA'] ?></td>
                    <?php } ?>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl6911096></td>
                    <td class=xl7711096>&nbsp;</td>
                </tr>
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
</div>
<?php
// include "include/panel.php"; 
include "include/footer.php";
include "include/jsDatatables.php";
include "include/jsForm.php";
?>
<script src="assets/js/app.min.js"></script>
<script src="assets/js/theme/default.min.js"></script>
<script src="assets/plugins/d3/d3.min.js"></script>
<script src="assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<script>
    // Show and Hidden
    $(function() {
        $("#IdJenisBarangKenaCukai").change(function() {
            if ($(this).val() == 4) {
                $("#LainnyaHeaderA").show();
            } else {
                $("#LainnyaHeaderA").hide();
            }
        });
    });
    $(function() {
        $("#IdJenisPemberitahuan").change(function() {
            if ($(this).val() == 4) {
                $("#LainnyaHeaderD").show();
            } else {
                $("#LainnyaHeaderD").hide();
            }
        });
    });
    $(function() {
        $("#IdJaminan").change(function() {
            if ($(this).val() == 4) {
                $("#LainnyaJaminan").show();
            } else {
                $("#LainnyaJaminan").hide();
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

    // Ganti Data Asal Pemasok
    function myFunction() {
      var checkBox = document.getElementById("myCheck");
      var text = document.getElementById("text");
      if (checkBox.checked == true){
        text.style.display = "block";
      } else {
         text.style.display = "none";
      }
    }

    // Ganti Data Tujuan Pengguna
    function myFunctionTujuan() {
      var checkBox = document.getElementById("myCheckTujuan");
      var text = document.getElementById("textTujuan");
      if (checkBox.checked == true){
        text.style.display = "block";
      } else {
         text.style.display = "none";
      }
    }

    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess<?= $ID ?>') > -1) {
        Swal.fire({
            title: 'Data berhasil diupdate!',
            icon: 'success',
            text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './report_ck5_plb_hal_1.php?AJU=<?= $ID ?>');
    }
    // UPDATE FAILEDú
    if (window?.location?.href?.indexOf('UpdateFailed<?= $ID ?>') > -1) {
        Swal.fire({
            title: 'Data gagal diupdate!',
            icon: 'error',
            text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './report_ck5_plb_hal_1.php?AJU=<?= $ID ?>');
    }
</script>
</body>
</html>