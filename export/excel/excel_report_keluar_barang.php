<?php
include "../include/connection.php";
// Data
$dataHeadSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultHeadSetting = mysqli_fetch_array($dataHeadSettting);

header("Content-type: application/vnd-ms-excel");
date_default_timezone_set("Asia/Bangkok");
$datenow = date('d-m-Y h-i-s');

header("Content-Disposition: attachment; filename=Laporan Keluar Barang$datenow.xls");

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

// var_dump($_POST['StartTanggal']);
// exit;

// API - 
include "../include/api.php";
$content = get_content($resultAPI['url_api'] . 'reportKeluarBarang.php?StartTanggal=' . $_POST['StartTanggal'] . '&EndTanggal=' . $_POST['EndTanggal']);
$data = json_decode($content, true);
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
    <?php if ($resultHeadSetting['icon'] == NULL) { ?>
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/icon/icon-default.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icon/icon-default.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/icon/icon-default.png">
    <?php } else { ?>
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/icon/<?= $resultHeadSetting['icon'] ?>">
    <?php } ?>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="../assets/sweet/sweetalert2.all.js"></script>
    <script src="../assets/sweet/sweetalert2.all.min.js"></script>
    <script src="../assets/sweet/sweetalert2.js"></script>
    <script src="../assets/sweet/sweetalert2.min.js"></script>
    <!-- Font Poppins -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <!-- FONTAWESON 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/solid.css"
        integrity="sha384-DhmF1FmzR9+RBLmbsAts3Sp+i6cZMWQwNTRsew7pO/e4gvzqmzcpAzhDIwllPonQ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/fontawesome.css"
        integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous" />
    <!-- Google tag (gtag.js) -->
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

<body>

    <div id="content" class="nav-top-content">
        <div class="title-laporan" style="justify-content: center;text-align: center;align-items: center;">
            <img src="../assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="20%">
        </div>
        <br>
        <div class="title-laporan"
            style="justify-content: center;text-align: center;align-items: center;display: grid;">
            <font style="font-size: 20px;text-transform: uppercase;font-weight: 900;">LAPORAN PENGELUARAN BARANG PER
                DOKUMEN PABEAN</font>
            <br>
            <font>DI GUDANG BERIKAT PT BHANDA GHARA REKSA, JALAN BOULEVARD, KOMPLEK PERGUDANGAN PT BGR BLOK J1, KELAPA
                GADING, JAKARTA UTARA</font>
            <br>
            <font>PT. Sarinah </font>
            <br>
            <font>Tanggal: <?= $_POST['StartTanggal']; ?> S.D <?= $_POST['EndTanggal']; ?></font>
        </div>
    </div>
    <hr>
    <table id="table-keluar-barang" class="table table-striped table-bordered table-td-valign-middle">
        <thead>
            <tr>
                <th rowspan="2" width="1%">#</th>
                <th colspan="3" style="text-align: center;">Dokumen Pabean</th>
                <th colspan="2" style="text-align: center;">Bukti Pengeluaran</th>
                <th rowspan="2" style="text-align: center;">Pembeli / Penerima</th>
                <th rowspan="2" style="text-align: center;">Kode Barang (No. HS)</th>
                <th rowspan="2" style="text-align: center;">Barang</th>
                <th rowspan="2" style="text-align: center;">Jumlah</th>
                <th rowspan="2" style="text-align: center;">Nilai Barang</th>
            </tr>
            <tr>
                <th style="text-align: center;">Jenis</th>
                <th style="text-align: center;">No.</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">No.</th>
                <th style="text-align: center;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data['status'] == 404) { ?>
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
            <?php foreach ($data['result'] as $row) { ?>
            <?php $no++ ?>
            <tr>
                <!-- 9 -->
                <!-- NO -->
                <td><?= $no ?>.</td>
                <!-- BC -->
                <td style="text-align: center;">BC <?= $row['KODE_DOKUMEN_PABEAN']; ?></td>
                <!-- AJU -->
                <td style="text-align: center">
                    <?php if ($row['NOMOR_DAFTAR'] == NULL) { ?>
                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                    </font>
                    <?php } else { ?>
                    <?= $row['NOMOR_DAFTAR']; ?>
                    <?php } ?>
                </td>
                <!-- TGL AJU (FILTER) -->
                <!-- <?php
                                $dataTGLAJU = $row['TGL_AJU'];
                                $dataTGLAJUY = substr($dataTGLAJU, 0, 4);
                                $dataTGLAJUM = substr($dataTGLAJU, 4, 2);
                                $dataTGLAJUD =  substr($dataTGLAJU, 6, 2);

                                $datTGLAJU = $dataTGLAJUY . '-' . $dataTGLAJUM . '-' . $dataTGLAJUD;
                                ?>
                                            <td><?= $datTGLAJU; ?></td> -->
                <td style="text-align: center">
                    <?php if ($row['TANGGAL_DAFTAR'] == NULL) { ?>
                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                    </font>
                    <?php } else { ?>
                    <?= $row['TANGGAL_DAFTAR']; ?>
                    <?php } ?>
                </td>
                <!-- NOMOR BC 11 -->
                <td style="text-align: center">
                    <?php if ($row['NOMOR_BC11'] == NULL) { ?>
                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                    </font>
                    <?php } else { ?>
                    <?= $row['NOMOR_BC11']; ?>
                    <?php } ?>
                </td>
                <!-- TGL BC 11 -->
                <td style="text-align: center">
                    <?php if ($row['TANGGAL_BC11'] == NULL) { ?>
                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                    </font>
                    <?php } else { ?>
                    <?= SUBSTR($row['TANGGAL_BC11'], 0, 10); ?>
                    <?php } ?>
                </td>
                <!-- NAMA PEMASOK -->
                <td style="text-align: center">
                    <?php if ($row['NAMA_PEMASOK'] == NULL) { ?>
                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                    </font>
                    <?php } else { ?>
                    <?= $row['NAMA_PEMASOK']; ?>
                    <?php } ?>
                </td>
                <!-- HS -->
                <td style="text-align: center">
                    <?php
                            if ($row['KODE_BARANG'] == NULL) {
                                $KDBRG = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                            } else {
                                $KDBRG = $row['KODE_BARANG'];
                            }
                            if ($row['POS_TARIF'] == NULL) {
                                $POSTARIF = "<font style='font-size: 8px;font-weight: 600;color: red'><i>Data Kosong!</i></font>";
                            } else {
                                $POSTARIF = $row['POS_TARIF'];
                            }
                            ?>
                    <?= $KDBRG ?> (<?= $POSTARIF ?>)
                </td>
                <!-- BARANG -->
                <td><?= $row['URAIAN']; ?></td>
                <td>
                    <div style="display: flex;justify-content: space-between;align-items: center">
                        <font><?= $row['KODE_SATUAN']; ?></font>
                        <font><?= $row['JUMLAH_SATUAN']; ?></font>
                    </div>
                </td>
                <td>
                    <div style="display: flex;justify-content: space-between;align-items: center">
                        <font><?= $row['KODE_VALUTA']; ?></font>
                        <font><?= $row['CIF']; ?></font>
                    </div>
                </td>
            </tr>
            <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>