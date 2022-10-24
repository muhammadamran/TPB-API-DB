<?php
include "../include/connection.php";
// Data
$dataHeadSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultHeadSetting = mysqli_fetch_array($dataHeadSettting);

header("Content-type: application/vnd-ms-excel");
date_default_timezone_set("Asia/Bangkok");
$datenow = date('d-m-Y h-i-s');

header("Content-Disposition: attachment; filename=Laporan Posisi Barang$datenow.xls");

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
            <font style="font-size: 20px;text-transform: uppercase;font-weight: 900;">LAPORAN POSISI BARANG PER DOKUMEN PABEAN</font>
            <br>
            <font>DI GUDANG BERIKAT PT BHANDA GHARA REKSA, JALAN BOULEVARD, KOMPLEK PERGUDANGAN PT BGR BLOK J1, KELAPA GADING, JAKARTA UTARA</font>
            <br>
            <font>PT. Sarinah </font>
            <br>
            <font>Tanggal Masuk: <?= $_POST['StartTanggal']; ?> S.D <?= $_POST['EndTanggal']; ?></font>
        </div>
    </div>
    <hr>
    <table id="example1" border="1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th rowspan="2" width="1%">#</th>
                <th colspan="3" style="text-align: center;">Dokumen Pabean Masuk</th>
                <th rowspan="2" style="text-align: center;">Tanggal Masuk</th>
                <th rowspan="2" style="text-align: center;">Kode Barang (No. HS)</th>
                <th rowspan="2" style="text-align: center;">Seri Barang</th>
                <th rowspan="2" style="text-align: center;">Barang</th>
                <th rowspan="2" style="text-align: center;">Jumlah</th>
                <th rowspan="2" style="text-align: center;">Nilai Barang</th>
                <th colspan="3" style="text-align: center;">Dokumen Pabean Keluar</th>
                <th rowspan="2" style="text-align: center;">Tanggal Keluar</th>
                <th rowspan="2" style="text-align: center;">Kode Barang (No. HS)</th>
                <th rowspan="2" style="text-align: center;">Seri Barang</th>
                <th rowspan="2" style="text-align: center;">Barang</th>
                <th rowspan="2" style="text-align: center;">Jumlah</th>
                <th rowspan="2" style="text-align: center;">Nilai Barang</th>
                <th colspan="2" style="text-align: center;">Saldo Barang</th>
            </tr>
            <tr>
                <th style="text-align: center;">Jenis</th>
                <th style="text-align: center;">No.</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Jenis</th>
                <th style="text-align: center;">No.</th>
                <th style="text-align: center;">Tanggal</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: center;">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST["find_"])) {
                $StartTanggal = $_POST['StartTanggal'];
                $EndTanggal   = $_POST['EndTanggal'];
                $dataTable = $dbcon->query("SELECT hdr.NOMOR_BC11 AS PLB_NOMOR_BC11,hdr.TANGGAL_BC11 AS PLB_TANGGAL_BC11,hdr.PEMASOK,tpb.NOMOR_BC11 AS TPB_NOMOR_BC11,tpb.TANGGAL_BC11 AS TPB_TANGGAL_BC11,
                                                    brg.KODE_BARANG,brg.URAIAN,brg.KODE_SATUAN,brg.JUMLAH_SATUAN,hdr.KODE_VALUTA,brg.CIF,brg.SERI_BARANG
                                            FROM plb_header AS hdr
                                            LEFT OUTER JOIN tpb_header AS tpb ON hdr.NOMOR_DAFTAR=tpb.NOMOR_DAFTAR
                                            LEFT OUTER JOIN plb_barang AS brg ON hdr.NOMOR_AJU=brg.NOMOR_AJU
                                            WHERE hdr.TANGGAL_BC11 BETWEEN '$StartTanggal' AND '$EndTanggal'
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
                        <td>BC2.3</td>
                        <td><?= $row['PLB_NOMOR_BC11']; ?></td>
                        <td><?= $row['PLB_TANGGAL_BC11']; ?></td>
                        <td><?= $row['PLB_TANGGAL_BC11']; ?></td>
                        <td><?= $row['KODE_BARANG']; ?></td>
                        <td><?= $row['SERI_BARANG']; ?></td>
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
                        <td>BC2.7</td>
                        <td><?= $row['TPB_NOMOR_BC11']; ?></td>
                        <td><?= $row['TPB_TANGGAL_BC11']; ?></td>
                        <td><?= $row['TPB_TANGGAL_BC11']; ?></td>
                        <td><?= $row['KODE_BARANG']; ?></td>
                        <td><?= $row['SERI_BARANG']; ?></td>
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