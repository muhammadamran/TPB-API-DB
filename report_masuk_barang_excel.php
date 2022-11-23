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

$ShowFindNoAJU      = '';
$ShowField_RTU      = '';
$ShowField_RTM      = '';

// RTU
if (isset($_POST["Find_NP"])) {
    $FindNoAJU      = $_POST['FindNoAJU'];
    $ShowFindNoAJU  = $_POST['ShowFindNoAJU'];
}

// RTU
if (isset($_POST["Find_RTU"])) {
    $S_RTU          = $_POST['S_RTU'];
    $E_RTU          = $_POST['E_RTU'];
    $ShowField_RTU  = $_POST['ShowField_RTU'];
}

// RTM
if (isset($_POST["Find_RTM"])) {
    $S_RTM          = $_POST['S_RTM'];
    $E_RTM          = $_POST['E_RTM'];
    $ShowField_RTM  = $_POST['ShowField_RTM'];
}
if (isset($_POST["Find_NP"])) {
    header("Content-Disposition: attachment; filename=Laporan Barang Masuk $ShowFindNoAJU-$datenow.xls");
} else if (isset($_POST["Find_RTU"])) {
    header("Content-Disposition: attachment; filename=Laporan Barang Masuk_Range-Tanggal-Upload-$datenow.xls");
} else if (isset($_POST["Find_RTM"])) {
    header("Content-Disposition: attachment; filename=Laporan Barang Masuk_Range-Tanggal-Masuk-$datenow.xls");
} else {
    header("Content-Disposition: attachment; filename=Laporan Barang Masuk 100 Data Terakhir_$datenow.xls");
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
            <td style="border-bottom: 1px solid #333;" colspan="15">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="border-style: none; height: 18px; width: 1541px;" colspan="15">&nbsp;</td>
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
            <td colspan="4" rowspan="2" width="579" style="font-size: 18px;font-weight: 900;">LAPORAN PEMASUKAN BARANG PER DOKUMEN PABEAN</td>
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
                if (isset($_POST["Find_NP"])) {
                    echo $ShowFindNoAJU;
                } else if (isset($_POST["Find_RTU"])) {
                    echo $ShowField_RTU;
                } else if (isset($_POST["Find_RTM"])) {
                    echo $ShowField_RTM;
                } else {
                    echo "100 Data Terakhir Barang Masuk";
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
            <td style="border-bottom: 1px solid #333;" colspan="15">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="border-style: none; height: 18px; width: 1541px;" colspan="15">&nbsp;</td>
        </tr>
    </tbody>
</table>
<!-- END LINE -->
<!-- Begin Row -->
<table class="table table-bordered table-td-valign-middle" border="1">
    <thead style="background: #dadddf;color: #333;">
        <tr style="background: #dadddf;color: #333;">
            <th rowspan="2" width="1%">No.</th>
            <th colspan="5" style="text-align: center;">Dokumen Pabean BC 2.7 PLB</th>
            <th colspan="2" style="text-align: center;">Tanggal & Waktu</th>
            <th rowspan="2" style="text-align: center;">Kode Barang</th>
            <th rowspan="2" style="text-align: center;">Uraian</th>
            <th rowspan="2" style="text-align: center;">Spesifikasi<font style="color: #dadddf;">.</font>Lain</th>
            <th rowspan="2" style="text-align: center;">Jumlah<font style="color: #dadddf;">.</font>Satuan</th>
            <th rowspan="2" style="text-align: center;">Nilai<font style="color: #dadddf;">.</font>Barang</th>
            <th colspan="2" style="text-align: center;">Petugas</th>
        </tr>
        <tr style="background: #dadddf;color: #333;">
            <th class="no-sort" style="text-align: center;">Jenis<font style="color: #dadddf;">.</font>Dokumen</th>
            <th style="text-align: center;">Nomor Pengajuan</th>
            <th style="text-align: center;">No. Daftar</th>
            <th style="text-align: center;">Asal</th>
            <th style="text-align: center;">Tujuan</th>
            <th class="text-nowrap no-sort" style="text-align: center;">Upload PLB</th>
            <th class="text-nowrap no-sort" style="text-align: center;">Masuk Barang</th>
            <th style="text-align: center;"><?= $resultHeadSetting['company']; ?></th>
            <th style="text-align: center;">BeaCukai</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_POST["Find_NP"])) {
            $dataTable = $dbcon->query("SELECT *,plb.CIF AS CIF_BRG FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            AND rcd.bm_no_aju_plb LIKE '%" . $FindNoAJU . "%'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC", 0);
        } else if (isset($_POST["Find_RTU"])) {
            $dataTable = $dbcon->query("SELECT *,plb.CIF AS CIF_BRG FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            AND sts.ck5_plb_submit BETWEEN '" . $S_RTU . "' AND '" . $E_RTU . " 23:59:59'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC", 0);
        } else if (isset($_POST["Find_RTM"])) {
            $dataTable = $dbcon->query("SELECT *,plb.CIF AS CIF_BRG FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            AND plb.TGL_CEK BETWEEN '" . $S_RTM . "' AND '" . $E_RTM . " 23:59:59'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC", 0);
        } else {
            $dataTable = $dbcon->query("SELECT *,plb.CIF AS CIF_BRG FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC LIMIT 100", 0);
        }

        if ($dataTable) : $no = 1;
            foreach ($dataTable as $row) :
        ?>
                <tr>
                    <td><?= $no ?>.</td>
                    <td style="text-align: center">
                        BC <?= $row['KODE_DOKUMEN_PABEAN']; ?>
                    </td>
                    <td style="text-align: center">
                        <?php if ($row['NOMOR_AJU'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                            </font>
                        <?php } else { ?>
                            '<?= $row['NOMOR_AJU']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: center">
                        <?php if ($row['NOMOR_DAFTAR'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                            </font>
                        <?php } else { ?>
                            '<?= $row['NOMOR_DAFTAR']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: left">
                        <?php if ($row['PERUSAHAAN'] == NULL) { ?>
                            <center>
                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                </font>
                            </center>
                        <?php } else { ?>
                            <?= $row['PERUSAHAAN']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: left">
                        <?php if ($row['NAMA_PENERIMA_BARANG'] == NULL) { ?>
                            <center>
                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                                </font>
                            </center>
                        <?php } else { ?>
                            <?= $row['NAMA_PENERIMA_BARANG']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: left">
                        <?php if ($row['ck5_plb_submit'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                        <?php } else { ?>
                            <?php
                            $alldate = $row['ck5_plb_submit'];
                            $tgl = substr($alldate, 0, 10);
                            $time = substr($alldate, 10, 20);
                            ?>
                            <?= date_indo_s($tgl) ?> <?= $time ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: left">
                        <?php
                        $alldateM = $row['TGL_CEK'];
                        $tglM = substr($alldateM, 0, 10);
                        $timeM = substr($alldateM, 10, 20);
                        ?>
                        <?php if ($row['TGL_CEK'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                        <?php } else { ?>
                            <?= date_indo_s($tglM); ?> <?= $timeM; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: left">
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
                        '<?= $KDBRG ?>
                    </td>
                    <td>
                        <?= $row['URAIAN']; ?>
                    </td>
                    <td style="text-align: center">
                        <?= $row['SPESIFIKASI_LAIN']; ?>
                    </td>
                    <td>
                        <div style="display: flex;justify-content: space-between;align-items: center">
                            <?php
                            $myString = $row['JUMLAH_SATUAN'];
                            if (strstr($myString, '.0000')) {
                                echo  "'<font>" . $row['JUMLAH_SATUAN'] . "</font>";
                            } else {
                                echo  "'<font>" . $row['JUMLAH_SATUAN'] . ".0000</font>";
                            }
                            ?>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex;justify-content: space-between;align-items: center">
                            '<?= $row['CIF_BRG']; ?>
                        </div>
                    </td>
                    <td style="text-align: left">
                        <?php if ($row['OPERATOR_ONE'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                            </font>
                        <?php } else { ?>
                            <?= $row['OPERATOR_ONE']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: left">
                        <?php if ($row['bc_in'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i>
                            </font>
                        <?php } else { ?>
                            <?= $row['bc_in']; ?>
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