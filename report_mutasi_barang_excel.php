<?php include "include/connection.php";
include "include/restrict.php";

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

header("Content-type: application/vnd-ms-excel");
date_default_timezone_set("Asia/Bangkok");
$datenow = date('d-m-Y h-i-s');


$FindBulan = '';
$FindTahun = '';
$ShowFind  = 'Bulan ' . date('m') . ' Tahun ' . date('Y');

if (isset($_POST["FindFilter"])) {
    $FindBulan = $_POST['FindBulan'];
    $FindTahun = $_POST['FindTahun'];
    $ShowFind  = 'Bulan ' . $_POST['FindBulan'] . ' Tahun ' . $_POST['FindTahun'];
}

if (isset($_POST["FindFilter"])) {
    header("Content-Disposition: attachment; filename=Laporan Mutasi Barang Bulan-$FindBulan-Tahun-$FindTahun-$datenow.xls");
} else {
    header("Content-Disposition: attachment; filename=Laporan Mutasi Barang 100 Data Terakhir_$datenow.xls");
}
?>

<head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/solid.css" integrity="sha384-DhmF1FmzR9+RBLmbsAts3Sp+i6cZMWQwNTRsew7pO/e4gvzqmzcpAzhDIwllPonQ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/fontawesome.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous" />
</head>
<style>
    body {
        margin: 0;
        font-family: "Poppins", sans-serif;
        font-size: .75rem;
        font-weight: 400;
        line-height: 1.5;
        color: #333;
        text-align: left;
        background-color: #d9e0e7;
    }
</style>
<!-- LINE -->
<table style="height: 36px;" width="1548">
    <tbody>
        <tr style="height: 18px;">
            <td style="border-bottom: 1px solid #333;" colspan="24">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="border-style: none; height: 18px; width: 1541px;" colspan="24">&nbsp;</td>
        </tr>
    </tbody>
</table>
<!-- END LINE -->
<table width="1548">
    <tbody>
        <tr>
            <td colspan="4" rowspan="5" width="392">
                <!-- <p>## Sarinah</p> -->
                <p>
                <div style="display:flex;justify-content:center">
                    <font style="color: #fff;font-size: 72px;font-weight: 900;font-family: Brush Script MT, Brush Script Std, cursive;">##</font>
                    <font style="color: #d8121a;font-size: 72px;font-weight: 900;font-family: Brush Script MT, Brush Script Std, cursive;">Sarinah</font>
                </div>
                <br>
                </p>
            </td>
            <td colspan="4" rowspan="2" width="579" style="font-size: 18px;font-weight: 900;">LAPORAN PERTANGGUNGJAWABAN MUTASI BARANG</td>
            <td width="87">&nbsp;</td>
            <td width="85">&nbsp;</td>
            <td width="92">&nbsp;</td>
            <td width="138">&nbsp;</td>
            <td width="85">&nbsp;</td>
            <td width="90">&nbsp;</td>
        </tr>
        <tr>
            <td width="87">&nbsp;</td>
            <td width="85">&nbsp;</td>
            <td width="92">&nbsp;</td>
            <td width="138">&nbsp;</td>
            <td colspan="2" width="175" style="font-size: 12px;font-weight: 900;">
                <p><?= $resultHeadSetting['app_name']; ?></p>
            </td>
        </tr>
        <tr>
            <td colspan="8" width="981" style="font-size: 14px;font-weight: 900;">
                <?php
                if (isset($_POST["FindFilter"])) {
                    echo $ShowFind;
                } else {
                    echo "100 Data Terakhir Mutasi Barang";
                }
                ?>
            </td>
            <td colspan="2" width="175" style="font-size: 12px;font-weight: 900;">Print By: <?= $_SESSION['username']; ?></td>
        </tr>
        <tr>
            <td colspan="8" width="981" style="font-size: 16px;font-weight: 900;"><?= $resultHeadSetting['company_t'] ?></td>
            <td colspan="2" width="175" style="font-size: 12px;font-weight: 900;">Date Time: <?= date_indo_s(date('Y-m-d'), TRUE) ?> <?= date('H:m:i') ?></td>
        </tr>
        <tr>
            <td colspan="8" width="981" style="font-size: 12px;font-weight: 300;"><?= $resultHeadSetting['address'] ?></td>
            <td width="85">&nbsp;</td>
            <td width="90">&nbsp;</td>
        </tr>
    </tbody>
</table>
<!-- LINE -->
<table style="height: 36px;" width="1548">
    <tbody>
        <tr style="height: 18px;">
            <td style="border-bottom: 1px solid #333;" colspan="24">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="border-style: none; height: 18px; width: 1541px;" colspan="24">&nbsp;</td>
        </tr>
    </tbody>
