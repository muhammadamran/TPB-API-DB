<?php include "include/connection.php";
include "include/restrict.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
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
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <link href="assets/css/tpb.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/solid.css" integrity="sha384-DhmF1FmzR9+RBLmbsAts3Sp+i6cZMWQwNTRsew7pO/e4gvzqmzcpAzhDIwllPonQ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/fontawesome.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q66YLEFFZ2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-Q66YLEFFZ2');
    </script>
</head>
<?php
// DATE DAFULT
date_default_timezone_set("Asia/jakarta");

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

// DATE SPLIT
function date_indo_s($date, $print_day = false)
{
    $day = array(
        1 =>
        'Sen',
        'Sel',
        'Rab',
        'Kam',
        'Jum',
        'Sab',
        'Min'
    );
    $month = array(
        1 =>
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Agu',
        'Sep',
        'Okt',
        'Nov',
        'Des'
    );
    $split    = explode('-', $date);
    $tgl_indo = $split[2] . ' ' . $month[(int)$split[1]] . ' ' . $split[0];

    if ($print_day) {
        $num = date('N', strtotime($date));
        return $day[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

// RUPIAH
function Rupiah($angka)
{
    $hasil = "Rp. " . number_format($angka, 2, ',', '.');
    return $hasil;
}

// DECIMAL
function decimal($number)
{
    $hasil = number_format($number, 0, ",", ",");
    return $hasil;
}

// NPWP
function NPWP($value)
{
    // 12.345.678.9-012.345
    $hasil = number_format($value, 0, ',', '.');
    return $hasil;
}
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Invoice App Name | Company </title>
<?php } else { ?>
    <title>Laporan Invoice <?= $_GET['AJU']; ?> <?= $resultSetting['company']; ?> - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<?php
// NUMBER
if (isset($_POST['Number_'])) {
    $NUMBER              = $_POST['NUMBER'];
    $TGL_NUMBER          = $_POST['TGL_NUMBER'];
    $NOAJU               = $_POST['NOAJU'];
    $NOAJU_PLB           = $_POST['NOAJU_PLB'];

    $sql = $dbcon->query("UPDATE tpb_header SET NUMBER='$NUMBER',
                                                TGL_NUMBER='$TGL_NUMBER'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='report_data_gb_invoice.php?AJU=$NOAJU_PLB&AlertNumber=true';</script>";
    } else {
        echo "<script>window.location.href='report_data_gb_invoice.php?AJU=$NOAJU_PLB&AlertNumber=false';</script>";
    }
}
// NO BL
if (isset($_POST['NoBL_'])) {
    $NO_BL               = $_POST['NO_BL'];
    $TGL_NO_BL           = $_POST['TGL_NO_BL'];
    $NOAJU               = $_POST['NOAJU'];
    $NOAJU_PLB           = $_POST['NOAJU_PLB'];

    $sql = $dbcon->query("UPDATE tpb_header SET NO_BL='$NO_BL',
                                                TGL_NO_BL='$TGL_NO_BL'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='report_data_gb_invoice.php?AJU=$NOAJU_PLB&AlertNoBL=true';</script>";
    } else {
        echo "<script>window.location.href='report_data_gb_invoice.php?AJU=$NOAJU_PLB&AlertNoBL=false';</script>";
    }
}
// WEIGHR
if (isset($_POST['Weight_'])) {
    $WEIGHT              = $_POST['WEIGHT'];
    $WEIGHT_S            = $_POST['WEIGHT_S'];
    $NOAJU               = $_POST['NOAJU'];
    $NOAJU_PLB           = $_POST['NOAJU_PLB'];

    $sql = $dbcon->query("UPDATE tpb_header SET WEIGHT='$WEIGHT',
                                                WEIGHT_S='$WEIGHT_S'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='report_data_gb_invoice.php?AJU=$NOAJU_PLB&AlertOriginal=true';</script>";
    } else {
        echo "<script>window.location.href='report_data_gb_invoice.php?AJU=$NOAJU_PLB&AlertOriginal=false';</script>";
    }
}
// ORIGINAL
if (isset($_POST['Orginial_'])) {
    $KodeNegara          = $_POST['KodeNegara'];
    $NOAJU               = $_POST['NOAJU'];
    $NOAJU_PLB           = $_POST['NOAJU_PLB'];

    $sql = $dbcon->query("UPDATE tpb_header SET KODE_NEGARA_PEMASOK='$KodeNegara'
                          WHERE NOMOR_AJU='$NOAJU'");

    if ($sql) {
        echo "<script>window.location.href='report_data_gb_invoice.php?AJU=$NOAJU_PLB&AlertOriginal=true';</script>";
    } else {
        echo "<script>window.location.href='report_data_gb_invoice.php?AJU=$NOAJU_PLB&AlertOriginal=false';</script>";
    }
}
// DATA HEADER
$dataHeader = $dbcon->query("SELECT *,
                            SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU,
                            -- PLB
                            plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                            plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_PLB,
                            plb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_PLB,
                            plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                            plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                            plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                            plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                            plb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                            -- TPB
                            tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                            tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_GB,
                            tpb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_GB,
                            tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                            tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                            tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                            tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB,
                            tpb.NUMBER AS NUMBER_GB,
                            tpb.TGL_NUMBER AS TGL_NUMBER_GB,
                            tpb.NO_BL AS NO_BL_GB,
                            tpb.TGL_NO_BL AS TGL_NO_BL_GB,
                            tpb.WEIGHT,
                            tpb.WEIGHT_S,
                            tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                            ngr.URAIAN_NEGARA,
                            tpb.BRUTO
                            FROM rcd_status AS rcd
                            LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                            LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                            LEFT OUTER JOIN referensi_negara AS ngr ON tpb.KODE_NEGARA_PEMASOK=ngr.KODE_NEGARA
                            WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "'
                            ORDER BY rcd.rcd_id DESC");
$resultdataHeader = mysqli_fetch_array($dataHeader);

$dataTPBH = $dbcon->query("SELECT ID FROM tpb_header WHERE NOMOR_AJU='" . $resultdataHeader['NOMOR_AJU_GB'] . "'");
$resultdataTPBH = mysqli_fetch_array($dataTPBH);
$IDHEADER = $resultdataTPBH['ID'];
?>
<div id="content" class="nav-top-content">
    <div class="invoice">
        <div class="line-page-table-n"></div>
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
                <div style="display: grid;">
                    <font style="font-size: 24px;font-weight: 800;">Laporan Data Gudang Berikat</font>
                    <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                    <font style="font-size: 12px;font-weight: 800;">No. Pengajuan PLB: <?= $resultdataHeader['NOMOR_AJU_PLB']; ?></font>
                    <font style="font-size: 12px;font-weight: 800;">No. Pengajuan GB: <?= $resultdataHeader['NOMOR_AJU_GB']; ?></font>
                    <font style="font-size: 18px;font-weight: 800;"><?= $resultHeadSetting['company_t'] ?></font>
                    <div class="line-page-table"></div>
                    <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?></font>
                </div>
            </div>
            <div class="col-md-12">
                <div>
                    <hr>
                    <p><span style="color: #404040; font-family: Arial Black; font-size: xx-large;">INVOICE</span></p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row" style="font-size: 14px;">
            <div class="col-sm-6">
                <div class="row">
                    <!-- DUTY-FREE NAME -->
                    <div class="col-3" style="font-weight: 900;">
                        DUTY-FREE NAME
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p><?= $resultdataHeader['NAMA_PENERIMA_BARANG_GB']; ?></p>
                    </div>
                    <!-- NPWP -->
                    <div class="col-3" style="font-weight: 900;">
                        NPWP
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p><?= NPWP($resultdataHeader['ID_PENERIMA_BARANG_GB']); ?></p>
                    </div>
                    <!-- STREET ADDRESS -->
                    <div class="col-3" style="font-weight: 900;">
                        STREET ADDRESS
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p><?= $resultdataHeader['ALAMAT_PENERIMA_BARANG_GB']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <!-- NUMBER -->
                    <div class="col-3" style="font-weight: 900;">
                        NUMBER
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $resultdataHeader['NUMBER_GB']; ?>
                            </div>
                            <div class="col-sm-6">
                                <?php if ($resultdataHeader['TGL_NUMBER_GB'] != NULL) { ?>
                                    <?= date_indo($resultdataHeader['TGL_NUMBER_GB']); ?>
                                <?php } ?>
                            </div>
                        </div>
                        <br>
                    </div>
                    <!-- NUMBER -->
                    <div class="modal fade" id="M_NUMBER">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">[Edit Data] Number</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Number <small style="color:red">*</small></label>
                                                    <input type="text" id="input-Number" name="NUMBER" class="form-control" value="<?= $resultdataHeader['NUMBER_GB']; ?>" placeholder="Number ..." required>
                                                    <input type="hidden" name="NOAJU" value="<?= $resultdataHeader['NOMOR_AJU_GB']; ?>" readonly>
                                                    <input type="hidden" name="NOAJU_PLB" value="<?= $resultdataHeader['NOMOR_AJU_PLB']; ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Tanggal Number <small style="color:red">*</small></label>
                                                    <input type="date" name="TGL_NUMBER" class="form-control" value="<?= $resultdataHeader['TGL_NUMBER_GB']; ?>" required>
                                                </div>
                                                <div class="col-md-12" style="font-size: 12px;">
                                                    <br>
                                                    <br>
                                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                        <button type="submit" name="Number_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End NUMBER -->
                    <!-- EX BILL OF LADING -->
                    <div class="col-3" style="font-weight: 900;">
                        EX BILL OF LADING
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <?php
                            // PLB
                            $NoBLQuery = $dbcon->query("SELECT 
                                                        dok.ID_HEADER,dok.NOMOR_DOKUMEN,dok.TANGGAL_DOKUMEN,
                                                        ref.URAIAN_DOKUMEN
                                                        FROM tpb_dokumen AS dok 
                                                        LEFT OUTER JOIN referensi_dokumen AS ref ON ref.KODE_DOKUMEN=dok.KODE_JENIS_DOKUMEN
                                                        WHERE dok.ID_HEADER='" . $IDHEADER . "' AND ref.KODE_DOKUMEN='705' ORDER BY dok.ID DESC LIMIT 1");
                            foreach ($NoBLQuery as $rowBLQuery) {
                            ?>
                                <div class="col-sm-6">
                                    <?= $rowBLQuery['NOMOR_DOKUMEN'] ?>
                                    <font style="font-size: 8px;">(<?= $rowBLQuery['URAIAN_DOKUMEN'] ?>)</font>
                                </div>
                                <?php
                                $alldateBL = $rowBLQuery['TANGGAL_DOKUMEN'];
                                $tglBL = substr($alldateBL, 0, 10);
                                $timeBL = substr($alldateBL, 10, 20);
                                ?>
                                <div class="col-sm-6"><?= date_indo($tglBL) ?></div>
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- <div class="col-8">
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $resultdataHeader['NO_BL_GB']; ?>
                                <a href="#M_NO_BL" class="label label-default" data-toggle="modal"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="col-sm-6">
                                <?php if ($resultdataHeader['TGL_NO_BL_GB'] != NULL) { ?>
                                    <?= date_indo($resultdataHeader['TGL_NO_BL_GB']); ?>
                                <?php } ?>
                            </div>
                        </div>
                        <br>
                    </div> -->
                    <!-- NO BL -->
                    <!-- <div class="modal fade" id="M_NO_BL">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">[Edit Data] Ex Bill of Lading</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>Ex Bill of Lading <small style="color:red">*</small></label>
                                                    <input type="text" id="input-NoBL" name="NO_BL" class="form-control" value="<?= $resultdataHeader['NO_BL_GB']; ?>" placeholder="Ex Bill of Lading ..." required>
                                                    <input type="hidden" name="NOAJU" value="<?= $resultdataHeader['NOMOR_AJU_GB']; ?>" readonly>
                                                    <input type="hidden" name="NOAJU_PLB" value="<?= $resultdataHeader['NOMOR_AJU_PLB']; ?>" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Tanggal Ex Bill of Lading <small style="color:red">*</small></label>
                                                    <input type="date" name="TGL_NO_BL" class="form-control" value="<?= $resultdataHeader['TGL_NO_BL_GB']; ?>" required>
                                                </div>
                                                <div class="col-md-12" style="font-size: 12px;">
                                                    <br>
                                                    <br>
                                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                        <button type="submit" name="NoBL_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <!-- End NO BL -->
                    <!-- NO. INVOICE -->
                    <div class="col-3" style="font-weight: 900;">
                        NO. INVOICE
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <?php
                            // PLB
                            $dataNoDokumen = $dbcon->query("SELECT 
                                                            dok.ID_HEADER,dok.NOMOR_DOKUMEN,dok.TANGGAL_DOKUMEN,
                                                            ref.URAIAN_DOKUMEN
                                                            FROM tpb_dokumen AS dok 
                                                            LEFT OUTER JOIN referensi_dokumen AS ref ON ref.KODE_DOKUMEN=dok.KODE_JENIS_DOKUMEN
                                                            WHERE dok.ID_HEADER='" . $IDHEADER . "' AND ref.KODE_DOKUMEN='380' ORDER BY dok.ID DESC LIMIT 1");
                            foreach ($dataNoDokumen as $resultNoDokumen) {
                            ?>
                                <div class="col-sm-6">
                                    <?= $resultNoDokumen['NOMOR_DOKUMEN'] ?>
                                    <font style="font-size: 8px;">(<?= $resultNoDokumen['URAIAN_DOKUMEN'] ?>)</font>
                                </div>
                                <?php
                                $alldateINV = $resultdataNoDokumen['TANGGAL_DOKUMEN'];
                                $tglINV = substr($alldateINV, 0, 10);
                                $timeINV = substr($alldateINV, 10, 20);
                                ?>
                                <div class="col-sm-6"><?= date_indo($tglINV) ?></div>
                            <?php } ?>
                        </div>
                        <br>
                    </div>
                    <!-- WEIGHT -->
                    <div class="col-3" style="font-weight: 900;">
                        WEIGHT
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p>
                            <?= decimal($resultdataHeader['BRUTO']); ?>
                        </p>
                    </div>
                    <!-- Weight -->
                    <div class="modal fade" id="M_WEIGHT">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">[Edit Data] Weight</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Weight <small style="color:red">*</small></label>
                                                    <div class="input-group m-b-10">
                                                        <input type="number" name="WEIGHT" class="form-control" placeholder="Weight ..." value="<?= $resultdataHeader['WEIGHT']; ?>" required />
                                                        <div class="input-group-append">
                                                            <select name="WEIGHT_S" class="btn btn-default form-control" name="">
                                                                <?php if ($resultdataHeader['WEIGHT'] != NULL) { ?>
                                                                    <option value="<?= $resultdataHeader['WEIGHT_S']; ?>"><?= $resultdataHeader['WEIGHT_S']; ?></option>
                                                                <?php } ?>
                                                                <option value="">Pilih Satuan</option>
                                                                <option value="kg">kg</option>
                                                                <option value="hg (ons)">hg (ons)</option>
                                                                <option value="dag">dag</option>
                                                                <option value="g">g</option>
                                                                <option value="dg">dg</option>
                                                                <option value="cg">cg</option>
                                                                <option value="mg">mg</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="NOAJU" value="<?= $resultdataHeader['NOMOR_AJU_GB']; ?>" readonly>
                                                    <input type="hidden" name="NOAJU_PLB" value="<?= $resultdataHeader['NOMOR_AJU_PLB']; ?>" readonly>
                                                </div>
                                                <div class="col-md-12" style="font-size: 12px;">
                                                    <br>
                                                    <br>
                                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                        <button type="submit" name="Weight_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Weight -->
                    <!-- ORIGINAL -->
                    <div class="col-3" style="font-weight: 900;">
                        ORIGINAL
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <p>
                            <?= $resultdataHeader['URAIAN_NEGARA']; ?>
                        </p>
                    </div>
                    <!-- Original -->
                    <div class="modal fade" id="M_ORIGINAL">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h4 class="modal-title">[Edit Data] Original</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Original <small style="color:red">*</small></label>
                                                    <select name="KodeNegara" class="default-select2 form-control" required>
                                                        <?php if ($resultdataHeader['KODE_NEGARA'] != NULL) { ?>
                                                            <option value="<?= $resultdataHeader['KODE_NEGARA']; ?>"><?= $resultdataHeader['KODE_NEGARA']; ?> - <?= $resultdataHeader['URAIAN_NEGARA']; ?></option>
                                                            <option value="">Pilih Original</option>
                                                        <?php } ?>
                                                        <option value="">Pilih Original</option>
                                                        <?php
                                                        $dataKDN = $dbcon->query("SELECT * FROM referensi_negara");
                                                        foreach ($dataKDN as $rowKDN) { ?>
                                                            <option value="<?= $rowKDN['KODE_NEGARA']; ?>"><?= $rowKDN['KODE_NEGARA']; ?> - <?= $rowKDN['URAIAN_NEGARA']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" name="NOAJU" value="<?= $resultdataHeader['NOMOR_AJU_GB']; ?>" readonly>
                                                    <input type="hidden" name="NOAJU_PLB" value="<?= $resultdataHeader['NOMOR_AJU_PLB']; ?>" readonly>
                                                </div>
                                                <div class="col-md-12" style="font-size: 12px;">
                                                    <br>
                                                    <br>
                                                    <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tutup</a>
                                        <button type="submit" name="Orginial_" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Original -->
                    <!-- NO. DAFTAR -->
                    <div class="col-3" style="font-weight: 900;">
                        NO. DAFTAR
                    </div>
                    <div class="col-1">
                        :
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <?php if ($resultdataHeader['TANGGAL_DAFTAR_GB'] != NULL) { ?>
                                <div class="col-sm-6"><?= $resultdataHeader['NOMOR_DAFTAR_GB']; ?></div>
                            <?php } else { ?>
                                <div class="col-sm-6">-</div>
                            <?php } ?>
                            <?php if ($resultdataHeader['TANGGAL_DAFTAR_GB'] != NULL) { ?>
                                <?php
                                $dataTGLAJU = $resultdataHeader['TANGGAL_DAFTAR_GB'];
                                $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                                $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                                $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                                $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
                                ?>
                                <?php
                                $alldateDF = $resultdataHeader['TANGGAL_DAFTAR_GB'];
                                $tglDF = substr($alldateDF, 0, 10);
                                $timeDF = substr($alldateDF, 10, 20);
                                ?>
                                <div class="col-sm-6"><?= date_indo($tglDF); ?></div>
                            <?php } else { ?>
                                <div class="col-sm-6">-</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="invoice-content" style="font-size: 12px;">
            <div class="table-responsive">
                <table id="TableData" class="table table-striped table-bordered first" style="width:100%">
                    <thead>
                        <tr>
                            <th rowspan="2" width="1%">NO.</th>
                            <th rowspan="2" style="text-align:center">DESCRIPTION</th>
                            <th rowspan="2" colspan="4" style="text-align:center">QUANTITY</th>
                            <th rowspan="2" style="text-align:center">PRICE</th>
                            <th colspan="4" style="text-align:center">REMARKS</th>
                        </tr>
                        <tr>
                            <th style="text-align:center">Pack(s)</th>
                            <th style="text-align:center">Can(s)</th>
                            <th style="text-align:center">Bottle</th>
                            <th style="text-align:center">Litre(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dataTable = $dbcon->query("SELECT *,
                                                    SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU,
                                                    -- PLB
                                                    plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                                                    plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                                                    plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                                                    plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                                                    plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                                                    plb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                                                    plb.KODE_VALUTA,
                                                    -- TPB
                                                    tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                                                    tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                    tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                    tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                                                    tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB,
                                                    tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                                                    ngr.URAIAN_NEGARA
                                                    FROM rcd_status AS rcd
                                                    LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                                    LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                    LEFT OUTER JOIN plb_barang AS brg ON plb.NOMOR_AJU=brg.NOMOR_AJU
                                                    LEFT OUTER JOIN referensi_negara AS ngr ON tpb.KODE_NEGARA_PEMASOK=ngr.KODE_NEGARA
                                                    WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "'
                                                    ORDER BY brg.ID,brg.SERI_BARANG ASC");
                        if ($dataTable) : $no = 1;
                            foreach ($dataTable as $row) :
                        ?>
                                <tr>
                                    <td><?= $no ?>.</td>
                                    <td><?= $row['URAIAN']; ?></td>
                                    <td style="text-align: center;"><?= $row['BOTOL']; ?></td>
                                    <td style="text-align: center;">x</td>
                                    <td style="text-align: center;"><?= $row['LITER']; ?></td>
                                    <td style="text-align: right;"><?= $row['TOTAL_CT_AKHIR']; ?> Ctn(s)</td>
                                    <td style="text-align: center;">
                                        <div style="display: flex;justify-content: space-evenly;align-items:center">
                                            <font><?= $row['KODE_VALUTA']; ?></font>
                                            <font><?= $row['CIF']; ?></font>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">-</td>
                                    <td style="text-align: center;">-</td>
                                    <td style="text-align: right;"><?= $row['TOTAL_BOTOL_AKHIR']; ?> Btl(s)</td>
                                    <td style="text-align: right;"><?= $row['TOTAL_LITER_AKHIR']; ?> Ltr(s)</td>
                                </tr>
                            <?php
                                $no++;
                            endforeach
                            ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="11">
                                    <center>
                                        <div style="display: grid;">
                                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                    <tfoot>
                        <?php
                        $dataFooter = $dbcon->query("SELECT *,
                                                    SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU,
                                                    -- PLB
                                                    plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                                                    plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                                                    plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                                                    plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                                                    plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                                                    plb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                                                    plb.KODE_VALUTA AS KODE_NEGARA_PEMASOK_PLB,
                                                    -- TPB
                                                    tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                                                    tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                    tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                    tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                                                    tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB,
                                                    tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                                                    ngr.URAIAN_NEGARA,
                                                    (SELECT SUM(BOTOL) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_botol,
                                                    (SELECT SUM(LITER) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_liter,
                                                    (SELECT SUM(TOTAL_CT_AKHIR) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_ct,
                                                    (SELECT SUM(CIF) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_cif,
                                                    (SELECT SUM(TOTAL_BOTOL_AKHIR) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_botol_akhir,
                                                    (SELECT SUM(TOTAL_LITER_AKHIR) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_liter_akhir
                                                    FROM rcd_status AS rcd
                                                    LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                                    LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                    LEFT OUTER JOIN plb_barang AS brg ON plb.NOMOR_AJU=brg.NOMOR_AJU
                                                    LEFT OUTER JOIN referensi_negara AS ngr ON tpb.KODE_NEGARA_PEMASOK=ngr.KODE_NEGARA
                                                    WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "'
                                                    ORDER BY brg.ID,brg.SERI_BARANG ASC");
                        $resultFooter = mysqli_fetch_array($dataFooter);
                        ?>
                        <tr>
                            <th colspan="2" style="text-align:center">TOTAL</th>
                            <th style="text-align:center"><?= $resultFooter['c_botol']; ?></th>
                            <th style="text-align:center">x</th>
                            <th style="text-align:center"><?= round($resultFooter['c_liter']); ?></th>
                            <th style="text-align:right"><?= $resultFooter['c_ct']; ?> Ctn(s)</th>
                            <th style="text-align:center">
                                <div style="display: flex;justify-content: space-evenly;align-items:center">
                                    <font><?= $resultFooter['KODE_VALUTA']; ?></font>
                                    <font><?= round($resultFooter['c_cif']); ?></font>
                                </div>
                            </th>
                            <th colspan="2" style="text-align:left"></th>
                            <th style="text-align:right"><?= $resultFooter['c_botol_akhir']; ?> Btl(s)</th>
                            <th style="text-align:right"><?= round($resultFooter['c_liter_akhir']); ?> Ltr(s)</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
                Invoice | IT Inventory <?= $resultHeadSetting['company'] ?>
            </p>
            <p class="text-center">
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>
                    <?= $resultHeadSetting['website'] ?></span>
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>
                    T:<?= $resultHeadSetting['telp'] ?></span>
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                    <?= $resultHeadSetting['email'] ?></span>
            </p>
        </div>
    </div>
</div>
<!-- End Begin Row -->
<script src="assets/js/theme/default.min.js"></script>
<script src="assets/plugins/d3/d3.min.js"></script>
<script src="assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
<br>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>