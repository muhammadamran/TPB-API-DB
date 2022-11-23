<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/sidebar.php";
include "include/cssDatatables.php";
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>Pemasok App Name | Company </title>
<?php } else { ?>
    <title>Pemasok - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-asterisk icon-page"></i>
                <font class="text-page">Referensi</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">Data Online</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Referensi</a></li>
                <li class="breadcrumb-item active">Pemasok</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i A') ?></span></button>
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
                                <th width="1%">No.</th>
                                <th style="text-align:center">Nama</th>
                                <th style="text-align:center">Alamat</th>
                                <th style="text-align:center">Negara</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result2 = mysqli_query($dbcon, "SELECT * FROM referensi_pemasok AS a
                                                             JOIN referensi_negara AS b ON a.KODE_NEGARA=b.KODE_NEGARA ");
                            if (mysqli_num_rows($result2) > 0) {
                                $no = 0;
                                while ($row2 = mysqli_fetch_array($result2)) {
                                    $no++;
                                    echo "<tr>";
                                    echo "<td>" . $no . ".</td>";
                                    echo "<td>" . $row2['NAMA'] . "</td>";
                                    echo "<td>" . $row2['ALAMAT'] . "</td>";
                                    echo "<td>" . $row2['URAIAN_NEGARA'] . "</td>";
                                    // echo "<td align= ''>
                                    // <a href='#' data-toggle='modal' data-target='#myModal$row2[ID]' title='Edit' class='btn btn-success' title='View the Report'><i class='mdi mdi-table-edit'></i> Edit</a>
                                    // <a href='#' data-toggle='modal' data-target='#del$row2[ID]' title='Delete' class='btn btn-danger' title='View the Report'><i class='fas fa-trash-alt'></i> Delete</a>
                                    // </td>";
                                    echo "</tr>";
                            ?>
                            <?php }
                            } ?>
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
<?php include "include/pusat_bantuan.php"; ?>
<?php include "include/riwayat_aktifitas.php"; ?>
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>