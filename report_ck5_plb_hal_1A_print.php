<!-- QUERY -->
<?php
include "include/connection.php";
// include "include/restrict.php";

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
    <title>Laporan BC 2.7 PLB - Halaman 1A</title>
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
    <link href="assets/css/ck5plb.css" rel="stylesheet" />
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
<style type="text/css">
    .nav-top-content {
        padding: 20px;
        margin-top: 30px;
    }

    @media (max-width: 767.5px) {
        .nav-top-content {
            padding: 20px;
            margin-top: 0px;
        }
    }

    .for-area-one {
        border: transparent;
        height: 90px;
        width: 325px;
    }

    .for-area-one-oke {
        /*border: transparent;*/
        height: 90px;
        width: 325px;
    }

    .for-area-two {
        border: transparent;
        height: 90px;
        width: 400px;
    }

    @media (max-width: 1366.5px) {
        .for-area-one {
            border: transparent;
            height: 110px;
            width: 260px;
        }

        .for-area-one-oke {
            /*border: transparent;*/
            height: 110px;
            width: 260px;
        }

        .for-area-two {
            border: transparent;
            height: 110px;
            width: 310px;
        }
    }

    .area-big {
        border: transparent;
        width: 130px;
    }

    @media (max-width: 1156.5px) {
        .area-big {
            border: transparent;
            width: 88px;
        }
    }

    label {
        font-size: 12px;
    }

    div.table-responsive>div.dataTables_wrapper>div.row {
        margin: 0;
        font-size: 12px;
    }
</style>

