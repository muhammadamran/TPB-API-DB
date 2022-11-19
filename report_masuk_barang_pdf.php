<?php include "include/connection.php"; ?>
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
?>
<?php if (isset($_POST["Find_NP"])) { ?>
    <title>Print Laporan Barang Masuk <?= $ShowFindNoAJU; ?>_<?= date('Ymd_H:m:i') ?></title>
<?php } else if (isset($_POST["Find_RTU"])) { ?>
    <title>Print Laporan Barang Masuk <?= $ShowField_RTU; ?>_<?= date('Ymd_H:m:i') ?></title>
<?php } else if (isset($_POST["Find_RTM"])) { ?>
    <title>Print Laporan Barang Masuk <?= $ShowField_RTM; ?>_<?= date('Ymd_H:m:i') ?></title>
<?php } else { ?>
    <title>Print Laporan Barang Masuk 100 Data Terakhir_<?= date('Ymd_H:m:i') ?></title>
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
                    <div class="col-md-9" style="display: grid;justify-content: left;margin-bottom:-30px">
                        <font style="font-size: 24px;font-weight: 800;">LAPORAN PEMASUKAN BARANG PER DOKUMEN
                            PABEAN</font>
                        <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                        <font style="font-size: 14px;font-weight: 800;">
                            <?= $ShowFindNoAJU; ?>
                            <?= $ShowField_RTU; ?>
                            <?= $ShowField_RTM; ?>
                        </font>
                        <font style="font-size: 18px;font-weight: 800;"><?= $resultHeadSetting['company_t'] ?></font>
                        <font style="font-size: 14px;font-weight: 400;"><i class="fa-solid fa-location-dot"></i> <?= $resultHeadSetting['address'] ?>
                        </font>
                    </div>
                </div>
                <div class="panel-body text-inverse">
                    <table class="table table-bordered table-td-valign-middle">
                        <thead style="background: #dadddf;color: #333;">
                            <tr style="background: #dadddf;color: #333;">
                                <th rowspan="2" width="1%">No.</th>
                                <th colspan="5" style="text-align: center;">Dokumen Pabean BC 2.7 PLB</th>
                                <th colspan="2" style="text-align: center;">Tanggal & Waktu</th>
                                <th rowspan="2" style="text-align: center;">KD.<font style="color: transparent;">.</font>Barang</th>
                                <th rowspan="2" style="text-align: center;">Uraian</th>
                                <th rowspan="2" style="text-align: center;">Spe.<font style="color: transparent;">.</font>Lain</th>
                                <th rowspan="2" style="text-align: center;">Jml.<font style="color: transparent;">.</font>Satuan</th>
                                <th rowspan="2" style="text-align: center;">Nilai<font style="color: transparent;">.</font>Barang</th>
                                <th colspan="2" style="text-align: center;">Petugas</th>
                            </tr>
                            <tr>
                                <th class="no-sort" style="text-align: center;">Jen.<font style="color: transparent;">.</font>Dok.</th>
                                <th style="text-align: center;">Nomor Pengajuan</th>
                                <th style="text-align: center;">No.<font style="color: transparent;">.</font>Daftar</th>
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
                                $dataTable = $dbcon->query("SELECT * FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            AND rcd.bm_no_aju_plb LIKE '%" . $FindNoAJU . "%'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC", 0);
                            } else if (isset($_POST["Find_RTU"])) {
                                $dataTable = $dbcon->query("SELECT * FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            AND sts.ck5_plb_submit BETWEEN '" . $S_RTU . "' AND '" . $E_RTU . " 23:59:59'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC", 0);
                            } else if (isset($_POST["Find_RTM"])) {
                                $dataTable = $dbcon->query("SELECT * FROM rcd_status AS rcd 
                                                            LEFT OUTER JOIN plb_barang AS plb ON rcd.bm_no_aju_plb=plb.NOMOR_AJU 
                                                            LEFT OUTER JOIN plb_status AS sts ON rcd.bm_no_aju_plb=sts.NOMOR_AJU_PLB
                                                            LEFT OUTER JOIN plb_header AS hdr ON rcd.bm_no_aju_plb=hdr.NOMOR_AJU
                                                            WHERE rcd.bk_no_aju_sarinah IS NOT NULL
                                                            AND plb.TGL_CEK BETWEEN '" . $S_RTM . "' AND '" . $E_RTM . " 23:59:59'
                                                            ORDER BY hdr.ID,plb.ID,plb.TGL_CEK DESC", 0);
                            } else {
                                $dataTable = $dbcon->query("SELECT * FROM rcd_status AS rcd 
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
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                            <?php } else { ?>
                                                <?= $row['NOMOR_AJU']; ?>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php if ($row['NOMOR_DAFTAR'] == NULL) { ?>
                                                <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                            <?php } else { ?>
                                                <?= $row['NOMOR_DAFTAR']; ?>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: left">
                                            <?php if ($row['PERUSAHAAN'] == NULL) { ?>
                                                <center>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
                                                </center>
                                            <?php } else { ?>
                                                <?= $row['PERUSAHAAN']; ?>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: left">
                                            <?php if ($row['NAMA_PENERIMA_BARANG'] == NULL) { ?>
                                                <center>
                                                    <font style="font-size: 8px;font-weight: 600;color: red"><i>Data Kosong!</i></font>
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
                                            <?= $KDBRG ?>
                                        </td>
                                        <td>
                                            <?= $row['URAIAN']; ?>
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
                    <hr>
                    <div class="invoice-footer">
                        <p class="text-center m-b-5 f-w-600">
                            Laporan Barang Masuk | IT Inventory <?= $resultHeadSetting['company'] ?>
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