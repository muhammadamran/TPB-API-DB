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

$ShowField_MASUK       = '';
$ShowField_KELUAR      = '';

// MASUK
if (isset($_POST["Find_MASUK"])) {
    $S_MASUK          = $_POST['S_MASUK'];
    $E_MASUK          = $_POST['E_MASUK'];
    $ShowField_MASUK  = $_POST['ShowField_MASUK'];
}

// KELUAR
if (isset($_POST["Find_KELUAR"])) {
    $S_KELUAR          = $_POST['S_KELUAR'];
    $E_KELUAR          = $_POST['E_KELUAR'];
    $ShowField_KELUAR  = $_POST['ShowField_KELUAR'];
}
if (isset($_POST["Find_MASUK"])) {
    header("Content-Disposition: attachment; filename=Laporan Posisi Barang_Range-Tanggal-Masuk-$datenow.xls");
} else if (isset($_POST["Find_KELUAR"])) {
    header("Content-Disposition: attachment; filename=Laporan Posisi Barang_Range-Tanggal-Keluar-$datenow.xls");
} else {
    header("Content-Disposition: attachment; filename=Laporan Posisi Barang 100 Data Terakhir_$datenow.xls");
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
            <td style="border-bottom: 1px solid #333;" colspan="28">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="border-style: none; height: 18px; width: 1541px;" colspan="28">&nbsp;</td>
        </tr>
    </tbody>
</table>
<!-- END LINE -->
<table width="1548">
    <tbody>
        <tr>
            <td colspan="4" rowspan="5" width="392">
                <p>
                <div style="display:flex;justify-content:center">
                    <font style="color: #fff;font-size: 72px;font-weight: 900;font-family: Brush Script MT, Brush Script Std, cursive;">##</font>
                    <font style="color: #d8121a;font-size: 72px;font-weight: 900;font-family: Brush Script MT, Brush Script Std, cursive;">Sarinah</font>
                </div>
                <br>
                </p>
            </td>
            <td colspan="4" rowspan="2" width="579" style="font-size: 18px;font-weight: 900;">LAPORAN POSISI BARANG PER DOKUMEN PABEAN</td>
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
                if (isset($_POST["Find_MASUK"])) {
                    echo $ShowField_MASUK;
                } else if (isset($_POST["Find_KELUAR"])) {
                    echo $ShowField_KELUAR;
                } else {
                    echo "100 Data Terakhir Posisi Barang";
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
            <td style="border-bottom: 1px solid #333;" colspan="28">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="border-style: none; height: 18px; width: 1541px;" colspan="28">&nbsp;</td>
        </tr>
    </tbody>
</table>
<!-- END LINE -->
<table class="table table-bordered table-td-valign-middle" border="1">
    <thead style="background: #dadddf;color: #333;">
        <tr style="background: #dadddf;color: #333;">
            <th rowspan="2" width="1%">No.</th>
            <!-- BARANG MASUK -->
            <th colspan="5" style="text-align: center;">Dokumen Pabean BC 2.7 PLB</th>
            <th colspan="2" style="text-align: center;">Tanggal & Waktu</th>
            <th rowspan="2" style="text-align: center;">Kode<font style="color: #dadddf;">.</font>Barang</th>
            <th rowspan="2" style="text-align: center;">Uraian</th>
            <th rowspan="2" style="text-align: center;">Spesifikasi<font style="color: #dadddf;">.</font>Lain</th>
            <th rowspan="2" style="text-align: center;">Jumlah<font style="color: #dadddf;">.</font>Satuan</th>
            <th rowspan="2" style="text-align: center;">Nilai<font style="color: #dadddf;">.</font>Barang</th>
            <th colspan="2" style="text-align: center;">Petugas</th>
            <!-- END BARANG MASUK -->
            <!-- BARANG KELUAR -->
            <th colspan="5" style="text-align: center;">Dokumen Pabean BC 2.7 GB</th>
            <th rowspan="2" style="text-align: center;">Kode<font style="color: #dadddf;">.</font>Barang</th>
            <th rowspan="2" style="text-align: center;">Uraian</th>
            <th rowspan="2" style="text-align: center;">Spesifikasi<font style="color: #dadddf;">.</font>Lain</th>
            <th rowspan="2" style="text-align: center;">Jumlah<font style="color: #dadddf;">.</font>Satuan</th>
            <th rowspan="2" style="text-align: center;">Nilai<font style="color: #dadddf;">.</font>Barang</th>
            <th rowspan="2" style="text-align: center;">Tanggal<font style="color: #dadddf;">.</font>&<font style="color: #dadddf;">.</font>Waktu<font style="color: #dadddf;">.</font>Keluar</th>
            <th colspan="2" style="text-align: center;">Petugas</th>
            <!-- END BARANG MASUK -->
        </tr>
        <tr style="background: #dadddf;color: #333;">
            <!-- BARANG MASUK -->
            <th class="no-sort" style="text-align: center;">Jenis<font style="color: #dadddf;">.</font>Dokumen</th>
            <th style="text-align: center;">Nomor Pengajuan</th>
            <th style="text-align: center;">No.<font style="color: #dadddf;">.</font>Daftar</th>
            <th style="text-align: center;">Asal</th>
            <th style="text-align: center;">Tujuan</th>
            <th class="text-nowrap no-sort" style="text-align: center;">Upload<font style="color: #dadddf;">.</font>PLB</th>
            <th class="text-nowrap no-sort" style="text-align: center;">Masuk<font style="color: #dadddf;">.</font>Barang</th>
            <th style="text-align: center;"><?= $resultHeadSetting['company']; ?></th>
            <th style="text-align: center;">BeaCukai</th>
            <!-- END BARANG MASUK -->
            <!-- BARANG KELUAR -->
            <th class="no-sort" style="text-align: center;">Jenis<font style="color: #dadddf;">.</font>Dokumen</th>
            <th style="text-align: center;">Nomor<font style="color: #dadddf;">.</font>Pengajuan</th>
            <th style="text-align: center;">No.<font style="color: #dadddf;">.</font>Daftar</th>
            <th style="text-align: center;">Asal</th>
            <th style="text-align: center;">Tujuan</th>
            <th style="text-align: center;"><?= $resultHeadSetting['company']; ?></th>
            <th style="text-align: center;">BeaCukai</th>
            <!-- END BARANG MASUK -->
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_POST["Find_MASUK"])) {
            $dataTable = $dbcon->query("SELECT
                                                                -- BARANG MASUK
                                                                plb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCPLB,
                                                                plb.NOMOR_AJU AS NOMOR_AJU_BCPLB,
                                                                plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCPLB,
                                                                plb.PERUSAHAAN,
                                                                plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCPLB,
                                                                sts.ck5_plb_submit,
                                                                brg.TGL_CEK,
                                                                brg.OPERATOR_ONE,
                                                                rcd.bc_in,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_no_aju_plb,
                                                                -- END BARANG MASUK
                                                                -- BARANG KELUAR
                                                                tpb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCGB,
                                                                tpb.NOMOR_AJU AS NOMOR_AJU_BCGB,
                                                                tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCGB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCGB,
                                                                brg.TGL_CEK_GB,
                                                                brg.OPERATOR_TWO,
                                                                rcd.bc_out,
                                                                rcd.upload_beritaAcara_GB,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_no_aju_sarinah,
                                                                -- END BARANG KELUAR
                                                                -- GABUNGAN
                                                                rcd.rcd_id,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.JUMLAH_SATUAN,
                                                                plb.KODE_VALUTA,
                                                                brg.CIF,
                                                                brg.POS_TARIF
                                                                -- END GABUNGAN
                                                                FROM rcd_status AS rcd 
                                                                LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_header AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU
                                                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                                                                AND brg.TGL_CEK BETWEEN '" . $S_MASUK . "' AND '" . $E_MASUK . " 23:59:59'
                                                                ORDER BY brg.ID,brg.TGL_CEK,brg.TGL_CEK_GB DESC", 0);
        } else if (isset($_POST["Find_KELUAR"])) {
            $dataTable = $dbcon->query("SELECT
                                                                -- BARANG MASUK
                                                                plb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCPLB,
                                                                plb.NOMOR_AJU AS NOMOR_AJU_BCPLB,
                                                                plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCPLB,
                                                                plb.PERUSAHAAN,
                                                                plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCPLB,
                                                                sts.ck5_plb_submit,
                                                                brg.TGL_CEK,
                                                                brg.OPERATOR_ONE,
                                                                rcd.bc_in,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_no_aju_plb,
                                                                -- END BARANG MASUK
                                                                -- BARANG KELUAR
                                                                tpb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCGB,
                                                                tpb.NOMOR_AJU AS NOMOR_AJU_BCGB,
                                                                tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCGB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCGB,
                                                                brg.TGL_CEK_GB,
                                                                brg.OPERATOR_TWO,
                                                                rcd.bc_out,
                                                                rcd.upload_beritaAcara_GB,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_no_aju_sarinah,
                                                                -- END BARANG KELUAR
                                                                -- GABUNGAN
                                                                rcd.rcd_id,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.JUMLAH_SATUAN,
                                                                plb.KODE_VALUTA,
                                                                brg.CIF,
                                                                brg.POS_TARIF
                                                                -- END GABUNGAN
                                                                FROM rcd_status AS rcd 
                                                                LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_header AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU
                                                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                                                                AND brg.TGL_CEK_GB BETWEEN '" . $S_KELUAR . "' AND '" . $E_KELUAR . " 23:59:59'
                                                                ORDER BY brg.ID,brg.TGL_CEK,brg.TGL_CEK_GB DESC", 0);
        } else {
            $dataTable = $dbcon->query("SELECT
                                                                -- BARANG MASUK
                                                                plb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCPLB,
                                                                plb.NOMOR_AJU AS NOMOR_AJU_BCPLB,
                                                                plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCPLB,
                                                                plb.PERUSAHAAN,
                                                                plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCPLB,
                                                                sts.ck5_plb_submit,
                                                                brg.TGL_CEK,
                                                                brg.OPERATOR_ONE,
                                                                rcd.bc_in,
                                                                rcd.upload_beritaAcara_PLB,
                                                                rcd.bm_tgl_masuk,
                                                                rcd.bm_nama_operator,
                                                                rcd.bm_no_aju_plb,
                                                                -- END BARANG MASUK
                                                                -- BARANG KELUAR
                                                                tpb.KODE_DOKUMEN_PABEAN AS KODE_DOKUMEN_PABEAN_BCGB,
                                                                tpb.NOMOR_AJU AS NOMOR_AJU_BCGB,
                                                                tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_BCGB,
                                                                tpb.NAMA_PENGUSAHA,
                                                                tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_BCGB,
                                                                brg.TGL_CEK_GB,
                                                                brg.OPERATOR_TWO,
                                                                rcd.bc_out,
                                                                rcd.upload_beritaAcara_GB,
                                                                rcd.bk_tgl_keluar,
                                                                rcd.bk_nama_operator,
                                                                rcd.bk_no_aju_sarinah,
                                                                -- END BARANG KELUAR
                                                                -- GABUNGAN
                                                                rcd.rcd_id,
                                                                brg.KODE_BARANG,
                                                                brg.URAIAN,
                                                                brg.SPESIFIKASI_LAIN,
                                                                brg.KODE_SATUAN,
                                                                brg.JUMLAH_SATUAN,
                                                                plb.KODE_VALUTA,
                                                                brg.CIF,
                                                                brg.POS_TARIF
                                                                -- END GABUNGAN
                                                                FROM rcd_status AS rcd 
                                                                LEFT OUTER JOIN plb_barang AS brg ON rcd.bm_no_aju_plb=brg.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                                LEFT OUTER JOIN tpb_header AS tpb ON rcd.bk_no_aju_sarinah=tpb.NOMOR_AJU
                                                                LEFT OUTER JOIN plb_header AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU
                                                                WHERE rcd.bk_no_aju_sarinah IS NOT NULL AND rcd.bk_tgl_keluar IS NOT NULL AND brg.STATUS_GB='Sesuai'
                                                                ORDER BY brg.ID,brg.TGL_CEK,brg.TGL_CEK_GB DESC LIMIT 100", 0);
        }

        if ($dataTable) : $no = 1;
            foreach ($dataTable as $row) :
        ?>
                <tr>
                    <td><?= $no ?>.</td>
                    <!-- BARANG MASUK -->
                    <td style="text-align: center">
                        BC <?= $row['KODE_DOKUMEN_PABEAN_BCPLB']; ?>
                    </td>
                    <td style="text-align: center">
                        <?php if ($row['NOMOR_AJU_BCPLB'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                        <?php } else { ?>
                            '<?= $row['NOMOR_AJU_BCPLB']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: center">
                        <?php if ($row['NOMOR_DAFTAR_BCPLB'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                        <?php } else { ?>
                            <?= $row['NOMOR_DAFTAR_BCPLB']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: left">
                        <div style="width: 200px;">
                            <?php if ($row['PERUSAHAAN'] == NULL) { ?>
                                <center>
                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                </center>
                            <?php } else { ?>
                                <?= $row['PERUSAHAAN']; ?>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="text-align: left">
                        <div style="width: 200px;">
                            <?php if ($row['NAMA_PENERIMA_BARANG_BCPLB'] == NULL) { ?>
                                <center>
                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                </center>
                            <?php } else { ?>
                                <?= $row['NAMA_PENERIMA_BARANG_BCPLB']; ?>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="text-align: left">
                        <div style="width: 200px;">
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
                        </div>
                    </td>
                    <td style="text-align: left">
                        <div style="width: 150px;">
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
                        </div>
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
                        <div style="width: 280px;">
                            <?= $row['URAIAN']; ?>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <?= $row['SPESIFIKASI_LAIN']; ?>
                    </td>
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
                    <td style="text-align: left">
                        <div style="width: 150px;">
                            <?php if ($row['OPERATOR_ONE'] == NULL) { ?>
                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                            <?php } else { ?>
                                <?= $row['OPERATOR_ONE']; ?>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="text-align: left">
                        <div style="width: 150px;">
                            <?php if ($row['bc_in'] == NULL) { ?>
                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                            <?php } else { ?>
                                <?= $row['bc_in']; ?>
                            <?php } ?>
                        </div>
                    </td>
                    <!-- END BARANG MASUK -->
                    <!-- BARANG KELUAR -->
                    <td style="text-align: center">
                        BC <?= $row['KODE_DOKUMEN_PABEAN_BCGB']; ?>
                    </td>
                    <td style="text-align: center">
                        <?php if ($row['NOMOR_AJU_BCGB'] == NULL) { ?>
                            <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                        <?php } else { ?>
                            '<?= $row['NOMOR_AJU_BCGB']; ?>
                        <?php } ?>
                    </td>
                    <td style="text-align: center">
                        <div style="width: 80px;">
                            <?php if ($row['NOMOR_DAFTAR_BCGB'] == NULL) { ?>
                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                            <?php } else { ?>
                                <?= $row['NOMOR_DAFTAR_BCGB']; ?>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="text-align: left">
                        <div style="width: 100px;">
                            <?php if ($row['NAMA_PENGUSAHA'] == NULL) { ?>
                                <center>
                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                </center>
                            <?php } else { ?>
                                <?= $row['NAMA_PENGUSAHA']; ?>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="text-align: left">
                        <div style="width: 200px;">
                            <?php if ($row['NAMA_PENERIMA_BARANG_BCGB'] == NULL) { ?>
                                <center>
                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                </center>
                            <?php } else { ?>
                                <?= $row['NAMA_PENERIMA_BARANG_BCGB']; ?>
                            <?php } ?>
                        </div>
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
                        <div style="width: 280px;">
                            <?= $row['URAIAN']; ?>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <?= $row['SPESIFIKASI_LAIN']; ?>
                    </td>
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
                    <td style="text-align: left">
                        <div style="width: 150px;">
                            <?php if ($row['TGL_CEK_GB'] == NULL) { ?>
                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                            <?php } else { ?>
                                <?= $row['TGL_CEK_GB']; ?>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="text-align: left">
                        <div style="width: 150px;">
                            <?php if ($row['OPERATOR_ONE'] == NULL) { ?>
                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                            <?php } else { ?>
                                <?= $row['OPERATOR_ONE']; ?>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="text-align: left">
                        <div style="width: 150px;">
                            <?php if ($row['bc_out'] == NULL) { ?>
                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                            <?php } else { ?>
                                <?= $row['bc_out']; ?>
                            <?php } ?>
                        </div>
                    </td>
                    <!-- END BARANG KELUAR -->
                </tr>
            <?php
                $no++;
            endforeach
            ?>
        <?php else : ?>
        <?php endif ?>
    </tbody>
</table>
<!-- Begin Row -->