</table>
<!-- END LINE -->
<table class="table table-bordered table-td-valign-middle" border="1">
    <thead style="background: #dadddf;color: #333;">
        <tr style="background: #dadddf;color: #333;">
            <th rowspan="2" width="1%">No.</th>
            <th rowspan="2" style="text-align: center;">KD<font style="color: #dadddf;">.</font>Barang</th>
            <th rowspan="2" style="text-align: center;">Uraian</th>
            <th rowspan="2" style="text-align: center;">Spesifikasi<font style="color: #dadddf;">.</font>Lain</th>
            <th rowspan="2" style="text-align: center;">Satuan</th>
            <th colspan="2" style="text-align: center;">Saldo Awal</th>
            <th colspan="2" style="text-align: center;">Mutasi<font style="color: #dadddf;">.</font>Masuk</th>
            <th colspan="2" style="text-align: center;">Mutasi<font style="color: #dadddf;">.</font>Keluar</th>
            <th colspan="2" style="text-align: center;">Saldo<font style="color: #dadddf;">.</font>Akhir</th>
            <th rowspan="2" style="text-align: center;">
                <i>Stock<font style="color: #dadddf;">.</font>Opname</i>
                <br>
                <font style="font-size: 10px;font-weight:400"><i>Berdasarkan<font style="color: #dadddf;">.</font>Botol</i></font>
            </th>
            <th colspan="2" style="text-align: center;">Selisih</th>
            <th colspan="2" style="text-align: center;">Penyesuaian</th>
            <th colspan="2" style="text-align: center;">Keterangan</th>
            <th colspan="2" style="text-align: center;">Petugas<font style="color: #dadddf;">.</font><?= $resultHeadSetting['company']; ?></th>
            <th colspan="2" style="text-align: center;">Petugas<font style="color: #dadddf;">.</font>BeaCukai</th>
        </tr>
        <tr style="background: #dadddf;color: #333;">
            <th style="text-align: center;">Carton</th>
            <th style="text-align: center;">Botol</th>
            <th style="text-align: center;">Carton</th>
            <th style="text-align: center;">Botol</th>
            <th style="text-align: center;">Carton</th>
            <th style="text-align: center;">Botol</th>
            <th style="text-align: center;">Carton</th>
            <th style="text-align: center;">Botol</th>
            <th style="text-align: center;">Carton</th>
            <th style="text-align: center;">Botol</th>
            <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
            <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
            <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
            <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
            <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
            <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
            <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>In</th>
            <th style="text-align: center;">Gate<font style="color: #dadddf;">.</font>Out</th>
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
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                        <?php } else { ?>
                            '<?= $row['KODE_BARANG']; ?>
                        <?php } ?>
                    </td>
                    <!-- Barang -->
                    <td style="text-align: left;">
                        <?php if ($row['URAIAN'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                        <?php } else { ?>
                            <?= $row['URAIAN']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($row['SPESIFIKASI_LAIN'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                        <?php } else { ?>
                            <?= $row['SPESIFIKASI_LAIN']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if ($row['KODE_SATUAN'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Tidak Diisi!</i></font>
                        <?php } else { ?>
                            <?= $row['KODE_SATUAN']; ?>
                        <?php } ?>
                    </td>
                    <!-- Saldo Awal -->
                    <!-- CT -->
                    <td style="text-align: center;">
                        <?php if ($row['carton_stok'] == NULL) { ?>
                            0
                        <?php } else { ?>
                            <?= $row['carton_stok']; ?>
                        <?php } ?>
                    </td>
                    <!-- Botol -->
                    <td style="text-align: center;">
                        <?php if ($row['botol_stok'] == NULL) { ?>
                            0
                        <?php } else { ?>
                            <?= $row['botol_stok']; ?>
                        <?php } ?>
                    </td>
                    <!-- End Saldo Awal -->
                    <!-- Mutasi Masuk -->
                    <!-- CT -->
                    <td style="text-align: center;">
                        <?php if ($row['MUTASI_MASUK_CT'] == NULL) { ?>
                            0
                        <?php } else { ?>
                            <?= $row['MUTASI_MASUK_CT']; ?>
                        <?php } ?>
                    </td>
                    <!-- Botol -->
                    <td style="text-align: center;">
                        <?php if ($row['MUTASI_MASUK_BTL'] == NULL) { ?>
                            0
                        <?php } else { ?>
                            <?= $row['MUTASI_MASUK_BTL']; ?>
                        <?php } ?>
                    </td>
                    <!-- End Mutasi Masuk -->
                    <!-- Mutasi keluar -->
                    <!-- CT -->
                    <td style="text-align: center;">
                        <?php if ($row['MUTASI_KELUAR_CT'] == NULL) { ?>
                            0
                        <?php } else { ?>
                            <?= $row['MUTASI_KELUAR_CT']; ?>
                        <?php } ?>
                    </td>
                    <!-- Botol -->
                    <td style="text-align: center;">
                        <?php if ($row['MUTASI_KELUAR_BTL'] == NULL) { ?>
                            0
                        <?php } else { ?>
                            <?= $row['MUTASI_KELUAR_BTL']; ?>
                        <?php } ?>
                    </td>
                    <!-- End Mutasi keluar -->
                    <!-- End Penyesuaian -->
                    <!-- Saldo Akhir -->
                    <!-- CT -->
                    <td style="text-align: center;">
                        <?= $row['carton_stok'] + $row['MUTASI_KELUAR_CT']; ?>
                    </td>
                    <!-- Botol -->
                    <td style="text-align: center;">
                        <?= $row['botol_stok'] + $row['MUTASI_KELUAR_BTL']; ?>
                    </td>
                    <!-- End Saldo Akhir -->
                    <!-- Stok Opname -->
                    <!-- Botol -->
                    <td style="text-align: center;">
                        <?= $row['botol_stok'] + $P_IN + $P_OUT ?>
                    </td>
                    <!-- End Stok Opname -->
                    <!-- Selisih -->
                    <!-- CT -->
                    <td style="text-align: center;">
                        <?= $row['MUTASI_MASUK_CT'] - $row['MUTASI_KELUAR_CT']; ?>
                    </td>
                    <!-- Botol -->
                    <td style="text-align: center;">
                        <?= $row['MUTASI_MASUK_BTL'] - $row['MUTASI_KELUAR_BTL']; ?>
                    </td>
                    <!-- End Selisih -->
                    <!-- Penyesuaian -->
                    <!-- IN -->
                    <td style="text-align: center;">
                        <?= $P_IN; ?>
                    </td>
                    <!-- OUT -->
                    <td style="text-align: center;">
                        <?= $P_OUT; ?>
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