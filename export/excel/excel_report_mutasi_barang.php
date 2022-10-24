<?php
include "../include/connection.php";
// Data
$dataHeadSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultHeadSetting = mysqli_fetch_array($dataHeadSettting);

header("Content-type: application/vnd-ms-excel");
date_default_timezone_set("Asia/Bangkok");
$datenow = date('d-m-Y h-i-s');

header("Content-Disposition: attachment; filename=Laporan Mutasi Barang$datenow.xls");

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
    <?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
        <title>TPBERP | PT. Sarinah </title>
    <?php } else { ?>
        <title><?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> - <?= $resultHeadSetting['title'] ?></title>
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/solid.css" integrity="sha384-DhmF1FmzR9+RBLmbsAts3Sp+i6cZMWQwNTRsew7pO/e4gvzqmzcpAzhDIwllPonQ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/fontawesome.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous" />
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
        <div class="title-laporan" style="justify-content: center;text-align: center;align-items: center;display: grid;">
            <font style="font-size: 20px;text-transform: uppercase;font-weight: 900;">LAPORAN PERTANGGUNGJAWABAN MUTASI BARANG</font>
            <br>
            <font>DI GUDANG BERIKAT PT BHANDA GHARA REKSA, JALAN BOULEVARD, KOMPLEK PERGUDANGAN PT BGR BLOK J1, KELAPA GADING, JAKARTA UTARA</font>
            <br>
            <font>PT. Sarinah </font>
            <?php
            if ($_POST['Month'] == '01') {
                $DecMont = 'Januari';
            } else if ($_POST['Month'] == '02') {
                $DecMont = 'Februari';
            } else if ($_POST['Month'] == '03') {
                $DecMont = 'Maret';
            } else if ($_POST['Month'] == '04') {
                $DecMont = 'April';
            } else if ($_POST['Month'] == '05') {
                $DecMont = 'Mei';
            } else if ($_POST['Month'] == '06') {
                $DecMont = 'Juni';
            } else if ($_POST['Month'] == '07') {
                $DecMont = 'Juli';
            } else if ($_POST['Month'] == '08') {
                $DecMont = 'Agustus';
            } else if ($_POST['Month'] == '09') {
                $DecMont = 'September';
            } else if ($_POST['Month'] == '10') {
                $DecMont = 'Oktober';
            } else if ($_POST['Month'] == '11') {
                $DecMont = 'November';
            } else if ($_POST['Month'] == '12') {
                $DecMont = 'Desember';
            }
            ?>
            <br>
            <font>Periode: <?= $DecMont; ?> / <?= $_POST['Year']; ?></font>
        </div>
    </div>
    <hr>
    <table id="example1" border="1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="1%">#</th>
                <th style="text-align: center;">Kode Barang (No. HS)</th>
                <th style="text-align: center;">Barang</th>
                <th style="text-align: center;">Jenis</th>
                <th style="text-align: center;">Golongan</th>
                <th style="text-align: center;">Satuan</th>
                <th style="text-align: center;">Saldo Awal</th>
                <th style="text-align: center;">Mutasi Masuk</th>
                <th style="text-align: center;">Mutasi Keluar</th>
                <th style="text-align: center;">Penyesuaian</th>
                <th style="text-align: center;">Saldo Akhir</th>
                <th style="text-align: center;">Stock Opname</th>
                <th style="text-align: center;">Selisih</th>
                <th style="text-align: center;">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST["find_"])) {
                $Month = $_POST['Month'];
                $Year   = $_POST['Year'];
                $dataTable = $dbcon->query("SELECT brg.KODE_BARANG,brg.URAIAN,brg.UKURAN,brg.SPESIFIKASI_LAIN,brg.KODE_SATUAN,
                                                    hdr.NOMOR_BC11,hdr.TANGGAL_BC11
                                            FROM plb_header AS hdr
                                            LEFT OUTER JOIN plb_barang AS brg ON hdr.NOMOR_AJU=brg.NOMOR_AJU
                                            WHERE SUBSTR(hdr.TANGGAL_BC11,6,2) LIKE '%$Month%'
                                            AND SUBSTR(hdr.TANGGAL_BC11,1,4) LIKE '%$Year%'
                                            ORDER BY hdr.TANGGAL_BC11 ASC");
            }
            if (mysqli_num_rows($dataTable) > 0) {
                $no = 0;
                while ($row = mysqli_fetch_array($dataTable)) {
                    $no++;
            ?>
                    <tr>
                        <!-- 9 -->
                        <td><?= $no ?>.</td>
                        <td><?= $row['KODE_BARANG']; ?></td>
                        <td><?= $row['URAIAN']; ?></td>
                        <td><?= $row['UKURAN']; ?></td>
                        <td><?= $row['SPESIFIKASI_LAIN']; ?></td>
                        <td><?= $row['KODE_SATUAN']; ?></td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
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
</body>

</html>