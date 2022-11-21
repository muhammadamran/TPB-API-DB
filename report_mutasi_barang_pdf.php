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
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
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

$FindBulan = '';
$FindTahun = '';
$ShowFind  = 'Bulan ' . date('m') . ' Tahun ' . date('Y');

if (isset($_POST["FindFilter"])) {
    $FindBulan = $_POST['FindBulan'];
    $FindTahun = $_POST['FindTahun'];
    $ShowFind  = 'Bulan ' . $_POST['FindBulan'] . ' Tahun ' . $_POST['FindTahun'];
}
?>
<?php if (isset($_POST["FindFilter"])) { ?>
    <title>Print Laporan Mutasi Barang <?= $ShowFind; ?>_<?= date('Ymd_H:m:i') ?></title>
<?php } else { ?>
    <title>Print Laporan Mutasi Barang 100 Data Terakhir_<?= date('Ymd_H:m:i') ?></title>
<?php } ?>

<body class="pace-done">
    <br>
    <!-- Begin Row -->
    <div class="row" style="margin-left: 0px;margin-right: 0px;">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="row" style="display: flex;align-items: center;margin-top: 15px;margin-bottom: -0px;padding: 25px;margin: 10px;">
                    <div class="col-md-3">
                        <div style="display: flex;justify-content: center;">
                            <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                                <img src="assets/images/logo/logo-default.png" width="30%">
                            <?php } else { ?>
                                <img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-7" style="display: grid;justify-content: left;margin-bottom:-30px">
                        <font style="font-size: 24px;font-weight: 800;">LAPORAN PERTANGGUNGJAWABAN MUTASI BARANG</font>
                        <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                        <font style="font-size: 14px;font-weight: 800;">
                            Periode: <?= $ShowFind; ?>
                        </font>
                        <font style="font-size: 18px;font-weight: 800;"><?= $resultHeadSetting['company_t'] ?></font>
                        <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?>
                        </font>
                    </div>
                    <div class="col-md-2" style="display: grid;justify-content: left;">
                        <br>
                        <font style="font-size: 12px;font-weight: 600;"><?= $resultHeadSetting['app_name'] ?></font>
                        <font style="font-size: 12px;font-weight: 600;">Print By: <?= $_SESSION['username'] ?></font>
                        <font style="font-size: 12px;font-weight: 600;">Date Time: <?= date_indo_s(date('Y-m-d'), TRUE) ?> <?= date('H:m:i') ?></font>
                    </div>
                </div>
                <div class="panel-body text-inverse">
                    <table id="C_TableDefault_L" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th rowspan="2" width="1%">No.</th>
                                <th rowspan="2" style="text-align: center;">KD<font style="color: transparent;">.</font>Barang</th>
                                <th rowspan="2" style="text-align: center;">Uraian</th>
                                <th rowspan="2" style="text-align: center;">Spe.<font style="color: transparent;">.</font>Lain</th>
                                <th rowspan="2" style="text-align: center;">Satuan</th>
                                <th colspan="2" style="text-align: center;">Saldo Awal</th>
                                <th colspan="2" style="text-align: center;">Mutasi<font style="color: transparent;">.</font>Masuk</th>
                                <th colspan="2" style="text-align: center;">Mutasi<font style="color: transparent;">.</font>Keluar</th>
                                <th colspan="2" style="text-align: center;">Saldo<font style="color: transparent;">.</font>Akhir</th>
                                <th rowspan="2" style="text-align: center;">
                                    <i>S.<font style="color: transparent;">.</font>Opname</i>
                                    <br>
                                    <font style="font-size: 10px;font-weight:400"><i>Berd.<font style="color: transparent;">.</font>Botol</i></font>
                                </th>
                                <th colspan="2" style="text-align: center;">Selisih</th>
                                <th colspan="2" style="text-align: center;">Penyesuaian</th>
                                <th colspan="2" style="text-align: center;">Ket.</th>
                                <th colspan="2" style="text-align: center;">Pet.<font style="color: transparent;">.</font><?= $resultHeadSetting['company']; ?></th>
                                <th colspan="2" style="text-align: center;">Pet.<font style="color: transparent;">.</font>BeaCukai</th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">CT</th>
                                <th style="text-align: center;">BTL</th>
                                <th style="text-align: center;">CT</th>
                                <th style="text-align: center;">BTL</th>
                                <th style="text-align: center;">CT</th>
                                <th style="text-align: center;">BTL</th>
                                <th style="text-align: center;">CT</th>
                                <th style="text-align: center;">BTL</th>
                                <th style="text-align: center;">CT</th>
                                <th style="text-align: center;">BTL</th>
                                <th style="text-align: center;">G.<font style="color: transparent;">.</font>In</th>
                                <th style="text-align: center;">G.<font style="color: transparent;">.</font>Out</th>
                                <th style="text-align: center;">G.<font style="color: transparent;">.</font>In</th>
                                <th style="text-align: center;">G.<font style="color: transparent;">.</font>Out</th>
                                <th style="text-align: center;">G.<font style="color: transparent;">.</font>In</th>
                                <th style="text-align: center;">G.<font style="color: transparent;">.</font>Out</th>
                                <th style="text-align: center;">G.<font style="color: transparent;">.</font>In</th>
                                <th style="text-align: center;">G.<font style="color: transparent;">.</font>Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dateMB        = date('m');
                            $dateYB        = date('Y');
                            if (isset($_POST['FindFilter'])) {
                                $dataTable = $dbcon->query("SELECT 
                                                                stok.kd_barang,
                                                                stok.uraian AS uraian_stok,
                                                                stok.carton AS carton_stok,
                                                                stok.botol AS botol_stok,
                                                                stok.stock_month,
                                                                stok.stock_year,
                                                                brg.ID,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.BOTOL,
                                                                brg.SERI_BARANG,
                                                                rcd.bm_nama_operator,
                                                                rcd.bk_nama_operator,
                                                                rcd.bc_in,
                                                                rcd.bc_out,
                                                                -- MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                                (SELECT SUM(TOTAL_CT_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM DATE_CT)='$FindTahun') AS MUTASI_MASUK_CT,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM DATE_CT)='$FindTahun') AS MUTASI_MASUK_BTL,
                                                                -- END MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                                -- MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                                (SELECT SUM(TOTAL_CT_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM DATE_CT)='$FindTahun') AS MUTASI_KELUAR_CT,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM DATE_CT)='$FindTahun') AS MUTASI_KELUAR_BTL,
                                                                -- END MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                                -- SALDO AKHIR
                                                                -- STOK KD BARANG + MUTASI_KELUAR
                                                                -- END SALDO AKHIR
                                                                -- STOCK OPNAME
                                                                -- END STOCK OPNAME
                                                                -- STOK BOTOL + BARANG REJECT IN + BARANG REJECT OUT
                                                                -- PENYESUAIAN
                                                                -- IN
                                                                (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS K_IN,
                                                                (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS L_IN,
                                                                (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS P_IN,
                                                                (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS R_IN,
                                                                -- OUT
                                                                (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS K_OUT,
                                                                (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS L_OUT,
                                                                (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS P_OUT,
                                                                (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS R_OUT
                                                                -- PENYESUAIAN
                                                                FROM plb_barang AS brg
                                                                LEFT OUTER JOIN tbl_cust_stock AS stok ON brg.KODE_BARANG=stok.kd_barang AND stok.stock_month='$FindBulan' AND stok.stock_year='$FindTahun'
                                                                LEFT OUTER JOIN rcd_status AS rcd ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                WHERE EXTRACT(MONTH FROM brg.DATE_CT)='$FindBulan' AND EXTRACT(YEAR FROM brg.DATE_CT)='$FindTahun'
                                                                GROUP BY brg.KODE_BARANG 
                                                                ORDER BY brg.KODE_BARANG ASC, brg.SERI_BARANG ASC", 0);
                            } else {
                                $dataTable = $dbcon->query("SELECT 
                                                                stok.kd_barang,
                                                                stok.uraian AS uraian_stok,
                                                                stok.carton AS carton_stok,
                                                                stok.botol AS botol_stok,
                                                                stok.stock_month,
                                                                stok.stock_year,
                                                                brg.ID,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.BOTOL,
                                                                brg.SERI_BARANG,
                                                                rcd.bm_nama_operator,
                                                                rcd.bk_nama_operator,
                                                                rcd.bc_in,
                                                                rcd.bc_out,
                                                                -- MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                                (SELECT SUM(TOTAL_CT_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM DATE_CT)='$dateYB') AS MUTASI_MASUK_CT,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM DATE_CT)='$dateYB') AS MUTASI_MASUK_BTL,
                                                                -- END MUTASI MASUK KONDISI BARANG MASUK (GATE IN)
                                                                -- MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                                (SELECT SUM(TOTAL_CT_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM DATE_CT)='$dateYB') AS MUTASI_KELUAR_CT,
                                                                (SELECT SUM(TOTAL_BOTOL_AKHIR_GB) FROM plb_barang WHERE KODE_BARANG=brg.KODE_BARANG AND STATUS_GB='Sesuai' AND EXTRACT(MONTH FROM DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM DATE_CT)='$dateYB') AS MUTASI_KELUAR_BTL,
                                                                -- END MUTASI KELUAR KONDISI BARANG KELUAR (GATE OUT)
                                                                -- SALDO AKHIR
                                                                -- STOK KD BARANG + MUTASI_KELUAR
                                                                -- END SALDO AKHIR
                                                                -- STOCK OPNAME
                                                                -- END STOCK OPNAME
                                                                -- STOK BOTOL + BARANG REJECT IN + BARANG REJECT OUT
                                                                -- PENYESUAIAN
                                                                -- IN
                                                                (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS K_IN,
                                                                (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS L_IN,
                                                                (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS P_IN,
                                                                (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='IN' AND PENY IS NULL) AS R_IN,
                                                                -- OUT
                                                                (SELECT SUM(KURANG) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS K_OUT,
                                                                (SELECT SUM(LEBIH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS L_OUT,
                                                                (SELECT SUM(PECAH) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS P_OUT,
                                                                (SELECT SUM(RUSAK) FROM plb_barang_ct_botol WHERE KODE_BARANG=brg.KODE_BARANG AND NOMOR_AJU=brg.NOMOR_AJU AND POSISI='OUT' AND PENY IS NULL) AS R_OUT
                                                                -- PENYESUAIAN
                                                                FROM plb_barang AS brg
                                                                LEFT OUTER JOIN tbl_cust_stock AS stok ON brg.KODE_BARANG=stok.kd_barang AND stok.stock_month='$dateMB' AND stok.stock_year='$dateYB'
                                                                LEFT OUTER JOIN rcd_status AS rcd ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                WHERE EXTRACT(MONTH FROM brg.DATE_CT)='$dateMB' AND EXTRACT(YEAR FROM brg.DATE_CT)='$dateYB'
                                                                GROUP BY brg.KODE_BARANG 
                                                                ORDER BY brg.KODE_BARANG ASC, brg.SERI_BARANG ASC", 0);
                            }
                            if ($dataTable) : $no = 1;
                                foreach ($dataTable as $row) :
                                    // PENYESUAIAN IN
                                    $P_IN = $row['K_IN'] + $row['L_IN'] + $row['P_IN'] + $row['R_IN'];
                                    // PENYESUAIAN OUT
                                    $P_OUT = $row['K_OUT'] + $row['L_OUT'] + $row['P_OUT'] + $row['R_OUT'];
                            ?>
                                    <tr>
                                        <td><?= $no ?>.</td>
                                        <!-- Kode Barang -->
                                        <td style="text-align: left;">
                                            <?php if ($row['KODE_BARANG'] == NULL) { ?>
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                </font>
                                            <?php } else { ?>
                                                <?= $row['KODE_BARANG']; ?>
                                            <?php } ?>
                                        </td>
                                        <!-- Barang -->
                                        <td style="text-align: left;">
                                            <?php if ($row['URAIAN'] == NULL) { ?>
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                </font>
                                            <?php } else { ?>
                                                <?= $row['URAIAN']; ?>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if ($row['SPESIFIKASI_LAIN'] == NULL) { ?>
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                </font>
                                            <?php } else { ?>
                                                <?= $row['SPESIFIKASI_LAIN']; ?>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if ($row['KODE_SATUAN'] == NULL) { ?>
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                </font>
                                            <?php } else { ?>
                                                <?= $row['KODE_SATUAN']; ?>
                                            <?php } ?>
                                        </td>
                                        <!-- Saldo Awal -->
                                        <!-- CT -->
                                        <td style="text-align: center;">
                                            <?php if ($row['carton_stok'] == NULL) { ?>
                                                0<font style="font-size: 3px;">(SCtn)</font>
                                            <?php } else { ?>
                                                <?= $row['carton_stok']; ?><font style="font-size: 3px;">(SCtn)</font>
                                            <?php } ?>
                                        </td>
                                        <!-- Botol -->
                                        <td style="text-align: center;">
                                            <?php if ($row['botol_stok'] == NULL) { ?>
                                                0<font style="font-size: 3px;">(SBtl)</font>
                                            <?php } else { ?>
                                                <?= $row['botol_stok']; ?><font style="font-size: 3px;">(SBtl)</font>
                                            <?php } ?>
                                        </td>
                                        <!-- End Saldo Awal -->
                                        <!-- Mutasi Masuk -->
                                        <!-- CT -->
                                        <td style="text-align: center;">
                                            <?php if ($row['MUTASI_MASUK_CT'] == NULL) { ?>
                                                0<font style="font-size: 3px;">(MInBtl)</font>
                                            <?php } else { ?>
                                                <?= $row['MUTASI_MASUK_CT']; ?><font style="font-size: 3px;">(MInBtl)</font>
                                            <?php } ?>
                                        </td>
                                        <!-- Botol -->
                                        <td style="text-align: center;">
                                            <?php if ($row['MUTASI_MASUK_BTL'] == NULL) { ?>
                                                0<font style="font-size: 3px;">(MInBtl)</font>
                                            <?php } else { ?>
                                                <?= $row['MUTASI_MASUK_BTL']; ?><font style="font-size: 3px;">(MInBtl)</font>
                                            <?php } ?>
                                        </td>
                                        <!-- End Mutasi Masuk -->
                                        <!-- Mutasi keluar -->
                                        <!-- CT -->
                                        <td style="text-align: center;">
                                            <?php if ($row['MUTASI_KELUAR_CT'] == NULL) { ?>
                                                0<font style="font-size: 3px;">(MOutCtn)</font>
                                            <?php } else { ?>
                                                <?= $row['MUTASI_KELUAR_CT']; ?><font style="font-size: 3px;">(MOutCtn)</font>
                                            <?php } ?>
                                        </td>
                                        <!-- Botol -->
                                        <td style="text-align: center;">
                                            <?php if ($row['MUTASI_KELUAR_BTL'] == NULL) { ?>
                                                0<font style="font-size: 3px;">(MOutBtl)</font>
                                            <?php } else { ?>
                                                <?= $row['MUTASI_KELUAR_BTL']; ?><font style="font-size: 3px;">(MOutBtl)</font>
                                            <?php } ?>
                                        </td>
                                        <!-- End Mutasi keluar -->
                                        <!-- End Penyesuaian -->
                                        <!-- Saldo Akhir -->
                                        <!-- CT -->
                                        <td style="text-align: center;">
                                            <?= $row['carton_stok'] + $row['MUTASI_KELUAR_CT']; ?><font style="font-size: 3px;">(MSACtn)</font>
                                        </td>
                                        <!-- Botol -->
                                        <td style="text-align: center;">
                                            <?= $row['botol_stok'] + $row['MUTASI_KELUAR_BTL']; ?><font style="font-size: 3px;">(MSABtl)</font>
                                        </td>
                                        <!-- End Saldo Akhir -->
                                        <!-- Stok Opname -->
                                        <!-- Botol -->
                                        <td style="text-align: center;">
                                            <?= $row['botol_stok'] + $P_IN + $P_OUT ?><font style="font-size: 3px;">(SO)</font>
                                        </td>
                                        <!-- End Stok Opname -->
                                        <!-- Selisih -->
                                        <!-- CT -->
                                        <td style="text-align: center;">
                                            <?= $row['MUTASI_MASUK_CT'] - $row['MUTASI_KELUAR_CT']; ?><font style="font-size: 3px;">(Selisih)</font>
                                        </td>
                                        <!-- Botol -->
                                        <td style="text-align: center;">
                                            <?= $row['MUTASI_MASUK_BTL'] - $row['MUTASI_KELUAR_BTL']; ?><font style="font-size: 3px;">(Selisih)</font>
                                        </td>
                                        <!-- End Selisih -->
                                        <!-- Penyesuaian -->
                                        <!-- IN -->
                                        <td style="text-align: center;">
                                            <?= $P_IN; ?><font style="font-size: 3px;">(PenyesuaianIN)</font>
                                        </td>
                                        <!-- OUT -->
                                        <td style="text-align: center;">
                                            <?= $P_OUT; ?><font style="font-size: 3px;">(PenyesuaianOUT)</font>
                                        </td>
                                        <!-- END Penyesuaian -->
                                        <!-- Keterangan -->
                                        <!-- IN -->
                                        <td style="text-align: left;font-size:10px">
                                            <?php if ($row['K_IN'] == NULL && $row['L_IN'] == NULL && $row['P_IN'] == NULL && $row['R_IN'] == NULL) { ?>
                                                <center>
                                                    0
                                                </center>
                                            <?php } else { ?>
                                                <?php if ($row['K_IN'] != NULL) { ?>
                                                    Kurang=<?= $row['K_IN']; ?>;
                                                <?php } ?>
                                                <?php if ($row['L_IN'] != NULL) { ?>
                                                    Lebih=<?= $row['L_IN']; ?>;
                                                <?php } ?>
                                                <?php if ($row['P_IN'] != NULL) { ?>
                                                    Pecah=<?= $row['P_IN']; ?>;
                                                <?php } ?>
                                                <?php if ($row['R_IN'] != NULL) { ?>
                                                    Rusak=<?= $row['R_IN']; ?>;
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <!-- OUT -->
                                        <td style="text-align: left;font-size:10px">
                                            <?php if ($row['K_OUT'] == NULL && $row['L_OUT'] == NULL && $row['P_OUT'] == NULL && $row['R_OUT'] == NULL) { ?>
                                                <center>
                                                    0
                                                </center>
                                            <?php } else { ?>
                                                <?php if ($row['K_OUT'] != NULL) { ?>
                                                    Kurang=<?= $row['K_OUT']; ?>;
                                                <?php } ?>
                                                <?php if ($row['L_OUT'] != NULL) { ?>
                                                    Lebih=<?= $row['L_OUT']; ?>;
                                                <?php } ?>
                                                <?php if ($row['P_OUT'] != NULL) { ?>
                                                    Pecah=<?= $row['P_OUT']; ?>;
                                                <?php } ?>
                                                <?php if ($row['R_OUT'] != NULL) { ?>
                                                    Rusak=<?= $row['R_OUT']; ?>;
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <!-- End Keterangan -->
                                        <!-- Petugas Sarinah-->
                                        <!-- IN -->
                                        <td style="text-align: center;">
                                            <?php if ($row['bm_nama_operator'] == NULL) { ?>
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                </font>
                                            <?php } else { ?>
                                                <?= $row['bm_nama_operator']; ?>
                                            <?php } ?>
                                        </td>
                                        <!-- OUT -->
                                        <td style="text-align: center;">
                                            <?php if ($row['bk_nama_operator'] == NULL) { ?>
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                </font>
                                            <?php } else { ?>
                                                <?= $row['bk_nama_operator']; ?>
                                            <?php } ?>
                                        </td>
                                        <!-- Petugas BC -->
                                        <!-- IN -->
                                        <td style="text-align: center;">
                                            <?php if ($row['bc_in'] == NULL) { ?>
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                </font>
                                            <?php } else { ?>
                                                <?= $row['bc_in']; ?>
                                            <?php } ?>
                                        </td>
                                        <!-- OUT -->
                                        <td style="text-align: center;">
                                            <?php if ($row['bc_out'] == NULL) { ?>
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i>
                                                </font>
                                            <?php } else { ?>
                                                <?= $row['bc_out']; ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                endforeach
                                ?>
                            <?php else : ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="invoice-footer">
                        <p class="text-center m-b-5 f-w-600">
                            Laporan Mutasi Barang | <?= $resultHeadSetting['app_name'] ?> <?= $resultHeadSetting['company'] ?>
                        </p>
                        <p class="text-center">
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>
                                <?= $resultHeadSetting['website'] ?>
                            </span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>
                                T:<?= $resultHeadSetting['telp'] ?>
                            </span>
                            <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                                <?= $resultHeadSetting['email'] ?>
                            </span>
                        </p>
                    </div>
                </div>
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