<?php
include "include/connection.php";
include "include/restrict.php";
header("Content-type: application/vnd-ms-excel");
date_default_timezone_set("Asia/Bangkok");
$datenow = date('d-m-Y h-i-s');

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

// DECIMAL
function decimal($number)
{
    $hasil = number_format($number, 0, ",", ",");
    return $hasil;
}

// Get
if (isset($_GET['find_'])) {
    $WGetID = $_GET['NameMitra'];
    $WGetTahunAju  = $_GET['TahunAju'];

    $WGetNamaCompany = $dbcon->query("SELECT ID,NAMA FROM referensi_pengusaha WHERE ID='$WGetID'");
    $rowWGetNamaCompany = mysqli_fetch_array($WGetNamaCompany);
    $shoWGetNamaCompany = $rowWGetNamaCompany['NAMA'];

    // FOR AKTIFITAS
    $me = $_GET['me'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Report/Laporan Realisasi';
    $InputDescription     = $me . " Lihat Laporan Realisasi Mitra: " .  $shoWGetNamaCompany . " Tahun " .  $WGetTahunAju . ", Simpan Data Sebagai Report Laporan Realisasi";
    $InputAction          = 'Laporan Per Mitra';
    $InputDate            = date('Y-m-d H:m:i');

    $query = $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");
}
$FirstCon = $dbcon->query("SELECT ID,NAMA,NPWP FROM referensi_pengusaha WHERE ID='$WGetID'");
$rowFirstCon = mysqli_fetch_array($FirstCon);
$WGetNameMitra = $rowFirstCon['NAMA'];
$keyIDPenerima = str_replace(['.', '-', ' '], ['', '', ''], $rowFirstCon['NPWP']);
// End Get

header("Content-Disposition: attachment; filename=Laporan Realisasi Mitra TBB $WGetNameMitra Tahun $WGetTahunAju_$datenow.xls");
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
            <td style="border-bottom: 1px solid #333;" colspan="12">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="border-style: none; height: 18px; width: 1541px;" colspan="12">&nbsp;</td>
        </tr>
    </tbody>
</table>
<!-- END LINE -->
<table width="1548">
    <tbody>
        <tr>
            <td colspan="2" rowspan="5" width="392">
                <!-- <p>## Sarinah</p> -->
                <p>
                <div style="display:flex;justify-content:center">
                    <font style="color: #fff;font-size: 72px;font-weight: 900;font-family: Brush Script MT, Brush Script Std, cursive;">##</font>
                    <font style="color: #d8121a;font-size: 72px;font-weight: 900;font-family: Brush Script MT, Brush Script Std, cursive;">Sarinah</font>
                </div>
                <br>
                </p>
            </td>
            <td colspan="4" rowspan="2" width="579" style="font-size: 18px;font-weight: 900;">LAPORAN REALISASI MITRA TAHUN <?= $WGetTahunAju; ?></td>
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
                <div style="display: flex;justify-content: center;align-items: center;">
                    <div style="display: grid;justify-items: baseline;align-content: center;margin-left: 10px;">
                        <div>
                            <font style="font-size: 25px;text-transform: uppercase;font-weight: 400;">Mitra TBB: <?= $WGetNameMitra ?></font>
                        </div>
                        <div style="margin-top: -10px;margin-bottom:15px">
                            <font style="font-size: 15px;text-transform: uppercase;font-weight: 400;">NPWP: <?= $rowFirstCon['NPWP'] ?></font>
                        </div>
                    </div>
                </div>
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
            <td style="border-bottom: 1px solid #333;" colspan="12">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="border-style: none; height: 18px; width: 1541px;" colspan="12">&nbsp;</td>
        </tr>
    </tbody>
</table>
<!-- END LINE -->
<?php
$dataTable = $dbcon->query("SELECT * FROM tbl_cust_quota AS quo WHERE quo.quota_year='$WGetTahunAju' AND quo.tbb_npwp='$keyIDPenerima'");
$row = mysqli_fetch_array($dataTable);
?>
<table class="table table-bordered table-td-valign-middle" border="1">
    <thead>
        <tr>
            <th rowspan="4" style="text-align: center;">No.</th>
            <th rowspan="3" style="text-align: center;"><?= $WGetNameMitra; ?> <br> <?= $rowFirstCon['NPWP']; ?></th>
            <th colspan="6" style="text-align: center;">JENIS MINUMAN BERALKOHOL</th>
            <th colspan="4" style="text-align: center;" rowspan="2">TOTAL</th>
        </tr>
        <tr>
            <th colspan="2" style="text-align: center;">GOL A</th>
            <th colspan="2" style="text-align: center;">GOL B</th>
            <th colspan="2" style="text-align: center;">GOL C</th>
        </tr>
        <tr>
            <th style="text-align: center;">CARTON</th>
            <th style="text-align: center;">LITER</th>
            <th style="text-align: center;">CARTON</th>
            <th style="text-align: center;">LITER</th>
            <th style="text-align: center;">CARTON</th>
            <th style="text-align: center;">LITER</th>
            <th colspan="2" style="text-align: center;">CARTON</th>
            <th colspan="2" style="text-align: center;">LITER</th>
        </tr>
        <tr>
            <th style="text-align: center;">KUOTA IMPOR</th>
            <!-- gol_a_car -->
            <?php if ($row['gol_a_car'] == NULL) { ?>
                <th style="text-align: center;background: #dadddf;"><?= decimal($row['gol_a_car']) ?></th>
            <?php } else { ?>
                <th style="text-align: center;"><?= decimal($row['gol_a_car']) ?></th>
            <?php } ?>
            <!-- gol_a_ltr -->
            <?php if ($row['gol_a_ltr'] == NULL) { ?>
                <th style="text-align: center;background: #dadddf;"><?= decimal($row['gol_a_ltr']) ?></th>
            <?php } else { ?>
                <th style="text-align: center;"><?= decimal($row['gol_a_ltr']) ?></th>
            <?php } ?>
            <!-- gol_b_car -->
            <?php if ($row['gol_b_car'] == NULL) { ?>
                <th style="text-align: center;background: #dadddf;"><?= decimal($row['gol_b_car']) ?></th>
            <?php } else { ?>
                <th style="text-align: center;"><?= decimal($row['gol_b_car']) ?></th>
            <?php } ?>
            <!-- gol_b_ltr -->
            <?php if ($row['gol_b_ltr'] == NULL) { ?>
                <th style="text-align: center;background: #dadddf;"><?= decimal($row['gol_b_ltr']) ?></th>
            <?php } else { ?>
                <th style="text-align: center;"><?= decimal($row['gol_b_ltr']) ?></th>
            <?php } ?>
            <!-- gol_c_car -->
            <?php if ($row['gol_c_car'] == NULL) { ?>
                <th style="text-align: center;background: #dadddf;"><?= decimal($row['gol_c_car']) ?></th>
            <?php } else { ?>
                <th style="text-align: center;"><?= decimal($row['gol_c_car']) ?></th>
            <?php } ?>
            <!-- gol_c_ltr -->
            <?php if ($row['gol_c_ltr'] == NULL) { ?>
                <th style="text-align: center;background: #dadddf;"><?= decimal($row['gol_c_ltr']) ?></th>
            <?php } else { ?>
                <th style="text-align: center;"><?= decimal($row['gol_c_ltr']) ?></th>
            <?php } ?>
            <!-- Jumlah Carton & Liter -->
            <?php
            $JmlCarton = $row['gol_a_car'] + $row['gol_b_car'] + $row['gol_c_car'];
            $JmlLiter  = $row['gol_a_ltr'] + $row['gol_b_ltr'] + $row['gol_c_ltr'];
            ?>
            <!-- End Jumlah Carton & Liter -->
            <?php if ($JmlCarton == NULL || $JmlCarton == 0) { ?>
                <th colspan="2" style="text-align: center;background: #dadddf;">0</th>
            <?php } else { ?>
                <th colspan="2" style="text-align: center;"><?= decimal($JmlCarton) ?></th>
            <?php } ?>
            <?php if ($JmlLiter == NULL || $JmlLiter == 0) { ?>
                <th colspan="2" style="text-align: center;background: #dadddf;">0</th>
            <?php } else { ?>
                <th colspan="2" style="text-align: center;"><?= decimal($JmlLiter) ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $Key2 = $WGetNameMitra;
        // Januari
        // 01
        // 01 CARTON GOL A
        $DataFor01_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_01_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='01'");
        $ResultDataFor01_crt_a = mysqli_fetch_array($DataFor01_crt_a);
        // 01 LITER GOL A
        $DataFor01_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_01_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='01'");
        $ResultDataFor01_ltr_a = mysqli_fetch_array($DataFor01_ltr_a);
        // 01 CARTON GOL B
        $DataFor01_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_01_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='01'");
        $ResultDataFor01_crt_b = mysqli_fetch_array($DataFor01_crt_b);
        // 01 LITER GOL B
        $DataFor01_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_01_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='01'");
        $ResultDataFor01_ltr_b = mysqli_fetch_array($DataFor01_ltr_b);
        // 01 CARTON GOL C
        $DataFor01_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_01_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='01'");
        $ResultDataFor01_crt_c = mysqli_fetch_array($DataFor01_crt_c);
        // 01 LITER GOL C
        $DataFor01_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_01_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='01'");
        $ResultDataFor01_ltr_c = mysqli_fetch_array($DataFor01_ltr_c);
        // End 01
        // End Januari

        // Februari
        // 02
        // 02 CARTON GOL A
        $DataFor02_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_02_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='02'");
        $ResultDataFor02_crt_a = mysqli_fetch_array($DataFor02_crt_a);
        // 02 LITER GOL A
        $DataFor02_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_02_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='02'");
        $ResultDataFor02_ltr_a = mysqli_fetch_array($DataFor02_ltr_a);
        // 02 CARTON GOL B
        $DataFor02_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_02_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='02'");
        $ResultDataFor02_crt_b = mysqli_fetch_array($DataFor02_crt_b);
        // 02 LITER GOL B
        $DataFor02_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_02_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='02'");
        $ResultDataFor02_ltr_b = mysqli_fetch_array($DataFor02_ltr_b);
        // 02 CARTON GOL C
        $DataFor02_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_02_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='02'");
        $ResultDataFor02_crt_c = mysqli_fetch_array($DataFor02_crt_c);
        // 02 LITER GOL C
        $DataFor02_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_02_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='02'");
        $ResultDataFor02_ltr_c = mysqli_fetch_array($DataFor02_ltr_c);
        // End 02
        // End Februari

        // Maret
        // 03
        // 03 CARTON GOL A
        $DataFor03_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_03_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='03'");
        $ResultDataFor03_crt_a = mysqli_fetch_array($DataFor03_crt_a);
        // 03 LITER GOL A
        $DataFor03_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_03_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='03'");
        $ResultDataFor03_ltr_a = mysqli_fetch_array($DataFor03_ltr_a);
        // 03 CARTON GOL B
        $DataFor03_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_03_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='03'");
        $ResultDataFor03_crt_b = mysqli_fetch_array($DataFor03_crt_b);
        // 03 LITER GOL B
        $DataFor03_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_03_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='03'");
        $ResultDataFor03_ltr_b = mysqli_fetch_array($DataFor03_ltr_b);
        // 03 CARTON GOL C
        $DataFor03_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_03_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='03'");
        $ResultDataFor03_crt_c = mysqli_fetch_array($DataFor03_crt_c);
        // 03 LITER GOL C
        $DataFor03_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_03_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='03'");
        $ResultDataFor03_ltr_c = mysqli_fetch_array($DataFor03_ltr_c);
        // End 03
        // End Maret

        // April
        // 04
        // 04 CARTON GOL A
        $DataFor04_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_04_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='04'");
        $ResultDataFor04_crt_a = mysqli_fetch_array($DataFor04_crt_a);
        // 04 LITER GOL A
        $DataFor04_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_04_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='04'");
        $ResultDataFor04_ltr_a = mysqli_fetch_array($DataFor04_ltr_a);
        // 04 CARTON GOL B
        $DataFor04_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_04_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='04'");
        $ResultDataFor04_crt_b = mysqli_fetch_array($DataFor04_crt_b);
        // 04 LITER GOL B
        $DataFor04_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_04_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='04'");
        $ResultDataFor04_ltr_b = mysqli_fetch_array($DataFor04_ltr_b);
        // 04 CARTON GOL C
        $DataFor04_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_04_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='04'");
        $ResultDataFor04_crt_c = mysqli_fetch_array($DataFor04_crt_c);
        // 04 LITER GOL C
        $DataFor04_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_04_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='04'");
        $ResultDataFor04_ltr_c = mysqli_fetch_array($DataFor04_ltr_c);
        // End 04
        // End April

        // Mei
        // 05
        // 05 CARTON GOL A
        $DataFor05_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_05_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='05'");
        $ResultDataFor05_crt_a = mysqli_fetch_array($DataFor05_crt_a);
        // 05 LITER GOL A
        $DataFor05_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_05_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='05'");
        $ResultDataFor05_ltr_a = mysqli_fetch_array($DataFor05_ltr_a);
        // 05 CARTON GOL B
        $DataFor05_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_05_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='05'");
        $ResultDataFor05_crt_b = mysqli_fetch_array($DataFor05_crt_b);
        // 05 LITER GOL B
        $DataFor05_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_05_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='05'");
        $ResultDataFor05_ltr_b = mysqli_fetch_array($DataFor05_ltr_b);
        // 05 CARTON GOL C
        $DataFor05_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_05_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='05'");
        $ResultDataFor05_crt_c = mysqli_fetch_array($DataFor05_crt_c);
        // 05 LITER GOL C
        $DataFor05_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_05_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='05'");
        $ResultDataFor05_ltr_c = mysqli_fetch_array($DataFor05_ltr_c);
        // End 05
        // End Mei

        // Juni
        // 06
        // 06 CARTON GOL A
        $DataFor06_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_06_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='06'");
        $ResultDataFor06_crt_a = mysqli_fetch_array($DataFor06_crt_a);
        // 06 LITER GOL A
        $DataFor06_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_06_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='06'");
        $ResultDataFor06_ltr_a = mysqli_fetch_array($DataFor06_ltr_a);
        // 06 CARTON GOL B
        $DataFor06_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_06_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='06'");
        $ResultDataFor06_crt_b = mysqli_fetch_array($DataFor06_crt_b);
        // 06 LITER GOL B
        $DataFor06_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_06_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='06'");
        $ResultDataFor06_ltr_b = mysqli_fetch_array($DataFor06_ltr_b);
        // 06 CARTON GOL C
        $DataFor06_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_06_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='06'");
        $ResultDataFor06_crt_c = mysqli_fetch_array($DataFor06_crt_c);
        // 06 LITER GOL C
        $DataFor06_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_06_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='06'");
        $ResultDataFor06_ltr_c = mysqli_fetch_array($DataFor06_ltr_c);
        // End 06
        // End Juni

        // Juli
        // 07
        // 07 CARTON GOL A
        $DataFor07_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_07_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='07'");
        $ResultDataFor07_crt_a = mysqli_fetch_array($DataFor07_crt_a);
        // 07 LITER GOL A
        $DataFor07_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_07_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='07'");
        $ResultDataFor07_ltr_a = mysqli_fetch_array($DataFor07_ltr_a);
        // 07 CARTON GOL B
        $DataFor07_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_07_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='07'");
        $ResultDataFor07_crt_b = mysqli_fetch_array($DataFor07_crt_b);
        // 07 LITER GOL B
        $DataFor07_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_07_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='07'");
        $ResultDataFor07_ltr_b = mysqli_fetch_array($DataFor07_ltr_b);
        // 07 CARTON GOL C
        $DataFor07_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_07_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='07'");
        $ResultDataFor07_crt_c = mysqli_fetch_array($DataFor07_crt_c);
        // 07 LITER GOL C
        $DataFor07_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_07_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='07'");
        $ResultDataFor07_ltr_c = mysqli_fetch_array($DataFor07_ltr_c);
        // End 07
        // End Juli

        // Agustus
        // 08
        // 08 CARTON GOL A
        $DataFor08_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_08_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='08'");
        $ResultDataFor08_crt_a = mysqli_fetch_array($DataFor08_crt_a);
        // 08 LITER GOL A
        $DataFor08_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_08_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='08'");
        $ResultDataFor08_ltr_a = mysqli_fetch_array($DataFor08_ltr_a);
        // 08 CARTON GOL B
        $DataFor08_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_08_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='08'");
        $ResultDataFor08_crt_b = mysqli_fetch_array($DataFor08_crt_b);
        // 08 LITER GOL B
        $DataFor08_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_08_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='08'");
        $ResultDataFor08_ltr_b = mysqli_fetch_array($DataFor08_ltr_b);
        // 08 CARTON GOL C
        $DataFor08_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_08_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='08'");
        $ResultDataFor08_crt_c = mysqli_fetch_array($DataFor08_crt_c);
        // 08 LITER GOL C
        $DataFor08_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_08_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='08'");
        $ResultDataFor08_ltr_c = mysqli_fetch_array($DataFor08_ltr_c);
        // End 08
        // End Agustus

        // September
        // 09
        // 09 CARTON GOL A
        $DataFor09_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_09_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='09'");
        $ResultDataFor09_crt_a = mysqli_fetch_array($DataFor09_crt_a);
        // 09 LITER GOL A
        $DataFor09_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_09_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='09'");
        $ResultDataFor09_ltr_a = mysqli_fetch_array($DataFor09_ltr_a);
        // 09 CARTON GOL B
        $DataFor09_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_09_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='09'");
        $ResultDataFor09_crt_b = mysqli_fetch_array($DataFor09_crt_b);
        // 09 LITER GOL B
        $DataFor09_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_09_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='09'");
        $ResultDataFor09_ltr_b = mysqli_fetch_array($DataFor09_ltr_b);
        // 09 CARTON GOL C
        $DataFor09_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_09_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='09'");
        $ResultDataFor09_crt_c = mysqli_fetch_array($DataFor09_crt_c);
        // 09 LITER GOL C
        $DataFor09_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_09_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='09'");
        $ResultDataFor09_ltr_c = mysqli_fetch_array($DataFor09_ltr_c);
        // End 09
        // End September

        // Oktober
        // 10
        // 10 CARTON GOL A
        $DataFor10_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_10_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='10'");
        $ResultDataFor10_crt_a = mysqli_fetch_array($DataFor10_crt_a);
        // 10 LITER GOL A
        $DataFor10_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_10_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='10'");
        $ResultDataFor10_ltr_a = mysqli_fetch_array($DataFor10_ltr_a);
        // 10 CARTON GOL B
        $DataFor10_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_10_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='10'");
        $ResultDataFor10_crt_b = mysqli_fetch_array($DataFor10_crt_b);
        // 10 LITER GOL B
        $DataFor10_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_10_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='10'");
        $ResultDataFor10_ltr_b = mysqli_fetch_array($DataFor10_ltr_b);
        // 10 CARTON GOL C
        $DataFor10_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_10_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='10'");
        $ResultDataFor10_crt_c = mysqli_fetch_array($DataFor10_crt_c);
        // 10 LITER GOL C
        $DataFor10_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_10_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='10'");
        $ResultDataFor10_ltr_c = mysqli_fetch_array($DataFor10_ltr_c);
        // End 10
        // End Oktober

        // November
        // 11
        // 11 CARTON GOL A
        $DataFor11_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_11_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='11'");
        $ResultDataFor11_crt_a = mysqli_fetch_array($DataFor11_crt_a);
        // 11 LITER GOL A
        $DataFor11_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_11_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='11'");
        $ResultDataFor11_ltr_a = mysqli_fetch_array($DataFor11_ltr_a);
        // 11 CARTON GOL B
        $DataFor11_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_11_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='11'");
        $ResultDataFor11_crt_b = mysqli_fetch_array($DataFor11_crt_b);
        // 11 LITER GOL B
        $DataFor11_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_11_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='11'");
        $ResultDataFor11_ltr_b = mysqli_fetch_array($DataFor11_ltr_b);
        // 11 CARTON GOL C
        $DataFor11_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_11_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='11'");
        $ResultDataFor11_crt_c = mysqli_fetch_array($DataFor11_crt_c);
        // 11 LITER GOL C
        $DataFor11_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_11_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='11'");
        $ResultDataFor11_ltr_c = mysqli_fetch_array($DataFor11_ltr_c);
        // End 11
        // End November

        // Desember
        // 12
        // 12 CARTON GOL A
        $DataFor12_crt_a = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_12_crt_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='12'");
        $ResultDataFor12_crt_a = mysqli_fetch_array($DataFor12_crt_a);
        // 12 LITER GOL A
        $DataFor12_ltr_a = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_12_ltr_a,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL A'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='12'");
        $ResultDataFor12_ltr_a = mysqli_fetch_array($DataFor12_ltr_a);
        // 12 CARTON GOL B
        $DataFor12_crt_b = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_12_crt_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='12'");
        $ResultDataFor12_crt_b = mysqli_fetch_array($DataFor12_crt_b);
        // 12 LITER GOL B
        $DataFor12_ltr_b = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_12_ltr_b,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL B'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='12'");
        $ResultDataFor12_ltr_b = mysqli_fetch_array($DataFor12_ltr_b);
        // 12 CARTON GOL C
        $DataFor12_crt_c = $dbcon->query("SELECT SUM(brg.TOTAL_CT_AKHIR_GB) jml_12_crt_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='12'");
        $ResultDataFor12_crt_c = mysqli_fetch_array($DataFor12_crt_c);
        // 12 LITER GOL C
        $DataFor12_ltr_c = $dbcon->query("SELECT SUM(brg.TOTAL_LITER_AKHIR_GB) jml_12_ltr_c,rcd.bm_no_aju_plb,rcd.bk_no_aju_sarinah,tpb.ID_PENERIMA_BARANG,tpb.NAMA_PENERIMA_BARANG
								FROM rcd_status AS rcd
								LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
								LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
								WHERE tpb.ID_PENERIMA_BARANG='$keyIDPenerima' 
								AND brg.TIPE='GOL C'
								AND EXTRACT(YEAR FROM brg.DATE_CT_GB)='$WGetTahunAju' AND EXTRACT(MONTH FROM brg.DATE_CT_GB)='12'");
        $ResultDataFor12_ltr_c = mysqli_fetch_array($DataFor12_ltr_c);
        // End 12
        // End Desember
        ?>
        <tr>
            <td>1. </td>
            <td>Januari</td>
            <?php
            // GOL A
            if ($ResultDataFor01_crt_a['jml_01_crt_a'] == NULL || $ResultDataFor01_crt_a['jml_01_crt_a'] == 0) {
                $bln_01_a_crt = 'transparent';
            } else {
                $bln_01_a_crt = '';
            }
            if ($ResultDataFor01_ltr_a['jml_01_ltr_a'] == NULL || $ResultDataFor01_ltr_a['jml_01_ltr_a'] == 0) {
                $bln_01_a_ltr = 'transparent';
            } else {
                $bln_01_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor01_crt_b['jml_01_crt_b'] == NULL || $ResultDataFor01_crt_b['jml_01_crt_b'] == 0) {
                $bln_01_b_crt = 'transparent';
            } else {
                $bln_01_b_crt = '';
            }
            if ($ResultDataFor01_ltr_b['jml_01_ltr_b'] == NULL || $ResultDataFor01_ltr_b['jml_01_ltr_b'] == 0) {
                $bln_01_b_ltr = 'transparent';
            } else {
                $bln_01_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor01_crt_c['jml_01_crt_c'] == NULL || $ResultDataFor01_crt_c['jml_01_crt_c'] == 0) {
                $bln_01_c_crt = 'transparent';
            } else {
                $bln_01_c_crt = '';
            }
            if ($ResultDataFor01_ltr_c['jml_01_ltr_c'] == NULL || $ResultDataFor01_ltr_c['jml_01_ltr_c'] == 0) {
                $bln_01_c_ltr = 'transparent';
            } else {
                $bln_01_c_ltr = '';
            }
            // GOL c

            $Bln_jml_01_crt = $ResultDataFor01_crt_a['jml_01_crt_a'] + $ResultDataFor01_crt_b['jml_01_crt_b'] + $ResultDataFor01_crt_c['jml_01_crt_c'];
            if ($Bln_jml_01_crt == NULL || $Bln_jml_01_crt == 0) {
                $bln_01_crt = 'transparent';
            } else {
                $bln_01_crt = '';
            }
            $Bln_jml_01_lrt = $ResultDataFor01_ltr_a['jml_01_ltr_a'] + $ResultDataFor01_ltr_b['jml_01_ltr_b'] + $ResultDataFor01_ltr_c['jml_01_ltr_c'];
            if ($Bln_jml_01_lrt == NULL || $Bln_jml_01_lrt == 0) {
                $bln_01_ltr = 'transparent';
            } else {
                $bln_01_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_01_a_crt; ?>"><?= decimal($ResultDataFor01_crt_a['jml_01_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_01_a_ltr; ?>"><?= decimal($ResultDataFor01_ltr_a['jml_01_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_01_b_crt; ?>"><?= decimal($ResultDataFor01_crt_b['jml_01_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_01_b_ltr; ?>"><?= decimal($ResultDataFor01_ltr_b['jml_01_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_01_c_crt; ?>"><?= decimal($ResultDataFor01_crt_c['jml_01_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_01_c_ltr; ?>"><?= decimal($ResultDataFor01_ltr_c['jml_01_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_01_crt; ?>"><?= $Bln_jml_01_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_01_ltr; ?>"><?= $Bln_jml_01_lrt ?></td>
        </tr>
        <tr>
            <td>2. </td>
            <td>Februari</td>
            <?php
            // GOL A
            if ($ResultDataFor02_crt_a['jml_02_crt_a'] == NULL || $ResultDataFor02_crt_a['jml_02_crt_a'] == 0) {
                $bln_02_a_crt = 'transparent';
            } else {
                $bln_02_a_crt = '';
            }
            if ($ResultDataFor02_ltr_a['jml_02_ltr_a'] == NULL || $ResultDataFor02_ltr_a['jml_02_ltr_a'] == 0) {
                $bln_02_a_ltr = 'transparent';
            } else {
                $bln_02_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor02_crt_b['jml_02_crt_b'] == NULL || $ResultDataFor02_crt_b['jml_02_crt_b'] == 0) {
                $bln_02_b_crt = 'transparent';
            } else {
                $bln_02_b_crt = '';
            }
            if ($ResultDataFor02_ltr_b['jml_02_ltr_b'] == NULL || $ResultDataFor02_ltr_b['jml_02_ltr_b'] == 0) {
                $bln_02_b_ltr = 'transparent';
            } else {
                $bln_02_b_ltr = '';
            }
            // GOL B

            // GOL C
            if ($ResultDataFor02_crt_c['jml_02_crt_c'] == NULL || $ResultDataFor02_crt_c['jml_02_crt_c'] == 0) {
                $bln_02_c_crt = 'transparent';
            } else {
                $bln_02_c_crt = '';
            }
            if ($ResultDataFor02_ltr_c['jml_02_ltr_c'] == NULL || $ResultDataFor02_ltr_c['jml_02_ltr_c'] == 0) {
                $bln_02_c_ltr = 'transparent';
            } else {
                $bln_02_c_ltr = '';
            }
            // GOL C
            $Bln_jml_02_crt = $ResultDataFor02_crt_a['jml_02_crt_a'] + $ResultDataFor02_crt_b['jml_02_crt_b'] + $ResultDataFor02_crt_c['jml_02_crt_c'];
            if ($Bln_jml_02_crt == NULL || $Bln_jml_02_crt == 0) {
                $bln_02_crt = 'transparent';
            } else {
                $bln_02_crt = '';
            }
            $Bln_jml_02_lrt = $ResultDataFor02_ltr_a['jml_02_ltr_a'] + $ResultDataFor02_ltr_b['jml_02_ltr_b'] + $ResultDataFor02_ltr_c['jml_02_ltr_c'];
            if ($Bln_jml_02_lrt == NULL || $Bln_jml_02_lrt == 0) {
                $bln_02_ltr = 'transparent';
            } else {
                $bln_02_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_02_a_crt; ?>"><?= decimal($ResultDataFor02_crt_a['jml_02_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_02_a_ltr; ?>"><?= decimal($ResultDataFor02_ltr_a['jml_02_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_02_b_crt; ?>"><?= decimal($ResultDataFor02_crt_b['jml_02_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_02_b_ltr; ?>"><?= decimal($ResultDataFor02_ltr_b['jml_02_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_02_c_crt; ?>"><?= decimal($ResultDataFor02_crt_c['jml_02_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_02_c_ltr; ?>"><?= decimal($ResultDataFor02_ltr_c['jml_02_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_02_crt; ?>"><?= $Bln_jml_02_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_02_ltr; ?>"><?= $Bln_jml_02_lrt ?></td>
        </tr>
        <tr>
            <td>3. </td>
            <td>Maret</td>
            <?php
            // GOL A
            if ($ResultDataFor03_crt_a['jml_03_crt_a'] == NULL || $ResultDataFor03_crt_a['jml_03_crt_a'] == 0) {
                $bln_03_a_crt = 'transparent';
            } else {
                $bln_03_a_crt = '';
            }
            if ($ResultDataFor03_ltr_a['jml_03_ltr_a'] == NULL || $ResultDataFor03_ltr_a['jml_03_ltr_a'] == 0) {
                $bln_03_a_ltr = 'transparent';
            } else {
                $bln_03_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor03_crt_b['jml_03_crt_b'] == NULL || $ResultDataFor03_crt_b['jml_03_crt_b'] == 0) {
                $bln_03_b_crt = 'transparent';
            } else {
                $bln_03_b_crt = '';
            }
            if ($ResultDataFor03_ltr_b['jml_03_ltr_b'] == NULL || $ResultDataFor03_ltr_b['jml_03_ltr_b'] == 0) {
                $bln_03_b_ltr = 'transparent';
            } else {
                $bln_03_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor03_crt_c['jml_03_crt_c'] == NULL || $ResultDataFor03_crt_c['jml_03_crt_c'] == 0) {
                $bln_03_c_crt = 'transparent';
            } else {
                $bln_03_c_crt = '';
            }
            if ($ResultDataFor03_ltr_c['jml_03_ltr_c'] == NULL || $ResultDataFor03_ltr_c['jml_03_ltr_c'] == 0) {
                $bln_03_c_ltr = 'transparent';
            } else {
                $bln_03_c_ltr = '';
            }
            // GOL c

            $Bln_jml_03_crt = $ResultDataFor03_crt_a['jml_03_crt_a'] + $ResultDataFor03_crt_b['jml_03_crt_b'] + $ResultDataFor03_crt_c['jml_03_crt_c'];
            if ($Bln_jml_03_crt == NULL || $Bln_jml_03_crt == 0) {
                $bln_03_crt = 'transparent';
            } else {
                $bln_03_crt = '';
            }
            $Bln_jml_03_lrt = $ResultDataFor03_ltr_a['jml_03_ltr_a'] + $ResultDataFor03_ltr_b['jml_03_ltr_b'] + $ResultDataFor03_ltr_c['jml_03_ltr_c'];
            if ($Bln_jml_03_lrt == NULL || $Bln_jml_03_lrt == 0) {
                $bln_03_ltr = 'transparent';
            } else {
                $bln_03_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_03_a_crt; ?>"><?= decimal($ResultDataFor03_crt_a['jml_03_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_03_a_ltr; ?>"><?= decimal($ResultDataFor03_ltr_a['jml_03_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_03_b_crt; ?>"><?= decimal($ResultDataFor03_crt_b['jml_03_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_03_b_ltr; ?>"><?= decimal($ResultDataFor03_ltr_b['jml_03_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_03_c_crt; ?>"><?= decimal($ResultDataFor03_crt_c['jml_03_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_03_c_ltr; ?>"><?= decimal($ResultDataFor03_ltr_c['jml_03_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_03_crt; ?>"><?= $Bln_jml_03_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_03_ltr; ?>"><?= $Bln_jml_03_lrt ?></td>
        </tr>
        <tr>
            <td>4. </td>
            <td>April</td>
            <?php
            // GOL A
            if ($ResultDataFor04_crt_a['jml_04_crt_a'] == NULL || $ResultDataFor04_crt_a['jml_04_crt_a'] == 0) {
                $bln_04_a_crt = 'transparent';
            } else {
                $bln_04_a_crt = '';
            }
            if ($ResultDataFor04_ltr_a['jml_04_ltr_a'] == NULL || $ResultDataFor04_ltr_a['jml_04_ltr_a'] == 0) {
                $bln_04_a_ltr = 'transparent';
            } else {
                $bln_04_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor04_crt_b['jml_04_crt_b'] == NULL || $ResultDataFor04_crt_b['jml_04_crt_b'] == 0) {
                $bln_04_b_crt = 'transparent';
            } else {
                $bln_04_b_crt = '';
            }
            if ($ResultDataFor04_ltr_b['jml_04_ltr_b'] == NULL || $ResultDataFor04_ltr_b['jml_04_ltr_b'] == 0) {
                $bln_04_b_ltr = 'transparent';
            } else {
                $bln_04_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor04_crt_c['jml_04_crt_c'] == NULL || $ResultDataFor04_crt_c['jml_04_crt_c'] == 0) {
                $bln_04_c_crt = 'transparent';
            } else {
                $bln_04_c_crt = '';
            }
            if ($ResultDataFor04_ltr_c['jml_04_ltr_c'] == NULL || $ResultDataFor04_ltr_c['jml_04_ltr_c'] == 0) {
                $bln_04_c_ltr = 'transparent';
            } else {
                $bln_04_c_ltr = '';
            }
            // GOL c

            $Bln_jml_04_crt = $ResultDataFor04_crt_a['jml_04_crt_a'] + $ResultDataFor04_crt_b['jml_04_crt_b'] + $ResultDataFor04_crt_c['jml_04_crt_c'];
            if ($Bln_jml_04_crt == NULL || $Bln_jml_04_crt == 0) {
                $bln_04_crt = 'transparent';
            } else {
                $bln_04_crt = '';
            }
            $Bln_jml_04_lrt = $ResultDataFor04_ltr_a['jml_04_ltr_a'] + $ResultDataFor04_ltr_b['jml_04_ltr_b'] + $ResultDataFor04_ltr_c['jml_04_ltr_c'];
            if ($Bln_jml_04_lrt == NULL || $Bln_jml_04_lrt == 0) {
                $bln_04_ltr = 'transparent';
            } else {
                $bln_04_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_04_a_crt; ?>"><?= decimal($ResultDataFor04_crt_a['jml_04_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_04_a_ltr; ?>"><?= decimal($ResultDataFor04_ltr_a['jml_04_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_04_b_crt; ?>"><?= decimal($ResultDataFor04_crt_b['jml_04_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_04_b_ltr; ?>"><?= decimal($ResultDataFor04_ltr_b['jml_04_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_04_c_crt; ?>"><?= decimal($ResultDataFor04_crt_c['jml_04_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_04_c_ltr; ?>"><?= decimal($ResultDataFor04_ltr_c['jml_04_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_04_crt; ?>"><?= $Bln_jml_04_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_04_ltr; ?>"><?= $Bln_jml_04_lrt ?></td>
        </tr>
        <tr>
            <td>5. </td>
            <td>Mei</td>
            <?php
            // GOL A
            if ($ResultDataFor05_crt_a['jml_05_crt_a'] == NULL || $ResultDataFor05_crt_a['jml_05_crt_a'] == 0) {
                $bln_05_a_crt = 'transparent';
            } else {
                $bln_05_a_crt = '';
            }
            if ($ResultDataFor05_ltr_a['jml_05_ltr_a'] == NULL || $ResultDataFor05_ltr_a['jml_05_ltr_a'] == 0) {
                $bln_05_a_ltr = 'transparent';
            } else {
                $bln_05_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor05_crt_b['jml_05_crt_b'] == NULL || $ResultDataFor05_crt_b['jml_05_crt_b'] == 0) {
                $bln_05_b_crt = 'transparent';
            } else {
                $bln_05_b_crt = '';
            }
            if ($ResultDataFor05_ltr_b['jml_05_ltr_b'] == NULL || $ResultDataFor05_ltr_b['jml_05_ltr_b'] == 0) {
                $bln_05_b_ltr = 'transparent';
            } else {
                $bln_05_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor05_crt_c['jml_05_crt_c'] == NULL || $ResultDataFor05_crt_c['jml_05_crt_c'] == 0) {
                $bln_05_c_crt = 'transparent';
            } else {
                $bln_05_c_crt = '';
            }
            if ($ResultDataFor05_ltr_c['jml_05_ltr_c'] == NULL || $ResultDataFor05_ltr_c['jml_05_ltr_c'] == 0) {
                $bln_05_c_ltr = 'transparent';
            } else {
                $bln_05_c_ltr = '';
            }
            // GOL c

            $Bln_jml_05_crt = $ResultDataFor05_crt_a['jml_05_crt_a'] + $ResultDataFor05_crt_b['jml_05_crt_b'] + $ResultDataFor05_crt_c['jml_05_crt_c'];
            if ($Bln_jml_05_crt == NULL || $Bln_jml_05_crt == 0) {
                $bln_05_crt = 'transparent';
            } else {
                $bln_05_crt = '';
            }
            $Bln_jml_05_lrt = $ResultDataFor05_ltr_a['jml_05_ltr_a'] + $ResultDataFor05_ltr_b['jml_05_ltr_b'] + $ResultDataFor05_ltr_c['jml_05_ltr_c'];
            if ($Bln_jml_05_lrt == NULL || $Bln_jml_05_lrt == 0) {
                $bln_05_ltr = 'transparent';
            } else {
                $bln_05_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_05_a_crt; ?>"><?= decimal($ResultDataFor05_crt_a['jml_05_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_05_a_ltr; ?>"><?= decimal($ResultDataFor05_ltr_a['jml_05_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_05_b_crt; ?>"><?= decimal($ResultDataFor05_crt_b['jml_05_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_05_b_ltr; ?>"><?= decimal($ResultDataFor05_ltr_b['jml_05_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_05_c_crt; ?>"><?= decimal($ResultDataFor05_crt_c['jml_05_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_05_c_ltr; ?>"><?= decimal($ResultDataFor05_ltr_c['jml_05_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_05_crt; ?>"><?= $Bln_jml_05_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_05_ltr; ?>"><?= $Bln_jml_05_lrt ?></td>
        </tr>
        <tr>
            <td>6. </td>
            <td>Juni</td>
            <?php
            // GOL A
            if ($ResultDataFor06_crt_a['jml_06_crt_a'] == NULL || $ResultDataFor06_crt_a['jml_06_crt_a'] == 0) {
                $bln_06_a_crt = 'transparent';
            } else {
                $bln_06_a_crt = '';
            }
            if ($ResultDataFor06_ltr_a['jml_06_ltr_a'] == NULL || $ResultDataFor06_ltr_a['jml_06_ltr_a'] == 0) {
                $bln_06_a_ltr = 'transparent';
            } else {
                $bln_06_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor06_crt_b['jml_06_crt_b'] == NULL || $ResultDataFor06_crt_b['jml_06_crt_b'] == 0) {
                $bln_06_b_crt = 'transparent';
            } else {
                $bln_06_b_crt = '';
            }
            if ($ResultDataFor06_ltr_b['jml_06_ltr_b'] == NULL || $ResultDataFor06_ltr_b['jml_06_ltr_b'] == 0) {
                $bln_06_b_ltr = 'transparent';
            } else {
                $bln_06_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor06_crt_c['jml_06_crt_c'] == NULL || $ResultDataFor06_crt_c['jml_06_crt_c'] == 0) {
                $bln_06_c_crt = 'transparent';
            } else {
                $bln_06_c_crt = '';
            }
            if ($ResultDataFor06_ltr_c['jml_06_ltr_c'] == NULL || $ResultDataFor06_ltr_c['jml_06_ltr_c'] == 0) {
                $bln_06_c_ltr = 'transparent';
            } else {
                $bln_06_c_ltr = '';
            }
            // GOL c

            $Bln_jml_06_crt = $ResultDataFor06_crt_a['jml_06_crt_a'] + $ResultDataFor06_crt_b['jml_06_crt_b'] + $ResultDataFor06_crt_c['jml_06_crt_c'];
            if ($Bln_jml_06_crt == NULL || $Bln_jml_06_crt == 0) {
                $bln_06_crt = 'transparent';
            } else {
                $bln_06_crt = '';
            }
            $Bln_jml_06_lrt = $ResultDataFor06_ltr_a['jml_06_ltr_a'] + $ResultDataFor06_ltr_b['jml_06_ltr_b'] + $ResultDataFor06_ltr_c['jml_06_ltr_c'];
            if ($Bln_jml_06_lrt == NULL || $Bln_jml_06_lrt == 0) {
                $bln_06_ltr = 'transparent';
            } else {
                $bln_06_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_06_a_crt; ?>"><?= decimal($ResultDataFor06_crt_a['jml_06_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_06_a_ltr; ?>"><?= decimal($ResultDataFor06_ltr_a['jml_06_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_06_b_crt; ?>"><?= decimal($ResultDataFor06_crt_b['jml_06_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_06_b_ltr; ?>"><?= decimal($ResultDataFor06_ltr_b['jml_06_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_06_c_crt; ?>"><?= decimal($ResultDataFor06_crt_c['jml_06_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_06_c_ltr; ?>"><?= decimal($ResultDataFor06_ltr_c['jml_06_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_06_crt; ?>"><?= $Bln_jml_06_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_06_ltr; ?>"><?= $Bln_jml_06_lrt ?></td>
        </tr>
        <tr>
            <td>7. </td>
            <td>Juli</td>
            <?php
            // GOL A
            if ($ResultDataFor07_crt_a['jml_07_crt_a'] == NULL || $ResultDataFor07_crt_a['jml_07_crt_a'] == 0) {
                $bln_07_a_crt = 'transparent';
            } else {
                $bln_07_a_crt = '';
            }
            if ($ResultDataFor07_ltr_a['jml_07_ltr_a'] == NULL || $ResultDataFor07_ltr_a['jml_07_ltr_a'] == 0) {
                $bln_07_a_ltr = 'transparent';
            } else {
                $bln_07_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor07_crt_b['jml_07_crt_b'] == NULL || $ResultDataFor07_crt_b['jml_07_crt_b'] == 0) {
                $bln_07_b_crt = 'transparent';
            } else {
                $bln_07_b_crt = '';
            }
            if ($ResultDataFor07_ltr_b['jml_07_ltr_b'] == NULL || $ResultDataFor07_ltr_b['jml_07_ltr_b'] == 0) {
                $bln_07_b_ltr = 'transparent';
            } else {
                $bln_07_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor07_crt_c['jml_07_crt_c'] == NULL || $ResultDataFor07_crt_c['jml_07_crt_c'] == 0) {
                $bln_07_c_crt = 'transparent';
            } else {
                $bln_07_c_crt = '';
            }
            if ($ResultDataFor07_ltr_c['jml_07_ltr_c'] == NULL || $ResultDataFor07_ltr_c['jml_07_ltr_c'] == 0) {
                $bln_07_c_ltr = 'transparent';
            } else {
                $bln_07_c_ltr = '';
            }
            // GOL c

            $Bln_jml_07_crt = $ResultDataFor07_crt_a['jml_07_crt_a'] + $ResultDataFor07_crt_b['jml_07_crt_b'] + $ResultDataFor07_crt_c['jml_07_crt_c'];
            if ($Bln_jml_07_crt == NULL || $Bln_jml_07_crt == 0) {
                $bln_07_crt = 'transparent';
            } else {
                $bln_07_crt = '';
            }
            $Bln_jml_07_lrt = $ResultDataFor07_ltr_a['jml_07_ltr_a'] + $ResultDataFor07_ltr_b['jml_07_ltr_b'] + $ResultDataFor07_ltr_c['jml_07_ltr_c'];
            if ($Bln_jml_07_lrt == NULL || $Bln_jml_07_lrt == 0) {
                $bln_07_ltr = 'transparent';
            } else {
                $bln_07_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_07_a_crt; ?>"><?= decimal($ResultDataFor07_crt_a['jml_07_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_07_a_crt; ?>"><?= decimal($ResultDataFor07_ltr_a['jml_07_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_07_b_crt; ?>"><?= decimal($ResultDataFor07_crt_b['jml_07_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_07_b_crt; ?>"><?= decimal($ResultDataFor07_ltr_b['jml_07_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_07_c_crt; ?>"><?= decimal($ResultDataFor07_crt_c['jml_07_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_07_c_crt; ?>"><?= decimal($ResultDataFor07_ltr_c['jml_07_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_07_crt; ?>"><?= $Bln_jml_07_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_07_ltr; ?>"><?= $Bln_jml_07_lrt ?></td>
        </tr>
        <tr>
            <td>8. </td>
            <td>Agustus</td>
            <?php
            // GOL A
            if ($ResultDataFor08_crt_a['jml_08_crt_a'] == NULL || $ResultDataFor08_crt_a['jml_08_crt_a'] == 0) {
                $bln_08_a_crt = 'transparent';
            } else {
                $bln_08_a_crt = '';
            }
            if ($ResultDataFor08_ltr_a['jml_08_ltr_a'] == NULL || $ResultDataFor08_ltr_a['jml_08_ltr_a'] == 0) {
                $bln_08_a_ltr = 'transparent';
            } else {
                $bln_08_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor08_crt_b['jml_08_crt_b'] == NULL || $ResultDataFor08_crt_b['jml_08_crt_b'] == 0) {
                $bln_08_b_crt = 'transparent';
            } else {
                $bln_08_b_crt = '';
            }
            if ($ResultDataFor08_ltr_b['jml_08_ltr_b'] == NULL || $ResultDataFor08_ltr_b['jml_08_ltr_b'] == 0) {
                $bln_08_b_ltr = 'transparent';
            } else {
                $bln_08_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor08_crt_c['jml_08_crt_c'] == NULL || $ResultDataFor08_crt_c['jml_08_crt_c'] == 0) {
                $bln_08_c_crt = 'transparent';
            } else {
                $bln_08_c_crt = '';
            }
            if ($ResultDataFor08_ltr_c['jml_08_ltr_c'] == NULL || $ResultDataFor08_ltr_c['jml_08_ltr_c'] == 0) {
                $bln_08_c_ltr = 'transparent';
            } else {
                $bln_08_c_ltr = '';
            }
            // GOL c

            $Bln_jml_08_crt = $ResultDataFor08_crt_a['jml_08_crt_a'] + $ResultDataFor08_crt_b['jml_08_crt_b'] + $ResultDataFor08_crt_c['jml_08_crt_c'];
            if ($Bln_jml_08_crt == NULL || $Bln_jml_08_crt == 0) {
                $bln_08_crt = 'transparent';
            } else {
                $bln_08_crt = '';
            }
            $Bln_jml_08_lrt = $ResultDataFor08_ltr_a['jml_08_ltr_a'] + $ResultDataFor08_ltr_b['jml_08_ltr_b'] + $ResultDataFor08_ltr_c['jml_08_ltr_c'];
            if ($Bln_jml_08_lrt == NULL || $Bln_jml_08_lrt == 0) {
                $bln_08_ltr = 'transparent';
            } else {
                $bln_08_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_08_a_crt; ?>"><?= decimal($ResultDataFor08_crt_a['jml_08_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_08_a_ltr; ?>"><?= decimal($ResultDataFor08_ltr_a['jml_08_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_08_b_crt; ?>"><?= decimal($ResultDataFor08_crt_b['jml_08_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_08_b_ltr; ?>"><?= decimal($ResultDataFor08_ltr_b['jml_08_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_08_c_crt; ?>"><?= decimal($ResultDataFor08_crt_c['jml_08_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_08_c_ltr; ?>"><?= decimal($ResultDataFor08_ltr_c['jml_08_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_08_crt; ?>"><?= $Bln_jml_08_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_08_ltr; ?>"><?= $Bln_jml_08_lrt ?></td>
        </tr>
        <tr>
            <td>9. </td>
            <td>September</td>
            <?php
            // GOL A
            if ($ResultDataFor09_crt_a['jml_09_crt_a'] == NULL || $ResultDataFor09_crt_a['jml_09_crt_a'] == 0) {
                $bln_09_a_crt = 'transparent';
            } else {
                $bln_09_a_crt = '';
            }
            if ($ResultDataFor09_ltr_a['jml_09_ltr_a'] == NULL || $ResultDataFor09_ltr_a['jml_09_ltr_a'] == 0) {
                $bln_09_a_ltr = 'transparent';
            } else {
                $bln_09_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor09_crt_b['jml_09_crt_b'] == NULL || $ResultDataFor09_crt_b['jml_09_crt_b'] == 0) {
                $bln_09_b_crt = 'transparent';
            } else {
                $bln_09_b_crt = '';
            }
            if ($ResultDataFor09_ltr_b['jml_09_ltr_b'] == NULL || $ResultDataFor09_ltr_b['jml_09_ltr_b'] == 0) {
                $bln_09_b_ltr = 'transparent';
            } else {
                $bln_09_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor09_crt_c['jml_09_crt_c'] == NULL || $ResultDataFor09_crt_c['jml_09_crt_c'] == 0) {
                $bln_09_c_crt = 'transparent';
            } else {
                $bln_09_c_crt = '';
            }
            if ($ResultDataFor09_ltr_c['jml_09_ltr_c'] == NULL || $ResultDataFor09_ltr_c['jml_09_ltr_c'] == 0) {
                $bln_09_c_ltr = 'transparent';
            } else {
                $bln_09_c_ltr = '';
            }
            // GOL c

            $Bln_jml_09_crt = $ResultDataFor09_crt_a['jml_09_crt_a'] + $ResultDataFor09_crt_b['jml_09_crt_b'] + $ResultDataFor09_crt_c['jml_09_crt_c'];
            if ($Bln_jml_09_crt == NULL || $Bln_jml_09_crt == 0) {
                $bln_09_crt = 'transparent';
            } else {
                $bln_09_crt = '';
            }
            $Bln_jml_09_lrt = $ResultDataFor09_ltr_a['jml_09_ltr_a'] + $ResultDataFor09_ltr_b['jml_09_ltr_b'] + $ResultDataFor09_ltr_c['jml_09_ltr_c'];
            if ($Bln_jml_09_lrt == NULL || $Bln_jml_09_lrt == 0) {
                $bln_09_ltr = 'transparent';
            } else {
                $bln_09_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_09_a_crt; ?>"><?= decimal($ResultDataFor09_crt_a['jml_09_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_09_a_ltr; ?>"><?= decimal($ResultDataFor09_ltr_a['jml_09_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_09_b_crt; ?>"><?= decimal($ResultDataFor09_crt_b['jml_09_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_09_b_ltr; ?>"><?= decimal($ResultDataFor09_ltr_b['jml_09_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_09_c_crt; ?>"><?= decimal($ResultDataFor09_crt_c['jml_09_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_09_c_ltr; ?>"><?= decimal($ResultDataFor09_ltr_c['jml_09_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_09_crt; ?>"><?= $Bln_jml_09_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_09_ltr; ?>"><?= $Bln_jml_09_lrt ?></td>
        </tr>
        <tr>
            <td>10. </td>
            <td>Oktober</td>
            <?php
            // GOL A
            if ($ResultDataFor10_crt_a['jml_10_crt_a'] == NULL || $ResultDataFor10_crt_a['jml_10_crt_a'] == 0) {
                $bln_10_a_crt = 'transparent';
            } else {
                $bln_10_a_crt = '';
            }
            if ($ResultDataFor10_ltr_a['jml_10_ltr_a'] == NULL || $ResultDataFor10_ltr_a['jml_10_ltr_a'] == 0) {
                $bln_10_a_ltr = 'transparent';
            } else {
                $bln_10_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor10_crt_b['jml_10_crt_b'] == NULL || $ResultDataFor10_crt_b['jml_10_crt_b'] == 0) {
                $bln_10_b_crt = 'transparent';
            } else {
                $bln_10_b_crt = '';
            }
            if ($ResultDataFor10_ltr_b['jml_10_ltr_b'] == NULL || $ResultDataFor10_ltr_b['jml_10_ltr_b'] == 0) {
                $bln_10_b_ltr = 'transparent';
            } else {
                $bln_10_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor10_crt_c['jml_10_crt_c'] == NULL || $ResultDataFor10_crt_c['jml_10_crt_c'] == 0) {
                $bln_10_c_crt = 'transparent';
            } else {
                $bln_10_c_crt = '';
            }
            if ($ResultDataFor10_ltr_c['jml_10_ltr_c'] == NULL || $ResultDataFor10_ltr_c['jml_10_ltr_c'] == 0) {
                $bln_10_c_ltr = 'transparent';
            } else {
                $bln_10_c_ltr = '';
            }
            // GOL c

            $Bln_jml_10_crt = $ResultDataFor10_crt_a['jml_10_crt_a'] + $ResultDataFor10_crt_b['jml_10_crt_b'] + $ResultDataFor10_crt_c['jml_10_crt_c'];
            if ($Bln_jml_10_crt == NULL || $Bln_jml_10_crt == 0) {
                $bln_10_crt = 'transparent';
            } else {
                $bln_10_crt = '';
            }
            $Bln_jml_10_lrt = $ResultDataFor10_ltr_a['jml_10_ltr_a'] + $ResultDataFor10_ltr_b['jml_10_ltr_b'] + $ResultDataFor10_ltr_c['jml_10_ltr_c'];
            if ($Bln_jml_10_lrt == NULL || $Bln_jml_10_lrt == 0) {
                $bln_10_ltr = 'transparent';
            } else {
                $bln_10_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_10_a_crt; ?>"><?= decimal($ResultDataFor10_crt_a['jml_10_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_10_a_ltr; ?>"><?= decimal($ResultDataFor10_ltr_a['jml_10_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_10_b_crt; ?>"><?= decimal($ResultDataFor10_crt_b['jml_10_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_10_b_ltr; ?>"><?= decimal($ResultDataFor10_ltr_b['jml_10_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_10_c_crt; ?>"><?= decimal($ResultDataFor10_crt_c['jml_10_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_10_c_ltr; ?>"><?= decimal($ResultDataFor10_ltr_c['jml_10_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_10_crt; ?>"><?= $Bln_jml_10_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_10_ltr; ?>"><?= $Bln_jml_10_lrt ?></td>
        </tr>
        <tr>
            <td>11. </td>
            <td>November</td>
            <?php
            // GOL A
            if ($ResultDataFor11_crt_a['jml_11_crt_a'] == NULL || $ResultDataFor11_crt_a['jml_11_crt_a'] == 0) {
                $bln_11_a_crt = 'transparent';
            } else {
                $bln_11_a_crt = '';
            }
            if ($ResultDataFor11_ltr_a['jml_11_ltr_a'] == NULL || $ResultDataFor11_ltr_a['jml_11_ltr_a'] == 0) {
                $bln_11_a_ltr = 'transparent';
            } else {
                $bln_11_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor11_crt_b['jml_11_crt_b'] == NULL || $ResultDataFor11_crt_b['jml_11_crt_b'] == 0) {
                $bln_11_b_crt = 'transparent';
            } else {
                $bln_11_b_crt = '';
            }
            if ($ResultDataFor11_ltr_b['jml_11_ltr_b'] == NULL || $ResultDataFor11_ltr_b['jml_11_ltr_b'] == 0) {
                $bln_11_b_ltr = 'transparent';
            } else {
                $bln_11_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor11_crt_c['jml_11_crt_c'] == NULL || $ResultDataFor11_crt_c['jml_11_crt_c'] == 0) {
                $bln_11_c_crt = 'transparent';
            } else {
                $bln_11_c_crt = '';
            }
            if ($ResultDataFor11_ltr_c['jml_11_ltr_c'] == NULL || $ResultDataFor11_ltr_c['jml_11_ltr_c'] == 0) {
                $bln_11_c_ltr = 'transparent';
            } else {
                $bln_11_c_ltr = '';
            }
            // GOL c

            $Bln_jml_11_crt = $ResultDataFor11_crt_a['jml_11_crt_a'] + $ResultDataFor11_crt_b['jml_11_crt_b'] + $ResultDataFor11_crt_c['jml_11_crt_c'];
            if ($Bln_jml_11_crt == NULL || $Bln_jml_11_crt == 0) {
                $bln_11_crt = 'transparent';
            } else {
                $bln_11_crt = '';
            }
            $Bln_jml_11_lrt = $ResultDataFor11_ltr_a['jml_11_ltr_a'] + $ResultDataFor11_ltr_b['jml_11_ltr_b'] + $ResultDataFor11_ltr_c['jml_11_ltr_c'];
            if ($Bln_jml_11_lrt == NULL || $Bln_jml_11_lrt == 0) {
                $bln_11_ltr = 'transparent';
            } else {
                $bln_11_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_11_a_crt; ?>"><?= decimal($ResultDataFor11_crt_a['jml_11_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_11_a_ltr; ?>"><?= decimal($ResultDataFor11_ltr_a['jml_11_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_11_b_crt; ?>"><?= decimal($ResultDataFor11_crt_b['jml_11_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_11_b_ltr; ?>"><?= decimal($ResultDataFor11_ltr_b['jml_11_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_11_c_crt; ?>"><?= decimal($ResultDataFor11_crt_c['jml_11_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_11_c_ltr; ?>"><?= decimal($ResultDataFor11_ltr_c['jml_11_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_11_crt; ?>"><?= $Bln_jml_11_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_11_ltr; ?>"><?= $Bln_jml_11_lrt ?></td>
        </tr>
        <tr>
            <td>12. </td>
            <td>Desember</td>
            <?php
            // GOL A
            if ($ResultDataFor12_crt_a['jml_12_crt_a'] == NULL || $ResultDataFor12_crt_a['jml_12_crt_a'] == 0) {
                $bln_12_a_crt = 'transparent';
            } else {
                $bln_12_a_crt = '';
            }
            if ($ResultDataFor12_ltr_a['jml_12_ltr_a'] == NULL || $ResultDataFor12_ltr_a['jml_12_ltr_a'] == 0) {
                $bln_12_a_ltr = 'transparent';
            } else {
                $bln_12_a_ltr = '';
            }
            // GOL A

            // GOL B
            if ($ResultDataFor12_crt_b['jml_12_crt_b'] == NULL || $ResultDataFor12_crt_b['jml_12_crt_b'] == 0) {
                $bln_12_b_crt = 'transparent';
            } else {
                $bln_12_b_crt = '';
            }
            if ($ResultDataFor12_ltr_b['jml_12_ltr_b'] == NULL || $ResultDataFor12_ltr_b['jml_12_ltr_b'] == 0) {
                $bln_12_b_ltr = 'transparent';
            } else {
                $bln_12_b_ltr = '';
            }
            // GOL B

            // GOL c
            if ($ResultDataFor12_crt_c['jml_12_crt_c'] == NULL || $ResultDataFor12_crt_c['jml_12_crt_c'] == 0) {
                $bln_12_c_crt = 'transparent';
            } else {
                $bln_12_c_crt = '';
            }
            if ($ResultDataFor12_ltr_c['jml_12_ltr_c'] == NULL || $ResultDataFor12_ltr_c['jml_12_ltr_c'] == 0) {
                $bln_12_c_ltr = 'transparent';
            } else {
                $bln_12_c_ltr = '';
            }
            // GOL c

            $Bln_jml_12_crt = $ResultDataFor12_crt_a['jml_12_crt_a'] + $ResultDataFor12_crt_b['jml_12_crt_b'] + $ResultDataFor12_crt_c['jml_12_crt_c'];
            if ($Bln_jml_12_crt == NULL || $Bln_jml_12_crt == 0) {
                $bln_12_crt = 'transparent';
            } else {
                $bln_12_crt = '';
            }
            $Bln_jml_12_lrt = $ResultDataFor12_ltr_a['jml_12_ltr_a'] + $ResultDataFor12_ltr_b['jml_12_ltr_b'] + $ResultDataFor12_ltr_c['jml_12_ltr_c'];
            if ($Bln_jml_12_lrt == NULL || $Bln_jml_12_lrt == 0) {
                $bln_12_ltr = 'transparent';
            } else {
                $bln_12_ltr = '';
            }
            ?>
            <td style="text-align: center;background: <?= $bln_12_a_crt; ?>"><?= decimal($ResultDataFor12_crt_a['jml_12_crt_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_12_a_ltr; ?>"><?= decimal($ResultDataFor12_ltr_a['jml_12_ltr_a']) ?></td>
            <td style="text-align: center;background: <?= $bln_12_b_crt; ?>"><?= decimal($ResultDataFor12_crt_b['jml_12_crt_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_12_b_ltr; ?>"><?= decimal($ResultDataFor12_ltr_b['jml_12_ltr_b']) ?></td>
            <td style="text-align: center;background: <?= $bln_12_c_crt; ?>"><?= decimal($ResultDataFor12_crt_c['jml_12_crt_c']) ?></td>
            <td style="text-align: center;background: <?= $bln_12_c_ltr; ?>"><?= decimal($ResultDataFor12_ltr_c['jml_12_ltr_c']) ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_12_crt; ?>"><?= $Bln_jml_12_crt ?></td>
            <td colspan="2" style="text-align: center;background: <?= $bln_12_ltr; ?>"><?= $Bln_jml_12_lrt ?></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th style="background-color: #dadddf;"></th>
            <th>TOTAL REALISASI</th>
            <?php
            // GOL A
            $jml_crt_gol_a = $ResultDataFor01_crt_a['jml_01_crt_a'] + $ResultDataFor02_crt_a['jml_02_crt_a'] + $ResultDataFor03_crt_a['jml_03_crt_a'] + $ResultDataFor04_crt_a['jml_04_crt_a'] +
                $ResultDataFor05_crt_a['jml_05_crt_a'] + $ResultDataFor06_crt_a['jml_06_crt_a'] + $ResultDataFor07_crt_a['jml_07_crt_a'] + $ResultDataFor08_crt_a['jml_08_crt_a'] +
                $ResultDataFor09_crt_a['jml_09_crt_a'] + $ResultDataFor10_crt_a['jml_10_crt_a'] + $ResultDataFor11_crt_a['jml_11_crt_a'] + $ResultDataFor12_crt_a['jml_12_crt_a'];
            if ($jml_crt_gol_a == NULL || $jml_crt_gol_a === 0) {
                $bg_crt_a = '#dadddf';
            } else {
                $bg_crt_a = '#dadddf';
            }
            $jml_ltr_gol_a = $ResultDataFor01_ltr_a['jml_01_ltr_a'] + $ResultDataFor02_ltr_a['jml_02_ltr_a'] + $ResultDataFor03_ltr_a['jml_03_ltr_a'] + $ResultDataFor04_ltr_a['jml_04_ltr_a'] +
                $ResultDataFor05_ltr_a['jml_05_ltr_a'] + $ResultDataFor06_ltr_a['jml_06_ltr_a'] + $ResultDataFor07_ltr_a['jml_07_ltr_a'] + $ResultDataFor08_ltr_a['jml_08_ltr_a'] +
                $ResultDataFor09_ltr_a['jml_09_ltr_a'] + $ResultDataFor10_ltr_a['jml_10_ltr_a'] + $ResultDataFor11_ltr_a['jml_11_ltr_a'] + $ResultDataFor12_ltr_a['jml_12_ltr_a'];
            if ($jml_ltr_gol_a == NULL || $jml_ltr_gol_a === 0) {
                $bg_ltr_a = '#dadddf';
            } else {
                $bg_ltr_a = '#dadddf';
            }
            // End GOL A

            // GOL B
            $jml_crt_gol_b = $ResultDataFor01_crt_b['jml_01_crt_b'] + $ResultDataFor02_crt_b['jml_02_crt_b'] + $ResultDataFor03_crt_b['jml_03_crt_b'] + $ResultDataFor04_crt_b['jml_04_crt_b'] +
                $ResultDataFor05_crt_b['jml_05_crt_b'] + $ResultDataFor06_crt_b['jml_06_crt_b'] + $ResultDataFor07_crt_b['jml_07_crt_b'] + $ResultDataFor08_crt_b['jml_08_crt_b'] +
                $ResultDataFor09_crt_b['jml_09_crt_b'] + $ResultDataFor10_crt_b['jml_10_crt_b'] + $ResultDataFor11_crt_b['jml_11_crt_b'] + $ResultDataFor12_crt_b['jml_12_crt_b'];
            if ($jml_crt_gol_b == NULL || $jml_crt_gol_b == 0) {
                $bg_crt_b = '#dadddf';
            } else {
                $bg_crt_b = '#dadddf';
            }
            $jml_ltr_gol_b = $ResultDataFor01_ltr_b['jml_01_ltr_b'] + $ResultDataFor02_ltr_b['jml_02_ltr_b'] + $ResultDataFor03_ltr_b['jml_03_ltr_b'] + $ResultDataFor04_ltr_b['jml_04_ltr_b'] +
                $ResultDataFor05_ltr_b['jml_05_ltr_b'] + $ResultDataFor06_ltr_b['jml_06_ltr_b'] + $ResultDataFor07_ltr_b['jml_07_ltr_b'] + $ResultDataFor08_ltr_b['jml_08_ltr_b'] +
                $ResultDataFor09_ltr_b['jml_09_ltr_b'] + $ResultDataFor10_ltr_b['jml_10_ltr_b'] + $ResultDataFor11_ltr_b['jml_11_ltr_b'] + $ResultDataFor12_ltr_b['jml_12_ltr_b'];
            if ($jml_ltr_gol_b == NULL || $jml_ltr_gol_b == 0) {
                $bg_ltr_b = '#dadddf';
            } else {
                $bg_ltr_b = '#dadddf';
            }
            // End GOL B

            // GOL C
            $jml_crt_gol_c = $ResultDataFor01_crt_c['jml_01_crt_c'] + $ResultDataFor02_crt_c['jml_02_crt_c'] + $ResultDataFor03_crt_c['jml_03_crt_c'] + $ResultDataFor04_crt_c['jml_04_crt_c'] +
                $ResultDataFor05_crt_c['jml_05_crt_c'] + $ResultDataFor06_crt_c['jml_06_crt_c'] + $ResultDataFor07_crt_c['jml_07_crt_c'] + $ResultDataFor08_crt_c['jml_08_crt_c'] +
                $ResultDataFor09_crt_c['jml_09_crt_c'] + $ResultDataFor10_crt_c['jml_10_crt_c'] + $ResultDataFor11_crt_c['jml_11_crt_c'] + $ResultDataFor12_crt_c['jml_12_crt_c'];
            if ($jml_crt_gol_c == NULL || $jml_crt_gol_c == 0) {
                $bg_crt_c = '#dadddf';
            } else {
                $bg_crt_c = '#dadddf';
            }
            $jml_ltr_gol_c = $ResultDataFor01_ltr_c['jml_01_ltr_c'] + $ResultDataFor02_ltr_c['jml_02_ltr_c'] + $ResultDataFor03_ltr_c['jml_03_ltr_c'] + $ResultDataFor04_ltr_c['jml_04_ltr_c'] +
                $ResultDataFor05_ltr_c['jml_05_ltr_c'] + $ResultDataFor06_ltr_c['jml_06_ltr_c'] + $ResultDataFor07_ltr_c['jml_07_ltr_c'] + $ResultDataFor08_ltr_c['jml_08_ltr_c'] +
                $ResultDataFor09_ltr_c['jml_09_ltr_c'] + $ResultDataFor10_ltr_c['jml_10_ltr_c'] + $ResultDataFor11_ltr_c['jml_11_ltr_c'] + $ResultDataFor12_ltr_c['jml_12_ltr_c'];
            if ($jml_ltr_gol_c == NULL || $jml_ltr_gol_c == 0) {
                $bg_ltr_c = '#dadddf';
            } else {
                $bg_ltr_c = '#dadddf';
            }
            // End GOL C

            // TOTAL
            // CARTON
            $jml_crt_gol_total = $jml_crt_gol_a + $jml_crt_gol_b + $jml_crt_gol_c;
            if ($jml_crt_gol_total == NULL || $jml_crt_gol_total == 0) {
                $bg_crt_total = '#dadddf';
            } else {
                $bg_crt_total = '#dadddf';
            }
            // LITER
            $jml_ltr_gol_total = $jml_ltr_gol_a + $jml_ltr_gol_b + $jml_ltr_gol_c;
            if ($jml_ltr_gol_total == NULL || $jml_ltr_gol_total == 0) {
                $bg_ltr_total = '#dadddf';
            } else {
                $bg_ltr_total = '#dadddf';
            }
            // End TOTAL
            ?>
            <th style="text-align: center;background: <?= $bg_crt_a; ?>"><?= decimal($jml_crt_gol_a) ?></th>
            <th style="text-align: center;background: <?= $bg_ltr_a; ?>"><?= decimal($jml_ltr_gol_a) ?></th>
            <th style="text-align: center;background: <?= $bg_crt_b; ?>"><?= decimal($jml_crt_gol_b) ?></th>
            <th style="text-align: center;background: <?= $bg_ltr_b; ?>"><?= decimal($jml_ltr_gol_b) ?></th>
            <th style="text-align: center;background: <?= $bg_crt_c; ?>"><?= decimal($jml_crt_gol_c) ?></th>
            <th style="text-align: center;background: <?= $bg_ltr_c; ?>"><?= decimal($jml_ltr_gol_c) ?></th>
            <th colspan="2" style="text-align: center;background: <?= $bg_crt_total; ?>"><?= decimal($jml_crt_gol_total) ?></th>
            <th colspan="2" style="text-align: center;background: <?= $bg_ltr_total; ?>"><?= decimal($jml_ltr_gol_total) ?></th>
        </tr>
        <tr>
            <th style="background-color: #dadddf;"></th>
            <th>TOTAL SISA KUOTA</th>
            <?php
            $fC_a = $row['gol_a_car'];
            $fL_a = $row['gol_a_ltr'];
            $fC_b = $row['gol_b_car'];
            $fL_b = $row['gol_b_ltr'];
            $fC_c = $row['gol_c_car'];
            $fL_c = $row['gol_c_ltr'];

            $sisa_crt_a = $fC_a - $jml_crt_gol_a;
            if ($sisa_crt_a == NULL || $sisa_crt_a == 0) {
                $bg_sisa_crt_a = '#dadddf';
            } else {
                $bg_sisa_crt_a = '#dadddf';
            }
            $sisa_ltr_a = $fL_a - $jml_ltr_gol_a;
            if ($sisa_ltr_a == NULL || $sisa_ltr_a == 0) {
                $bg_sisa_ltr_a = '#dadddf';
            } else {
                $bg_sisa_ltr_a = '#dadddf';
            }
            $sisa_crt_b = $fC_b - $jml_crt_gol_b;
            if ($sisa_crt_b == NULL || $sisa_crt_b == 0) {
                $bg_sisa_crt_b = '#dadddf';
            } else {
                $bg_sisa_crt_b = '#dadddf';
            }
            $sisa_ltr_b = $fL_b - $jml_ltr_gol_b;
            if ($sisa_ltr_b == NULL || $sisa_ltr_b == 0) {
                $bg_sisa_ltr_b = '#dadddf';
            } else {
                $bg_sisa_ltr_b = '#dadddf';
            }
            $sisa_crt_c = $fC_c - $jml_crt_gol_c;
            if ($sisa_crt_c == NULL || $sisa_crt_c == 0) {
                $bg_sisa_crt_c = '#dadddf';
            } else {
                $bg_sisa_crt_c = '#dadddf';
            }
            $sisa_ltr_c = $fL_c - $jml_ltr_gol_c;
            if ($sisa_ltr_c == NULL || $sisa_ltr_c == 0) {
                $bg_sisa_ltr_c = '#dadddf';
            } else {
                $bg_sisa_ltr_c = '#dadddf';
            }
            $sisa_crt_total = $JmlCarton - $jml_crt_gol_total;
            if ($sisa_crt_total == NULL || $sisa_crt_total == 0) {
                $bg_sisa_crt_total = '#dadddf';
            } else {
                $bg_sisa_crt_total = '#dadddf';
            }
            $sisa_ltr_total = $JmlLiter - $jml_ltr_gol_total;
            if ($sisa_ltr_total == NULL || $sisa_ltr_total == 0) {
                $bg_sisa_ltr_total = '#dadddf';
            } else {
                $bg_sisa_ltr_total = '#dadddf';
            }
            ?>
            <th style="text-align: center;background: <?= $bg_sisa_crt_a ?>;"><?= decimal($sisa_crt_a) ?></th>
            <th style="text-align: center;background: <?= $bg_sisa_ltr_a ?>;"><?= decimal($sisa_ltr_a) ?></th>
            <th style="text-align: center;background: <?= $bg_sisa_crt_b ?>;"><?= decimal($sisa_crt_b) ?></th>
            <th style="text-align: center;background: <?= $bg_sisa_ltr_b ?>;"><?= decimal($sisa_ltr_b) ?></th>
            <th style="text-align: center;background: <?= $bg_sisa_crt_c ?>;"><?= decimal($sisa_crt_c) ?></th>
            <th style="text-align: center;background: <?= $bg_sisa_ltr_c ?>;"><?= decimal($sisa_ltr_c) ?></th>
            <th colspan="2" style="text-align: center;background: <?= $bg_sisa_crt_total ?>;"><?= decimal($sisa_crt_total) ?></th>
            <th colspan="2" style="text-align: center;background: <?= $bg_sisa_ltr_total ?>;"><?= decimal($sisa_ltr_total) ?></th>
        </tr>
        <tr>
            <th style="background-color: #dadddf;"></th>
            <th>%</th>
            <?php
            if ($fC_a == 0) {
                $per_crt_a = $jml_crt_gol_a;
            } else {
                $per_crt_a = $jml_crt_gol_a / $fC_a * 100;
            }
            if ($fL_a == 0) {
                $per_ltr_a = $jml_ltr_gol_a;
            } else {
                $per_ltr_a = $jml_ltr_gol_a / $fL_a * 100;
            }
            if ($fC_b == 0) {
                $per_crt_b = $jml_crt_gol_b;
            } else {
                $per_crt_b = $jml_crt_gol_b / $fC_b * 100;
            }
            if ($fL_b == 0) {
                $per_ltr_b = $jml_ltr_gol_b;
            } else {
                $per_ltr_b = $jml_ltr_gol_b / $fL_b * 100;
            }
            if ($fC_c == 0) {
                $per_crt_c = $jml_crt_gol_c;
            } else {
                $per_crt_c = $jml_crt_gol_c / $fC_c * 100;
            }
            if ($fL_c == 0) {
                $per_ltr_c = $jml_ltr_gol_c;
            } else {
                $per_ltr_c = $jml_ltr_gol_c / $fL_c * 100;
            }
            if ($JmlCarton == 0) {
                $per_crt_total = $jml_crt_gol_total;
            } else {
                $per_crt_total = $jml_crt_gol_total / $JmlCarton * 100;
            }
            if ($JmlCarton == 0) {
                $per_ltr_total = $jml_ltr_gol_total;
            } else {
                $per_ltr_total = $jml_ltr_gol_total / $JmlLiter * 100;
            }
            ?>
            <th style="text-align: center;background: <?= $bg_per_crt_a; ?>;"><?= round($per_crt_a, 0, PHP_ROUND_HALF_UP) ?>%</th>
            <th style="text-align: center;background: <?= $bg_per_ltr_a; ?>;"><?= round($per_ltr_a, 0, PHP_ROUND_HALF_UP) ?>%</th>
            <th style="text-align: center;background: <?= $bg_per_crt_b; ?>;"><?= round($per_crt_b, 0, PHP_ROUND_HALF_UP) ?>%</th>
            <th style="text-align: center;background: <?= $bg_per_ltr_b; ?>;"><?= round($per_ltr_b, 0, PHP_ROUND_HALF_UP) ?>%</th>
            <th style="text-align: center;background: <?= $bg_per_crt_c; ?>;"><?= round($per_crt_c, 0, PHP_ROUND_HALF_UP) ?>%</th>
            <th style="text-align: center;background: <?= $bg_per_ltr_c; ?>;"><?= round($per_ltr_c, 0, PHP_ROUND_HALF_UP) ?>%</th>
            <th colspan="2" style="text-align: center;background: <?= $bg_per_crt_total; ?>;"><?= round($per_crt_total, 0, PHP_ROUND_HALF_UP) ?>%</th>
            <th colspan="2" style="text-align: center;background: <?= $bg_per_ltr_total; ?>;"><?= round($per_ltr_total, 0, PHP_ROUND_HALF_UP) ?>%</th>
        </tr>
    </tfoot>
</table>