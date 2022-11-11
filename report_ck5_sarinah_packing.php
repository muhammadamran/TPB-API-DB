<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Laporan Packing List App Name | Company </title>
<?php } else { ?>
    <title>Laporan Packing List <?= $_GET['AJU']; ?> <?= $resultSetting['company']; ?> - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<?php
// DATA HEADER
$dataHeader = $dbcon->query("SELECT *,
                            -- PLB
                            plb.NOMOR_AJU AS NOMOR_AJU_PLB,
                            plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,
                            plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                            plb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_PLB,
                            plb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_PLB,
                            -- TPB
                            tpb.NOMOR_AJU AS NOMOR_AJU_GB,
                            tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,
                            tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB,
                            tpb.ID_PENERIMA_BARANG AS ID_PENERIMA_BARANG_GB,
                            tpb.ALAMAT_PENERIMA_BARANG AS ALAMAT_PENERIMA_BARANG_GB
                            FROM rcd_status AS rcd
                            LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                            LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah ORDER BY rcd.rcd_id DESC");
$resultdataHeader = mysqli_fetch_array($dataHeader);
?>
<div id="content" class="nav-top-content">
    <div class="invoice">
        <div class="line-page-table-n"></div>
        <div class="row" style="display: flex;align-items: center;margin-bottom: -5px;">
            <div class="col-md-3">
                <div style="display: flex;justify-content: center;">
                    <?php if ($resultHeadSetting['logo'] == NULL) { ?>
                        <img src="assets/images/logo/logo-default.png" width="30%">
                    <?php } else { ?>
                        <img src="assets/images/logo/<?= $resultHeadSetting['logo'] ?>" width="50%">
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-9">
                <div style="display: grid;">
                    <font style="font-size: 24px;font-weight: 800;">Laporan - Packing List</font>
                    <font style="font-size: 18px;font-weight: 800;">No. Pengajuan: <?= $_GET['AJU']; ?></font>
                    <font style="font-size: 24px;font-weight: 800;"><?= $resultHeadSetting['company'] ?></font>
                    <div class="line-page-table"></div>
                    <font style="font-size: 14px;font-weight: 400;"><?= $resultHeadSetting['address'] ?></font>
                </div>
            </div>
        </div>
        <br>
        <i class="ri-test-tube-fill"></i>
        <div class="invoice-content" style="font-size: 14px;">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered first" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="text-align:center">Description</th>
                            <th style="text-align:center">SKU</th>
                            <th style="text-align:center">Details</th>
                            <th style="text-align:center">Quantity</th>
                            <th style="text-align:center">Bottle</th>
                            <th style="text-align:center">Litre(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $no ?>.</td>
                            <td><?= $row['URAIAN']; ?></td>
                            <td><?= $row['KODE_BARANG']; ?></td>
                            <td><?= $row['UKURAN']; ?></td>
                            <td><?= $row['JUMLAH_SATUAN']; ?></td>
                            <?php $bottleqty = $row['UKURAN'] * $row['JUMLAH_SATUAN']; ?>
                            <td><?= $bottleqty; ?></td>
                            <td><?= $bottleqty; ?></td>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>TOTAL</td>
                            <td><b><?= $rowx['TotalQty']; ?></b></td>
                            <td><b><?= $row3['TotalBottle']; ?></b></td>
                            <td><b><?= $row5['TotalLitre']; ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
                Export CK5 Sarinah | IT Inventory <?= $resultHeadSetting['company'] ?>
            </p>
            <p class="text-center">
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>
                    <?= $resultHeadSetting['website'] ?></span>
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i>
                    T:<?= $resultHeadSetting['telp'] ?></span>
                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                    <?= $resultHeadSetting['email'] ?></span>
            </p>
        </div>
    </div>
</div>
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>