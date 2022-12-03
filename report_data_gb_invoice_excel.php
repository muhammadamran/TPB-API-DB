<?php
include "include/connection.php";
include "include/restrict.php";
date_default_timezone_set("Asia/Bangkok");
$GB = $_GET['GB'];
$datenow = date('d-m-Y h-i-s');
header("Content-Disposition: attachment; filename=Laporan Invoice $GB-$datenow.xls");
?>
<?php
// DATE DAFULT
date_default_timezone_set("Asia/jakarta");
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

// RUPIAH
function Rupiah($angka)
{
    $hasil = "Rp. " . number_format($angka, 2, ',', '.');
    return $hasil;
}

// DECIMAL
function decimal($number)
{
    $hasil = number_format($number, 0, ",", ",");
    return $hasil;
}

// NPWP
function NPWP($value)
{
    // 12.345.678.9-012.345
    $hasil = number_format($value, 0, ',', '.');
    return $hasil;
}
?>
<?php
// DATA HEADER
$dataHeader = $dbcon->query("SELECT *,
                            SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU,
                            -- PLB
                            plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                            plb.NOMOR_DAFTAR AS NOMOR_DAFTAR_PLB,
                            plb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_PLB,
                            plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                            plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                            plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                            plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                            plb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                            -- TPB
                            tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                            tpb.NOMOR_DAFTAR AS NOMOR_DAFTAR_GB,
                            tpb.TANGGAL_DAFTAR AS TANGGAL_DAFTAR_GB,
                            tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                            tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                            tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                            tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB,
                            tpb.NUMBER AS NUMBER_GB,
                            tpb.TGL_NUMBER AS TGL_NUMBER_GB,
                            tpb.NO_BL AS NO_BL_GB,
                            tpb.TGL_NO_BL AS TGL_NO_BL_GB,
                            tpb.WEIGHT,
                            tpb.WEIGHT_S,
                            tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                            ngr.URAIAN_NEGARA
                            FROM rcd_status AS rcd
                            LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                            LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                            LEFT OUTER JOIN referensi_negara AS ngr ON tpb.KODE_NEGARA_PEMASOK=ngr.KODE_NEGARA
                            WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "'
                            ORDER BY rcd.rcd_id DESC");
$resultdataHeader = mysqli_fetch_array($dataHeader);

$dataTPBH = $dbcon->query("SELECT ID FROM tpb_header WHERE NOMOR_AJU='" . $resultdataHeader['NOMOR_AJU_GB'] . "'");
$resultdataTPBH = mysqli_fetch_array($dataTPBH);
$IDHEADER = $resultdataTPBH['ID'];
?>
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
            <td colspan="4" rowspan="2" width="579" style="font-size: 18px;font-weight: 900;">Laporan Data Gudang Berikat</td>
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
            <td colspan="2" width="175">
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="8" width="981" style="font-size: 14px;font-weight: 900;">
                <font style="font-size: 12px;font-weight: 800;">No. Pengajuan PLB: <?= $resultdataHeader['NOMOR_AJU_PLB']; ?></font>
                <br>
                <font style="font-size: 12px;font-weight: 800;">No. Pengajuan GB: <?= $resultdataHeader['NOMOR_AJU_GB']; ?></font>
            </td>
            <td colspan="2" width="175"> </td>
        </tr>
        <tr>
            <td colspan="8" width="981" style="font-size: 16px;font-weight: 900;"><?= $resultHeadSetting['company'] ?> - <?= $resultHeadSetting['company_t'] ?></td>
            <td colspan="2" width="175"> </td>
        </tr>
        <tr>
            <td colspan="8" width="981" style="font-size: 12px;font-weight: 300;"><?= $resultHeadSetting['address'] ?></td>
            <td width="85">&nbsp;</td>
            <td width="90">&nbsp;</td>
        </tr>
    </tbody>
</table>
<br>
<table width="811">
    <tbody>
        <tr>
            <td colspan="9" rowspan="3" width="747"><span style="color: #404040; font-family: Arial Black; font-size: xx-large;">INVOICE</span></td>
            <td width="64" style="font-size: 12px;font-weight: 900;"><?= $resultHeadSetting['app_name']; ?></td>
        </tr>
        <tr>
            <td style="font-size: 12px;font-weight: 900;">Print By: <?= $_SESSION['username']; ?></td>
        </tr>
        <tr>
            <td style="font-size: 12px;font-weight: 900;">Date Time: <?= date_indo_s(date('Y-m-d'), TRUE) ?> <?= date('H:m:i') ?></td>
        </tr>
    </tbody>
</table>

<!-- LINE -->
<table style="height: 36px;" width="1548">
    <tbody>
        <tr style="height: 18px;">
            <td style="border-bottom: 1px solid #333;" colspan="11">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
            <td style="border-style: none; height: 18px; width: 1541px;" colspan="11">&nbsp;</td>
        </tr>
    </tbody>
</table>
<!-- END LINE -->
<table style="width: 546px;" width="623">
    <tbody>
        <tr>
            <td style="width: 75.625px;">
                <p><strong>DUTY-FREE NAME</strong></p>
            </td>
            <td style="width: 72.7148px;">
                <p>: <?= $resultdataHeader['NAMA_PENERIMA_BARANG_GB']; ?></p>
            </td>
            <td style="width: 121.25px;" colspan="4" rowspan="6">
                <p>&nbsp;</p>
            </td>
            <td style="width: 82.4219px;">
                <p><strong>NUMBER</strong></p>
            </td>
            <td style="width: 83.2031px;" colspan="2">
                <p>: <?= $resultdataHeader['NUMBER_GB']; ?></p>
            </td>
            <td style="width: 72.5781px;">
                <p>
                    <?php if ($resultdataHeader['TGL_NUMBER_GB'] != NULL) { ?>
                        <?= date_indo($resultdataHeader['TGL_NUMBER_GB']); ?>
                    <?php } ?>
                </p>
            </td>
        </tr>
        <tr>
            <td style="width: 75.625px;">
                <p><strong>NPWP</strong></p>
            </td>
            <td style="width: 72.7148px;">
                <p>: <?= NPWP($resultdataHeader['ID_PENERIMA_BARANG_GB']); ?></p>
            </td>
            <td style="width: 82.4219px;">
                <p><strong>EX BILL OF LADING</strong></p>
            </td>
            <td style="width: 83.2031px;" colspan="2">
                <p>:
                    <?php
                    // PLB
                    $NoBLQuery = $dbcon->query("SELECT dok.ID_HEADER,dok.NOMOR_DOKUMEN,dok.TANGGAL_DOKUMEN,
                                                        ref.URAIAN_DOKUMEN
                                                        FROM tpb_dokumen AS dok 
                                                        LEFT OUTER JOIN referensi_dokumen AS ref ON ref.KODE_DOKUMEN=dok.KODE_JENIS_DOKUMEN
                                                        WHERE dok.ID_HEADER='" . $IDHEADER . "' AND ref.KODE_DOKUMEN='705' ORDER BY dok.ID DESC LIMIT 1");
                    $resultNoBLQuery = mysqli_fetch_array($NoBLQuery);
                    ?>
                    <?= $resultNoBLQuery['NOMOR_DOKUMEN'] ?>
                    <font style="font-size: 8px;">(<?= $resultNoBLQuery['URAIAN_DOKUMEN'] ?>)</font>
                </p>
            </td>
            <td style="width: 72.5781px;">
                <p><?= $resultNoBLQuery['TANGGAL_DOKUMEN'] ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 75.625px;" rowspan="4">
                <p><strong>STREET ADDRESS</strong></p>
            </td>
            <td style="width: 72.7148px;" rowspan="4">
                <p>: <?= $resultdataHeader['ALAMAT_PENERIMA_BARANG_GB']; ?></p>
            </td>
            <td style="width: 82.4219px;">
                <p><strong>NO. INVOICE</strong></p>
            </td>
            <td style="width: 83.2031px;" colspan="2">
                <p>:
                    <?php
                    // PLB
                    $dataNoDokumen = $dbcon->query("SELECT 
                                                    dok.ID_HEADER,dok.NOMOR_DOKUMEN,dok.TANGGAL_DOKUMEN,
                                                    ref.URAIAN_DOKUMEN
                                                    FROM tpb_dokumen AS dok 
                                                    LEFT OUTER JOIN referensi_dokumen AS ref ON ref.KODE_DOKUMEN=dok.KODE_JENIS_DOKUMEN
                                                    WHERE dok.ID_HEADER='" . $IDHEADER . "' AND ref.KODE_DOKUMEN='380' ORDER BY dok.ID DESC LIMIT 1");
                    $resultdataNoDokumen = mysqli_fetch_array($dataNoDokumen);
                    ?>
                    <?= $resultdataNoDokumen['NOMOR_DOKUMEN'] ?>
                    <font style="font-size: 8px;">(<?= $resultdataNoDokumen['URAIAN_DOKUMEN'] ?>)</font>
                </p>
            </td>
            <td style="width: 72.5781px;">
                <p><?= $resultdataNoDokumen['TANGGAL_DOKUMEN'] ?></p>
            </td>
        </tr>
        <tr>
            <td style="width: 82.4219px;">
                <p><strong>WEIGHT</strong></p>
            </td>
            <td style="width: 83.2031px;" colspan="2">
                <p>: <?= decimal($resultdataHeader['WEIGHT']); ?> <?= $resultdataHeader['WEIGHT_S']; ?></p>
            </td>
            <td style="width: 72.5781px;">
                <p></p>
            </td>
        </tr>
        <tr>
            <td style="width: 82.4219px;">
                <p><strong>ORIGINAL</strong></p>
            </td>
            <td style="width: 83.2031px;" colspan="2">
                <p>: <?= $resultdataHeader['URAIAN_NEGARA']; ?></p>
            </td>
            <td style="width: 72.5781px;">
                <p></p>
            </td>
        </tr>
        <tr>
            <td style="width: 82.4219px;">
                <p><strong>NO. DAFTAR</strong></p>
            </td>
            <td style="width: 83.2031px;" colspan="2">
                <?php if ($resultdataHeader['TANGGAL_DAFTAR_GB'] == NULL) { ?>
                    <p>: -</p>
                <?php } else { ?>
                    <p>: <?= substr($resultdataHeader['NOMOR_DAFTAR_GB'], 20, 27); ?></p>
                <?php } ?>
            </td>
            <td style="width: 72.5781px;">
                <?php if ($resultdataHeader['TANGGAL_DAFTAR_GB'] == NULL) { ?>
                    <p>-</p>
                <?php } else { ?>
                    <p>
                        <?php
                        $dataTGLDAFTAR = $resultdataHeader['TANGGAL_DAFTAR_GB'];
                        $dataTGLDAFTARY = substr($dataTGLDAFTAR, 0, 4);
                        $dataTGLDAFTARM = substr($dataTGLDAFTAR, 4, 2);
                        $dataTGLDAFTARD =  substr($dataTGLDAFTAR, 6, 2);

                        $datTGLDAFTAR = $dataTGLDAFTARY . '-' . $dataTGLDAFTARM . '-' . $dataTGLDAFTARD;
                        ?>
                        <?= date_indo($datTGLDAFTAR); ?>
                    </p>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td style="width: 75.625px;">&nbsp;</td>
            <td style="width: 72.7148px;">&nbsp;</td>
            <td style="width: 18.8867px;">&nbsp;</td>
            <td style="width: 18.1055px;">&nbsp;</td>
            <td style="width: 18.8867px;">&nbsp;</td>
            <td style="width: 48.1445px;">&nbsp;</td>
            <td style="width: 82.4219px;">&nbsp;</td>
            <td style="width: 28.1445px;">&nbsp;</td>
            <td style="width: 49.3164px;">&nbsp;</td>
            <td style="width: 72.5781px;">&nbsp;</td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered table-td-valign-middle" border="1">
    <thead>
        <tr>
            <th rowspan="2" width="1%">NO.</th>
            <th rowspan="2" style="text-align:center">DESCRIPTION</th>
            <th rowspan="2" colspan="4" style="text-align:center">QUANTITY</th>
            <th rowspan="2" style="text-align:center">PRICE</th>
            <th colspan="4" style="text-align:center">REMARKS</th>
        </tr>
        <tr>
            <th style="text-align:center">Pack(s)</th>
            <th style="text-align:center">Can(s)</th>
            <th style="text-align:center">Bottle</th>
            <th style="text-align:center">Litre(s)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $dataTable = $dbcon->query("SELECT *,
                                                    SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU,
                                                    -- PLB
                                                    plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                                                    plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                                                    plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                                                    plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                                                    plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                                                    plb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                                                    plb.KODE_VALUTA,
                                                    -- TPB
                                                    tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                                                    tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                    tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                    tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                                                    tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB,
                                                    tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                                                    ngr.URAIAN_NEGARA
                                                    FROM rcd_status AS rcd
                                                    LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                                    LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                    LEFT OUTER JOIN plb_barang AS brg ON plb.NOMOR_AJU=brg.NOMOR_AJU
                                                    LEFT OUTER JOIN referensi_negara AS ngr ON tpb.KODE_NEGARA_PEMASOK=ngr.KODE_NEGARA
                                                    WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "'
                                                    ORDER BY brg.ID,brg.SERI_BARANG ASC");
        if ($dataTable) : $no = 1;
            foreach ($dataTable as $row) :
        ?>
                <tr>
                    <td><?= $no ?>.</td>
                    <td><?= $row['URAIAN']; ?></td>
                    <td style="text-align: center;"><?= $row['BOTOL']; ?></td>
                    <td style="text-align: center;">x</td>
                    <td style="text-align: center;"><?= $row['LITER']; ?></td>
                    <td style="text-align: right;"><?= $row['TOTAL_CT_AKHIR']; ?> Ctn(s)</td>
                    <td style="text-align: center;">
                        <div style="display: flex;justify-content: space-evenly;align-items:center">
                            <font><?= $row['KODE_VALUTA']; ?></font>
                            <font><?= $row['CIF']; ?></font>
                        </div>
                    </td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: right;"><?= $row['TOTAL_BOTOL_AKHIR']; ?> Btl(s)</td>
                    <td style="text-align: right;"><?= $row['TOTAL_LITER_AKHIR']; ?> Ltr(s)</td>
                </tr>
            <?php
                $no++;
            endforeach
            ?>
        <?php else : ?>
            <tr>
                <td colspan="11">
                    <center>
                        <div style="display: grid;">
                            <i class="far fa-times-circle no-data"></i> Tidak ada data
                        </div>
                    </center>
                </td>
            </tr>
        <?php endif ?>
    </tbody>
    <tfoot>
        <?php
        $dataFooter = $dbcon->query("SELECT *,
                                                    SUBSTR(tpb.NOMOR_AJU,13,8) AS TGL_AJU,
                                                    -- PLB
                                                    plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                                                    plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                                                    plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                                                    plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                                                    plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                                                    plb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_PLB,
                                                    plb.KODE_VALUTA AS KODE_NEGARA_PEMASOK_PLB,
                                                    -- TPB
                                                    tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                                                    tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                                                    tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                                                    tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                                                    tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB,
                                                    tpb.KODE_NEGARA_PEMASOK AS KODE_NEGARA_PEMASOK_GB,
                                                    ngr.URAIAN_NEGARA,
                                                    (SELECT SUM(BOTOL) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_botol,
                                                    (SELECT SUM(LITER) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_liter,
                                                    (SELECT SUM(TOTAL_CT_AKHIR) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_ct,
                                                    (SELECT SUM(CIF) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_cif,
                                                    (SELECT SUM(TOTAL_BOTOL_AKHIR) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_botol_akhir,
                                                    (SELECT SUM(TOTAL_LITER_AKHIR) FROM plb_barang WHERE NOMOR_AJU='" . $_GET['AJU'] . "') AS c_liter_akhir
                                                    FROM rcd_status AS rcd
                                                    LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                                    LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah
                                                    LEFT OUTER JOIN plb_barang AS brg ON plb.NOMOR_AJU=brg.NOMOR_AJU
                                                    LEFT OUTER JOIN referensi_negara AS ngr ON tpb.KODE_NEGARA_PEMASOK=ngr.KODE_NEGARA
                                                    WHERE plb.NOMOR_AJU='" . $_GET['AJU'] . "'
                                                    ORDER BY brg.ID,brg.SERI_BARANG ASC");
        $resultFooter = mysqli_fetch_array($dataFooter);
        ?>
        <tr>
            <th colspan="2" style="text-align:center">TOTAL</th>
            <th style="text-align:center"><?= $resultFooter['c_botol']; ?></th>
            <th style="text-align:center">x</th>
            <th style="text-align:center"><?= round($resultFooter['c_liter']); ?></th>
            <th style="text-align:right"><?= $resultFooter['c_ct']; ?> Ctn(s)</th>
            <th style="text-align:center">
                <div style="display: flex;justify-content: space-evenly;align-items:center">
                    <font><?= $resultFooter['KODE_VALUTA']; ?></font>
                    <font><?= round($resultFooter['c_cif']); ?></font>
                </div>
            </th>
            <th colspan="2" style="text-align:left"></th>
            <th style="text-align:right"><?= $resultFooter['c_botol_akhir']; ?> Btl(s)</th>
            <th style="text-align:right"><?= round($resultFooter['c_liter_akhir']); ?> Ltr(s)</th>
        </tr>
    </tfoot>
</table>