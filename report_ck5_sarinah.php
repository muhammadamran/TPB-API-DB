<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'reportCK5Sarinah.php');
$data = json_decode($content, true);
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>BC 2.7 Gudang Berikat App Name | Company </title>
<?php } else { ?>
    <title>BC 2.7 Gudang Berikat <?= $resultSetting['company']; ?> - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-desktop icon-page"></i>
                <font class="text-page">BC 2.7 / Gudang Berikat <?= $resultSetting['company']; ?></font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Laporan</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">BC 2.7</a></li>
                <li class="breadcrumb-item active">Gudang Berikat <?= $resultSetting['company']; ?></li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i:m A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>

    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> BC 2.7 - Gudang Berikat <?= $resultSetting['company']; ?></h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="TableData" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%" style="text-align:center">#</th>
                                    <th rowspan="2" style="text-align:center">Detil</th>
                                    <th rowspan="2" style="text-align:center">Packing List</th>
                                    <th rowspan="2" style="text-align:center">Invoice</th>
                                    <th colspan="4" style="text-align:center">BC PLB</th>
                                    <th colspan="4" style="text-align:center">BC GB</th>
                                </tr>
                                <tr>
                                    <th style="text-align:center">Nomor Pengajuan</th>
                                    <th style="text-align:center">Asal</th>
                                    <th style="text-align:center">Penerima</th>
                                    <th style="text-align:center">Jumlah Barang</th>
                                    <th style="text-align:center">Nomor Pengajuan</th>
                                    <th style="text-align:center">Asal</th>
                                    <th style="text-align:center">Penerima</th>
                                    <th style="text-align:center">Jumlah Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $dataTable = $dbcon->query("SELECT *,
                                                                 plb.NOMOR_AJU AS NOMOR_AJU_PLB,plb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_PLB,plb.JUMLAH_BARANG AS JUMLAH_BARANG_PLB,
                                                                 tpb.NOMOR_AJU AS NOMOR_AJU_GB,tpb.NAMA_PENERIMA_BARANG AS NAMA_PENERIMA_BARANG_GB,tpb.JUMLAH_BARANG AS JUMLAH_BARANG_GB
                                                                 FROM rcd_status AS rcd
                                                                 LEFT OUTER JOIN plb_header AS plb ON plb.NOMOR_AJU=rcd.bm_no_aju_plb
                                                                 LEFT OUTER JOIN tpb_header AS tpb ON tpb.NOMOR_AJU=rcd.bk_no_aju_sarinah ORDER BY rcd.rcd_id DESC");
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td><?= $no ?>.</td>
                                            <td style="text-align: center;">
                                                <a href="report_ck5_sarinah_detail.php?AJU=<?= $row['NOMOR_AJU_PLB']; ?>" target="_blank" class="btn btn-primary">
                                                    <i class="fas fa-eye" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Lihat Detil <?= $row['NOMOR_AJU_PLB']; ?>"></i><br>
                                                    <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        Lihat Detil
                                                    </font>
                                                </a>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="report_ck5_sarinah_packing.php?AJU=<?= $row['NOMOR_AJU_PLB']; ?>" target="_blank" class="btn btn-success">
                                                    <i class="fa-solid fa-boxes-stacked" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Packing List <?= $row['NOMOR_AJU_PLB']; ?>"></i><br>
                                                    <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        Packing List
                                                    </font>
                                                </a>
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="report_ck5_sarinah_invoice.php?AJU=<?= $row['NOMOR_AJU_PLB']; ?>" target="_blank" class="btn btn-default">
                                                    <i class="fa-solid fa-file-invoice" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Invoice <?= $row['NOMOR_AJU_PLB']; ?>"></i><br>
                                                    <font style="font-size: 8px;display: flex;width: 55px;justify-content: center;">
                                                        Invoice
                                                    </font>
                                                </a>
                                            </td>
                                            <!-- PLB -->
                                            <td><?= $row['NOMOR_AJU_PLB']; ?></td>
                                            <td><?= $row['PERUSAHAAN']; ?></td>
                                            <td><?= $row['NAMA_PENERIMA_BARANG_PLB']; ?></td>
                                            <td style="text-align: center;"><?= $row['JUMLAH_BARANG_PLB']; ?></td>
                                            <!-- GB -->
                                            <td><?= $row['NOMOR_AJU_GB']; ?></td>
                                            <td><?= $row['NAMA_PENGUSAHA']; ?></td>
                                            <td><?= $row['NAMA_PENERIMA_BARANG_GB']; ?></td>
                                            <td style="text-align: center;"><?= $row['JUMLAH_BARANG_GB']; ?></td>
                                        </tr>
                                    <?php $no++;
                                    endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <?php include "include/creator.php"; ?>
</div>
<!-- end #content -->
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>

<script type="text/javascript">
    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UploadSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil diupload!',
            icon: 'success',
            text: 'Data berhasil diupload didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
    }
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UploadFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupload!',
            icon: 'error',
            text: 'Data gagal diupload didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
    }

    // TableData
    $(document).ready(function() {
        $('#TableData').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>