<body>
    <div class="invoice">
        <div class="invoice-content">
            <!-- <div class="table-responsive"> -->
            <table border=0 cellpadding=0 cellspacing=0 width=695 class=xl6912727 style='border-collapse:collapse;table-layout:fixed;width:100%'>
                <col class=xl6912727 width=64 span=8 style='width:48pt'>
                <col class=xl6912727 width=15 style='mso-width-source:userset;mso-width-alt:548;width:11pt'>
                <col class=xl6912727 width=168 style='mso-width-source:userset;mso-width-alt:6144;width:126pt'>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7312727 colspan=10 width=695 style='height:14.25pt;border-right:.5pt solid black;width:521pt;text-transform: uppercase;font-weight: 800'><a name="RANGE!A1:J78">I. CATATAN HASIL PEMERIKSAAN / PENYEGELAN BKC YANG AKAN DIKELUARKAN :</a></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'><br>Pengusaha/Pejabat Bea dan Cukai</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727><span style='mso-spacerun:yes'></span></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>Nama</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=4 style='height:14.25pt'>Penyegelan dilakukan terhadap :</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>N.I.P</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8412727 colspan=3 style='height:14.25pt'>Jenis dan Nomor Segel :</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl8512727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8612727 colspan=6 style='height:14.25pt;text-transform: uppercase;font-weight: 800'>J. CATATAN HASIL PEMERIKSAAN / PENGELUARAN :</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>(Disegel / Tidak disegel *)</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>(Sesuai / Tidak Sesuai *)</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Tempat, Tanggal Pemeriksaan</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Pengusaha/Pejabat Bea dan Cukai</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl8212727></td>
                    <td class=xl8212727></td>
                    <td class=xl8312727>&nbsp;</td>
                </tr>
                <tr height=6 style='mso-height-source:userset;height:4.5pt'>
                    <td height=6 class=xl7612727 style='height:4.5pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>Jenis Alat Angkut<span style='mso-spacerun:yes'></span>:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>Nama</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>Nomor Polisi<span style='mso-spacerun:yes'></span>:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>N.I.P</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8412727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl8512727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8612727 colspan=10 style='height:14.25pt;border-right:.5pt solid black;text-transform: uppercase;font-weight: 800'>K. CATATAN HASIL PEMERIKSAAN PEMASUKAN BKC DI TEMPAT TUJUAN/TEMPAT PENIMBUNAN TERAKHIR :</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=5 style='height:14.25pt'>Sesuai / Tidak Sesuai karena*) ???????????????.</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'><br>Tempat, Tanggal Pemeriksaan</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Pengusaha/Pejabat Bea dan Cukai</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>Nama</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>N.I.P</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8412727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl8512727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8612727 colspan=10 style='height:14.25pt;border-right:.5pt solid black;text-transform: uppercase;font-weight: 800'>N. CATATAN BENDAHARAWAN KPPBC YANG MENGAWASI TEMPAT TUJUAN / PELABUHAN MUAT :</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=5 style='height:14.25pt'>Sesuai / Tidak Sesuai karena*) ???????????????.</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:25.25pt'>
                    <td class=xl7112727 colspan=10 style="border-right: 0.5pt solid black;border-left: 0.5pt solid black;"></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=4 style='height:14.25pt'>Nomor Buku Pengawasan<span style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Tempat, Tanggal Pemeriksaan</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 colspan=3 style='height:14.25pt'>Nomor Surat Pengantar<span style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'>Pengusaha/Pejabat Bea dan Cukai</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>Tanggal<span style='mso-spacerun:yes'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727 colspan=2></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl8212727></td>
                    <td class=xl8212727></td>
                    <td class=xl8312727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td colspan=3 class=xl8212727 style='border-right:.5pt solid black'></td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl7612727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727>Nama</td>
                    <td class=xl6912727>:</td>
                    <td class=xl7712727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl8712727 style='height:14.25pt'>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>&nbsp;</td>
                    <td class=xl7012727>N.I.P</td>
                    <td class=xl7012727>:</td>
                    <td class=xl8512727>&nbsp;</td>
                </tr>
                <tr height=19 style='height:14.25pt'>
                    <td height=19 class=xl6812727 colspan=3 style='height:14.25pt'>*)<span style='mso-spacerun:yes'></span>Coret yang tidak perlu</td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                    <td class=xl6912727></td>
                </tr>
                <tr height=0 style='display:none'>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=64 style='width:48pt'></td>
                    <td width=15 style='width:11pt'></td>
                    <td width=168 style='width:126pt'></td>
                </tr>
            </table>
            <!-- </div> -->
        </div>
    </div>
    <?php
    // include "include/panel.php"; 
    ?>
    <!-- <script src="assets/js/app.min.js"></script> -->
    <script src="assets/js/theme/default.min.js"></script>
    <script src="assets/plugins/d3/d3.min.js"></script>
    <script src="assets/plugins/nvd3/build/nv.d3.js"></script>
    <script src="assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
    <script src="assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
    <script src="assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
    <script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
    <script>
        // Show and Hidden
        $(function() {
            $("#IDJenisBarangKenaCukai").change(function() {
                if ($(this).val() == 4) {
                    $("#OthersJenisBarangKenaCukai").show();
                } else {
                    $("#OthersJenisBarangKenaCukai").hide();
                }
            });
        });
        $(function() {
            $("#IDJenisPemberitahuan").change(function() {
                if ($(this).val() == 4) {
                    $("#OthersJenisPemberitahuan").show();
                } else {
                    $("#OthersJenisPemberitahuan").hide();
                }
            });
        });
        // IDNamaKodeNegaraTujuan
        $(function() {
            $("#IDNamaKodeNegaraTujuan").change(function() {
                if ($(this).val() == 'NPPBKC') {
                    $("#IdentitasTwoNPPBKC").show();
                    $("#IdentitasTwoNPP").hide();
                } else if ($(this).val() == 'NPP') {
                    $("#IdentitasTwoNPPBKC").hide();
                    $("#IdentitasTwoNPP").show();
                } else {
                    $("#IdentitasTwoNPPBKC").hide();
                    $("#IdentitasTwoNPP").hide();
                }
            });
        });
        // show-address-identitas-two
        function showAddress(c_str) {
            if (c_str == "") {
                document.getElementById("show-address-identitas-two").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("show-address-identitas-two").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "function/function_get.php/get_c_client?c_id=" + c_str, true);
            xmlhttp.send();
        }

        // showKodeOne
        function showKodeOne(kode_one) {
            if (kode_one == "") {
                document.getElementById("InputshowKodeOne").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("InputshowKodeOne").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "function/function_get.php/get_kode_one?c_kode_one=" + kode_one, true);
            xmlhttp.send();
        }
        // showKodeTwo
        function showKodeTwo(kode_two) {
            if (kode_two == "") {
                document.getElementById("InputshowKodeTwo").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("InputshowKodeTwo").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "function/function_get.php/get_kode_two?c_kode_two=" + kode_two, true);
            xmlhttp.send();
        }
        // showKodeThree
        function showKodeThree(kode_three) {
            if (kode_three == "") {
                document.getElementById("InputshowKodeThree").innerHTML = "";
                return;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("InputshowKodeThree").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "function/function_get.php/get_kode_three?c_kode_three=" + kode_three, true);
            xmlhttp.send();
        }
        // Show and Hide
        $(function() {
            $("#IDJaminan").change(function() {
                if ($(this).val() == 4) {
                    $("#OthersJaminan").show();
                } else {
                    $("#OthersJaminan").hide();
                }
            });
        });
    </script>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>