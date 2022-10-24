<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/alert.php";
include "include/top-header.php";
include "include/top-sidebar.php";
// include "include/sidebar.php";
include "include/cssDatatables.php";
include "include/cssForm.php";
?>
<!-- begin #content -->
<div id="content" class="nav-top-content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-desktop icon-page"></i>
                <font class="text-page">CK5 / PLB REPORT</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_report.php">Report</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">CK5</a></li>
                <li class="breadcrumb-item active">PLB Records</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:m:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- begin row -->
    <style>
    #id-fr {
        background: #fff;
        border-radius: 5px;
        /* margin-right: -10px; */
        margin-bottom: 10px;
        padding: 15px;
        font-size: 60px;
        display: grid;
        justify-content: center;
        align-content: center;
        color: #1d2226;
    }

    #id-fl {
        background: #fff;
        border-radius: 5px;
        /* margin-left: -10px; */
        margin-bottom: 10px;
        padding: 15px;
        font-size: 60px;
        display: grid;
        justify-content: center;
        align-content: center;
        color: #1d2226;
    }
    </style>
    <div class="row">
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <a href="https://itinventory-sarinah.com/report_ck5_plb_data.php" id="id-fr">
                    <i class="fa-solid fa-table"></i>
                    <font style="font-size: 9px; margin-top: 9px">Data CK5 PLB</font>
                </a>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <a href="http://plb.itinventory-sarinah.com:8091/report_ck5_plb.php" id="id-fl">
                    <i class="fa-solid fa-upload"></i>
                    <font style="font-size: 8px; margin-top: 10px">Upload CK5 PLB</font>
                </a>
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
<?php include "include/jsForm.php"; ?>

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


// TableHeader
$(document).ready(function() {
    $('#TableHeader').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBahanBaku
$(document).ready(function() {
    $('#TableBahanBaku').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBahanBakuTarif
$(document).ready(function() {
    $('#TableBahanBakuTarif').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBahanBakuDokumen
$(document).ready(function() {
    $('#TableBahanBakuDokumen').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBarang
$(document).ready(function() {
    $('#TableBarang').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBarangTarif
$(document).ready(function() {
    $('#TableBarangTarif').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableBarangDokumen
$(document).ready(function() {
    $('#TableBarangDokumen').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableDokumen
$(document).ready(function() {
    $('#TableDokumen').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableKemasan
$(document).ready(function() {
    $('#TableKemasan').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableKontainer
$(document).ready(function() {
    $('#TableKontainer').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableRespon
$(document).ready(function() {
    $('#TableRespon').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableStatus
$(document).ready(function() {
    $('#TableStatus').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
// TableLog
$(document).ready(function() {
    $('#TableLog').DataTable({
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