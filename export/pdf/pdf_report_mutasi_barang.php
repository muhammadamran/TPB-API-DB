<?php
include "../include/connection.php";

$dataHeadSettting = $dbcon->query("SELECT * FROM tbl_setting");
$resultHeadSetting = mysqli_fetch_array($dataHeadSettting);

if (isset($_POST["find_"])) {
    $Month = $_POST['Month'];
    $Year   = $_POST['Year'];
}

if ($Month == '01') {
    $DecMont = 'Januari';
} else if ($Month == '02') {
    $DecMont = 'Februari';
} else if ($Month == '03') {
    $DecMont = 'Maret';
} else if ($Month == '04') {
    $DecMont = 'April';
} else if ($Month == '05') {
    $DecMont = 'Mei';
} else if ($Month == '06') {
    $DecMont = 'Juni';
} else if ($Month == '07') {
    $DecMont = 'Juli';
} else if ($Month == '08') {
    $DecMont = 'Agustus';
} else if ($Month == '09') {
    $DecMont = 'September';
} else if ($Month == '10') {
    $DecMont = 'Oktober';
} else if ($Month == '11') {
    $DecMont = 'November';
} else if ($Month == '12') {
    $DecMont = 'Desember';
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
    <title>Laporan Mutasi Barang - Periode: <?= $DecMont ?> / <?= $Year ?></title>
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
<?php
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
<body class="pace-done">
<!-- <div class="row"> -->
    <div style="background: #fff;">
        <div class="col-xl-12">
            <div class="line-page-table"></div>
        </div>
        <div class="col-xl-12">
            <div style="display: flex;align-items: center;margin-top: 15px;margin-bottom: -0px;">
                <div class="col-md-3">
                    <div style="display: flex;justify-content: center;">
                        <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                            <img src="../assets/images/logo/logo-default.png" width="30%">
                        <?php } else { ?>
                            <img src="../assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-9">
                    <div style="display: grid;justify-content: left;">
                        <font style="font-size: 24px;font-weight: 800;">LAPORAN PERTANGGUNGJAWABAN MUTASI BARANG</font>
                        <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                        <font style="font-size: 14px;font-weight: 800;">Periode: <?= $DecMont ?> / <?= $Year ?></font>
                        <div class="line-page-table"></div>
                        <font style="font-size: 14px;font-weight: 400;"><?= $resultHeadSetting['address'] ?></font>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="panel-body text-inverse">
                <div style="background: #4c4747;height: 4px;width: 100%;margin: 15px -1px;box-sizing: border-box;"></div>
                <!-- <div class="table-responsive"> -->
                    <table id="table-masuk-barang" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th style="text-align: center;">Tanggal</th>
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
                            $dataTable = $dbcon->query("SELECT brg.KODE_BARANG,brg.URAIAN,brg.UKURAN,brg.SPESIFIKASI_LAIN,brg.KODE_SATUAN,
                                                                        hdr.NOMOR_BC11,hdr.TANGGAL_BC11
                                                                FROM plb_header AS hdr
                                                                LEFT OUTER JOIN plb_barang AS brg ON hdr.NOMOR_AJU=brg.NOMOR_AJU
                                                                WHERE SUBSTR(hdr.TANGGAL_BC11,6,2) LIKE '%$Month%'
                                                                AND SUBSTR(hdr.TANGGAL_BC11,1,4) LIKE '%$Year%'
                                                                ORDER BY hdr.TANGGAL_BC11 ASC");
                            if (mysqli_num_rows($dataTable) > 0) {
                                $no = 0;
                                while ($row = mysqli_fetch_array($dataTable)) {
                                    $no++;
                                    ?>
                                    <tr>
                                        <!-- 9 -->
                                        <td><?= $no ?>.</td>
                                        <td><?= $row['TANGGAL_BC11']; ?></td>
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
                                    <td colspan="14">
                                        <center>
                                            <div style="display: flex;justify-content: center; align-items: center">
                                                <i class="fas fa-filter"></i>&nbsp;&nbsp;Filter Data
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            <?php }
                            mysqli_close($dbcon); ?>
                        </tbody>
                    </table>
                <!-- </div> -->
                <hr>
                <div class="invoice-footer">
                    <p class="text-center m-b-5 f-w-600">
                        Laporan Mutasi Barang | IT Inventory <?= $resultHeadSetting['company'] ?>
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> <?= $resultHeadSetting['website'] ?></span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:<?= $resultHeadSetting['telp'] ?></span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> <?= $resultHeadSetting['email'] ?></span>
                    </p>
                </div>
            </div>
        </div>
        <br>
    </div>
<!-- </div> -->
<!-- <script src="../assets/js/app.min.js"></script> -->
<script src="../assets/js/theme/default.min.js"></script>
<script src="../assets/plugins/d3/d3.min.js"></script>
<script src="../assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="../assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="../assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="../assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script src="../assets/plugins/gritter/js/jquery.gritter.js"></script>
</body>
<?php
// $html = ob_get_contents();
// ob_end_clean();

// require_once('../libraries/html2pdf460/html2pdf.class.php');
// require_once('../vendor/spipu/html2pdf/src/Html2Pdf.php');
// $pdf = new HTML2PDF('P', 'A4', 'en');
// $pdf = writeHTML($html);
// $pdf->Output('LaporanMasukBarang.pdf', 'D');
?>
<script type="text/javascript">
    window.print();    
</script>
</html>