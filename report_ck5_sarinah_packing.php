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
$DataCK5PLB = $dbcon->query("SELECT * FROM tpb_header WHERE NOMOR_AJU='$dataGETAJU'");
$resultDataCK5PLB = mysqli_fetch_array($DataCK5PLB);

// Cari Nama Kantor Pemasok
$forNamaKantor = $resultDataCK5PLB['KPPBC'];
$DataNamaKantor = $dbcon->query("SELECT URAIAN_KANTOR FROM referensi_kantor_pabean WHERE KODE_KANTOR='$forNamaKantor'");
$resultDataNamaKantor = mysqli_fetch_array($DataNamaKantor);

// Cari Nama Kantor Tujuan
$forNamaKantorTujuan = $resultDataCK5PLB['KODE_KANTOR_TUJUAN'];
$DataNamaKantorTujuan = $dbcon->query("SELECT URAIAN_KANTOR FROM referensi_kantor_pabean WHERE KODE_KANTOR='$forNamaKantorTujuan'");
$resultDataNamaKantorTujuan = mysqli_fetch_array($DataNamaKantorTujuan);

// Cari Tanggal SKEP
$forTanggalSKEP = $resultDataCK5PLB['NOMOR_IJIN_TPB'];
$DataTanggalSKEP = $dbcon->query("SELECT *, SUBSTR(TANGGAL_SKEP,1,10) AS for_tgl_skep FROM referensi_pengusaha WHERE NOMOR_SKEP='$forTanggalSKEP'");
$resultDataTanggalSKEP = mysqli_fetch_array($DataTanggalSKEP);


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
        'Augustus',
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
    <?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>TPBERP | PT. Sarinah </title>
    <?php } else { ?>
    <title><?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/solid.css"
        integrity="sha384-DhmF1FmzR9+RBLmbsAts3Sp+i6cZMWQwNTRsew7pO/e4gvzqmzcpAzhDIwllPonQ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/fontawesome.css"
        integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous" />
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
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

.line-page-table {
    height: 2.5px;
    margin: 0px 0px 15px 0px;
    background: #1d2226;
}

.line-page-table-n {
    height: 0.5px;
    margin: 0px 0px 15px 0px;
    background: #1d2226;
}
</style>

<body>
    <div id="content" class="nav-top-content">
        <div class="invoice">
            <div class="invoice-company">
                <div class="row">
                    <div class="col-sm-12" style="justify-content: end;">
                        <span class="pull-right hidden-print" style="margin-bottom: -17px;">
                            <a href="javascript:;" class="btn btn-sm btn-white m-b-10">
                                <img src="assets/img/favicon/excel.png" class="icon-primary-excel" alt="Excel"> Export
                                Excel
                            </a>
                            <a href="report_ck5_sarinah_invoice_print.php?AJU=<?= $_GET['AJU']; ?>"
                                class="btn btn-sm btn-white m-b-10">
                                <img src="assets/img/favicon/print.png" class="icon-primary-print" alt="Print"> Print
                            </a>
                        </span>
                    </div>
                </div>
            </div>
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
                    <div style="display: grid;justify-content: left;">
                        <font style="font-size: 24px;font-weight: 800;">LAPORAN CK5 Sarinah - Packing List</font>
                        <font style="font-size: 24px;font-weight: 800;">Nomor Pengajuan: <?= $dataGETAJU ?></font>
                        <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                        <div class="line-page-table"></div>
                        <font style="font-size: 14px;font-weight: 400;"><?= $resultHeadSetting['address'] ?></font>
                    </div>
                </div>
            </div>
            <br>
            <?php
            // API - 
            include "include/api.php";
            // Header
            $contentHeader = get_content($resultAPI['url_api'] . 'reportCK5SarinahPackingList.php?function=get_Header&AJU=' . $_GET['AJU']);
            $dataHeader = json_decode($contentHeader, true);
            foreach ($dataHeader['result'] as $row) {
                $ID_HDR = $row['ID'];
                $TGL_AJU = $row['TGL_AJU'];
                $KODE_DOKUMEN_PABEAN = $row['KODE_DOKUMEN_PABEAN'];
                $NAMA_PENERIMA_BARANG = $row['NAMA_PENERIMA_BARANG'];
                $NOMOR_IJIN_TPB_PENERIMA = $row['NOMOR_IJIN_TPB_PENERIMA'];
                $ID_PENERIMA_BARANG = $row['ID_PENERIMA_BARANG'];
                $ALAMAT_PENERIMA_BARANG = $row['ALAMAT_PENERIMA_BARANG'];
                $KODE_NEGARA_PEMASOK = $row['KODE_NEGARA_PEMASOK'];
                $NOMOR_AJU = $row['NOMOR_AJU'];

                $dataTGLAJU = $row['TGL_AJU'];
                $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
            }
            // Kontainer
            $contentKontainer = get_content($resultAPI['url_api'] . 'reportCK5SarinahPackingList.php?function=get_Kontainer&ID_HEADER=' . $ID_HDR);
            $dataKontainer = json_decode($contentKontainer, true);
            foreach ($dataKontainer['result'] as $row) {
                $ID_KON = $row['ID'];
                $NOMOR_KONTAINER = $row['NOMOR_KONTAINER'];
            }
            // Dokumen
            $contentDokumen = get_content($resultAPI['url_api'] . 'reportCK5SarinahPackingList.php?function=get_Dokumen&ID_HEADER=' . $ID_HDR);
            $dataDokumen = json_decode($contentDokumen, true);
            foreach ($dataDokumen['result'] as $row) {
                $ID_DOK = $row['ID'];
                $NOMOR_DOKUMEN = $row['NOMOR_DOKUMEN'];
            }
            ?>
            <!-- get invoice information / end -->
            <div class="invoice-content">
                <div class="table-responsive">
                    <table cellspacing="0" border="0">
                        <tr>
                            <td align="left" valign=middle><br></td>
                            <td align="left">
                                <font face="Arial Black" size=6 color="#404040">PACKING LIST</font>
                            </td>
                            <td align="left" valign=middle><br></td>
                            <td align="left" valign=middle><br></td>
                            <td align="left" valign=middle><br></td>
                            <td align="left" valign=middle><br></td>
                            <td align="left" valign=middle><br></td>
                            <td align="left" valign=middle><br></td>
                            <td align="left" valign=middle><br></td>
                            <td align="left" valign=middle><br></td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #969696" colspan=11 height="26" align="center"
                                valign=middle bgcolor="#ECECEC"><b>
                                    <font color="#404040"><br></font>
                                </b></td>
                            <td style="border-bottom: 1px solid #969696" colspan=7 align="center" valign=middle><b>
                                    <font color="#404040"><br></font>
                                </b></td>
                        </tr>
                        <tr>
                            <td style="border-top: 1px solid #969696" colspan=11 height="10" align="left">
                                <b>
                                    <font color="#0070C0"><br></font>
                                </b>
                            </td>
                            <td style="border-top: 1px solid #969696" colspan=7 align="left"><b>
                                    <font color="#0070C0"><br></font>
                                </b></td>
                        </tr>
                        <tr>
                            <td colspan=4 height="27" align="left" bgcolor="#FFFFFF" style="font-weight: 800;">Duty Free
                                Name</td>
                            <td align="left" bgcolor="#FFFFFF"><b>:</b></td>
                            <td colspan="2" align="left" valign=middle bgcolor="#FFFFFF">
                                <?= $NAMA_PENERIMA_BARANG; ?></td>
                            <td align="left" bgcolor="#FFFFFF"><b><br></b></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>

                            <td align="left" bgcolor="#FFFFFF" style="font-weight: 800;">Number</td>
                            <td align="right" valign=middle bgcolor="#FFFFFF"><b>:</b></td>
                            <td colspan="2" align="left" valign=middle bgcolor="#FFFFFF">
                                <?= $NOMOR_IJIN_TPB_PENERIMA; ?></td>

                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="center" valign=middle bgcolor="#FFFFFF" sdval="3" sdnum="1033;"></td>
                            <td align="left" valign=middle bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"></td>
                        </tr>
                        <tr>
                            <td colspan=4 height="27" align="left" bgcolor="#FFFFFF" style="font-weight: 800;">NPWP</td>
                            <td align="left" bgcolor="#FFFFFF"><b>:</b></td>
                            <td align="left" valign=middle bgcolor="#FFFFFF"><?= $ID_PENERIMA_BARANG; ?>
                            </td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF" style="font-weight: 800;">Ex Bill Of Lading</td>
                            <td align="right" valign=middle bgcolor="#FFFFFF"><b>:</b></td>
                            <td align="left" valign=middle><?= $NOMOR_KONTAINER; ?></td>
                            <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
                            <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
                            <td align="center" valign=middle bgcolor="#FFFFFF" sdval="25" sdnum="1033;"></td>
                            <td align="left" valign=middle bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"></td>
                        </tr>
                        <tr>
                            <td colspan=4 height="27" align="left" bgcolor="#FFFFFF" style="font-weight: 800;">Street
                                Address</td>
                            <td align="left" bgcolor="#FFFFFF"><b>:</b></td>
                            <td colspan="1" align="left" valign=middle bgcolor="#FFFFFF">
                                <?= $ALAMAT_PENERIMA_BARANG; ?></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF" style="font-weight: 800;">No. Dokumen</td>
                            <td align="right" valign=middle bgcolor="#FFFFFF"><b>:</b></td>
                            <td colspan=3 align="left" valign=middle bgcolor="#FFFFFF">
                                <?= $NOMOR_DOKUMEN; ?></td>
                            <td align="center" valign=middle bgcolor="#FFFFFF" sdval="22" sdnum="1033;"></td>
                            <td align="left" valign=middle bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"></td>
                        </tr>
                        <tr>
                            <td height="25" align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><b></b></td>
                            <td align="left" valign=middle bgcolor="#FFFFFF"></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF" style="font-weight: 800;">Original</td>
                            <td align="right" valign=middle bgcolor="#FFFFFF"><b>:</b></td>
                            <td align="left" bgcolor="#FFFFFF"><?= $KODE_NEGARA_PEMASOK; ?>
                            </td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"><br></td>
                        </tr>
                        <tr>
                            <td height="27" align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" valign=middle bgcolor="#FFFFFF"></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF" style="font-weight: 800;">BC <?= $KODE_DOKUMEN_PABEAN; ?>
                                Number</td>
                            <td align="right" bgcolor="#FFFFFF"><b>:</b></td>
                            <td colspan=2 align="left" bgcolor="#FFFFFF"><?= $NOMOR_AJU; ?>
                            </td>
                            <td align="left" bgcolor="#FFFFFF">
                                <?= "(" . $datTGLAJU . ")"; ?></td>
                        </tr>
                        <tr>
                            <td height="17" align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF"><br></td>
                            <td align="left" bgcolor="#FFFFFF" sdnum="1033;1057;DD MMMM YYYY;@"><br></td>
                        </tr>
                    </table>
                    <table id="example" class="table table-striped table-bordered first" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="text-align:center">Description</th>
                                <th style="text-align:center">SKU</th>
                                <th style="text-align:center">Details</th>
                                <th style="text-align:center">Quantity</th>
                                <th style="text-align:center">Bottle</th>
                                <th style="text-align:center">Litre(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Barang
                            $contentBarang = get_content($resultAPI['url_api'] . 'reportCK5SarinahPackingList.php?function=get_Barang&ID_HEADER=' . $ID_HDR);
                            $dataBarang = json_decode($contentBarang, true);
                            ?>
                            <?php if ($dataBarang['status'] == 404) { ?>
                            <tr>
                                <td colspan="12">
                                    <center>
                                        <div style="display: flex;justify-content: center; align-items: center">
                                            <i class="fas fa-filter"></i>&nbsp;&nbsp;Filter Data
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            <?php } else { ?>
                            <?php $no = 0; ?>
                            <?php foreach ($dataBarang['result'] as $row) { ?>
                            <?php $no++ ?>
                            <tr>
                                <td><?= $no ?>.</td>
                                <td><?= $row['URAIAN']; ?></td>
                                <td><?= $row['KODE_BARANG']; ?></td>
                                <td><?= $row['UKURAN']; ?></td>
                                <td><?= $row['JUMLAH_SATUAN']; ?></td>
                                <?php $bottleqty = $row['UKURAN'] * $row['JUMLAH_SATUAN']; ?>
                                <td><?= $bottleqty; ?></td>
                                <td><?= $bottleqty; ?></td>
                                <?php } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>TOTAL</td>
                                <td><b><?= $rowx['TotalQty']; ?></b></td>
                                <td><b><?= $row3['TotalBottle']; ?></b></td>
                                <td><b><?= $row5['TotalLitre']; ?></b></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="invoice-footer">
                <p class="text-center m-b-5 f-w-600">
                    Export CK5 Sarinah | IT Inventory <?= $resultHeadSetting['company'] ?>
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
    <?php
    // include "include/panel.php"; 
    ?>
    <?php include "include/panel.php"; ?>
    <?php include "include/footer.php"; ?>
    <?php include "include/jsDatatables.php"; ?>
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