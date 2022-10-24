<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
// API - 
include "include/api.php";
$content = get_content($resultAPI['url_api'] . 'dataBC40.php');
$data = json_decode($content, true);
?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-passport icon-page"></i>
                <font class="text-page">BC Master</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">View Data Online</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">BC Master</a></li>
                <li class="breadcrumb-item active">BC 4.0</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> BC 4.0 / Master Data</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <div class="table-responsive">
                        <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="1%">#</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Nomor Pengajuan</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Pemasok</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Pengangkut</th>
                                    <th class="text-nowrap" colspan="3" style="text-align: center;">Jumlah</th>
                                    <th class="text-nowrap" rowspan="2" style="text-align: center;">Status</th>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" style="text-align: center;">Barang</th>
                                    <th class="text-nowrap" style="text-align: center;">Kontainer</th>
                                    <th class="text-nowrap" style="text-align: center;">Kemasan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['status'] == 404) { ?>
                                    <tr>
                                        <td colspan="8">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <?php $no = 0; ?>
                                    <?php foreach ($data['result'] as $row) { ?>
                                        <?php $no++ ?>
                                        <tr>
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center;"><?= $row['NOMOR_AJU'] ?></td>
                                            <td style="text-align: center;"><?= $row['NAMA_PEMASOK'] ?></td>
                                            <td style="text-align: center;"><?= $row['NAMA_PENGANGKUT'] ?></td>
                                            <td style="text-align: center;"><?= $row['JUMLAH_BARANG'] ?></td>
                                            <td style="text-align: center;"><?= $row['JUMLAH_KONTAINER'] ?></td>
                                            <td style="text-align: center;"><?= $row['JUMLAH_KEMASAN'] ?></td>
                                            <td style="text-align: center;"><?= $row['URAIAN_STATUS'] ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
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