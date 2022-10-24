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
$content = get_content($resultAPI['url_api'] . 'refPemasok.php');
$data = json_decode($content, true);
?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-book icon-page"></i>
                <font class="text-page">Referensi</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">View Data Online</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Referensi</a></li>
                <li class="breadcrumb-item active">Pemasok</li>
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
            <div class="panel panel-inverse" data-sortable-id="ui-pemasok">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Referensi] Pemasok</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <table id="data-table-buttons" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th style="text-align:center">#</th>
                                <th style="text-align:center">Nama</th>
                                <th style="text-align:center">Alamat</th>
                                <th style="text-align:center">Negara</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($data['status'] == 404) { ?>
                            <tr>
                                <td colspan="4">
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
                                <td><?= $no ?>.</td>
                                <td><?= $row['NAMA']; ?></td>
                                <td><?= $row['ALAMAT']; ?></td>
                                <td><?= $row['URAIAN_NEGARA']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
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