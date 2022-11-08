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
    <title>BC 2.7 PLB App Name | Company </title>
<?php } else { ?>
    <title>BC 2.7 PLB - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
        <?= $resultHeadSetting['title'] ?></title>
<?php } ?>
<?php
// DELETE DATA NOMOR AJU PLB
if (isset($_POST["Delete_"])) {
    $NOMOR_AJU  = $_POST['ID'];
    // plb_header
    $query      = $dbcon->query('DELETE FROM plb_header WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_bahanbaku
    $query      .= $dbcon->query('DELETE FROM plb_bahanbaku WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_bahanbakudokumen
    $query      .= $dbcon->query('DELETE FROM plb_bahanbakudokumen WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_bahanbakutarif
    $query      .= $dbcon->query('DELETE FROM plb_bahanbakutarif WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barang
    $query      .= $dbcon->query('DELETE FROM plb_barang WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barang_ct
    $query      .= $dbcon->query('DELETE FROM plb_barang_ct WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barang_ct_botol
    $query      .= $dbcon->query('DELETE FROM plb_barang_ct_botol WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barangdokumen
    $query      .= $dbcon->query('DELETE FROM plb_barangdokumen WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_barangtarif
    $query      .= $dbcon->query('DELETE FROM plb_barangtarif WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_dokumen
    $query      .= $dbcon->query('DELETE FROM plb_dokumen WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_kemasan
    $query      .= $dbcon->query('DELETE FROM plb_kemasan WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_kontainer
    $query      .= $dbcon->query('DELETE FROM plb_kontainer WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_respon
    $query      .= $dbcon->query('DELETE FROM plb_respon WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');
    // plb_status
    $query      .= $dbcon->query('DELETE FROM plb_status WHERE NOMOR_AJU_PLB="' . $NOMOR_AJU . '"');
    // plb_update_log
    $query      .= $dbcon->query('DELETE FROM plb_update_log WHERE NOMOR_AJU="' . $NOMOR_AJU . '"');

    if ($query) {
        echo "<script>window.location.href='report_ck5_plb.php?DeleteSuccess=true;</script>";
    } else {
        echo "<script>window.location.href='report_ck5_plb.php?DeleteFailed=true;</script>";
    }
}
?>
<?php
// TOTAL BC PLB
$dataBCPLB = $dbcon->query("SELECT COUNT(*) AS total_bc_plb FROM plb_header");
$resultBCPLB = mysqli_fetch_array($dataBCPLB);
if ($resultBCPLB['total_bc_plb'] == NULL) {
    $resultBCPLB_show = 0;
} else {
    $resultBCPLB_show = $resultBCPLB['total_bc_plb'];
}

$Limit      = '100';
$NomorAJU   = '';
if (isset($_POST['find'])) {
    if ($_POST["Limit"] != '') {
        $Limit   = $_POST['Limit'];
    }

    if ($_POST["NomorAJU"] != '') {
        $NomorAJU   = $_POST['NomorAJU'];
    }
}
?>
<style>
    .sm {
        max-width: 471pxpx;
        margin: 16.75rem auto;
        width: 549px;
    }

    .alert {
        padding: 20px;
        background-color: #ff5b57;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fas fa-file-upload icon-page"></i>
                <font class="text-page">UPLOAD BC 2.7 PLB</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Index</a></li>
                <li class="breadcrumb-item"><a href="index_viewdataonline.php">Data Online</a></li>
                <li class="breadcrumb-item active">Upload BC 2.7 PLB</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i> <span id=""><?= date_indo(date('Y-m-d'), TRUE) ?> - <font style="text-transform: uppercase;"><?= date('h:m:i a') ?></font></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- UPLOAD CK5PLB -->
    <div class="row">
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Upload BC 2.7 PLB</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <form action="report_ck5_plb_upload.php" method="post" enctype="multipart/form-data" style="margin: 142px 0px 142px 0px;">
                        <div style="display: flex;justify-content: center;align-items: center;">
                            <div style="display: flex;justify-content: center;">
                                <img src="assets/img/svg/upload-animate.svg" class="image" width="80%">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload Excel File BC 2.7 PLB:</label>
                                        <input type="hidden" class="form-control" name="username" value="<?= $_SESSION['username'] ?>" required>
                                        <input type="file" class="form-control" name="file_upload" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-block btn-outline-secondary" value="Upload" style="margin-top: -10px;"><i class="fas fa-upload"></i> Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END UPLOAD CK5PLB -->
        <!-- begin row -->
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> Data BC 2.7 PLB</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <!-- begin alert -->
                <div class="alert alert-secondary fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>Menampilkan <b>Limit <?= $Limit; ?> Nomor Pengajuan PLB</b> terakhir. Silahkan tambah Limit Nomor Pengajuan PLB pada form Limit.<br> Total Nomor Pengajuan PLB pada Sistem sebanyak <b><?= $resultBCPLB_show ?> Nomor Pengajuan PLB.</b></p>
                </div>
                <!-- end alert -->
                <!-- Form -->
                <div class="panel-body text-inverse">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input id="IDLimit" name="Limit" type="number" class="form-control" value="<?= $Limit ?>" placeholder="Limit ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input id="IDNomorAJU" name="NomorAJU" type="text" class="form-control" value="<?= $NomorAJU ?>" placeholder="Nomor Pengajuan ...">
                                </div>
                            </div>
                            <div class="col-sm-12" style="justify-content: end;">
                                <button type="submit" name="find" class="btn btn-info" style="margin-top: -10px;margin-bottom: -10px;">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                                <a href="report_ck5_plb.php" class="btn btn-warning" style="margin-top: -10px;margin-bottom: -10px;">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                    <!-- End Form -->
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%">#</th>
                                    <th class="text-nowrap no-sort" style="text-align: center;">Aksi</th>
                                    <th class="text-nowrap" style="text-align: center;">Nomor Pengajuan</th>
                                    <th class="text-nowrap" style="text-align: center;">Pemilik</th>
                                    <th class="text-nowrap" style="text-align: center;">Tujuan/Penerima</th>
                                    <th class="text-nowrap" style="text-align: center;">Jumlah Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_POST['find'])) {
                                    $dataTable = $dbcon->query("SELECT * FROM plb_header WHERE NOMOR_AJU='" . $_POST['NomorAJU'] . "' ORDER BY ID DESC LIMIT " . $_POST['Limit'] . "", 0);
                                } else {
                                    $dataTable = $dbcon->query("SELECT * FROM plb_header ORDER BY ID DESC LIMIT 100", 0);
                                }
                                if ($dataTable) : $no = 1;
                                    foreach ($dataTable as $row) :
                                ?>
                                        <tr>
                                            <td width="1%" class="f-s-600 text-inverse"><?= $no ?>.</td>
                                            <td style="text-align: center;">
                                                <?php if ($row['CEK_BARANG'] == NULL) { ?>
                                                    <a href="#delete<?= $row['ID'] ?>" class="btn btn-danger" data-toggle="modal" title="Tambah Kuota Mitra"><i class="fas fa-backspace"></i></a>
                                                <?php } else { ?>
                                                    <button class="btn btn-sm btn-aksi btn-secondary" style="color:#fff;cursor:pointer" title="Disabled"><i class="fas fa-backspace"></i></button>
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;"><?= $row['NOMOR_AJU'] ?></td>
                                            <td style="text-align: center;"><?= $row['PERUSAHAAN'] ?></td>
                                            <td style="text-align: center;"><?= $row['NAMA_PENERIMA_BARANG'] ?></td>
                                            <td style="text-align: center;"><?= $row['JUMLAH_BARANG'] ?></td>
                                        </tr>

                                        <!-- Delete -->
                                        <div class="modal fade" id="delete<?= $row['ID'] ?>">
                                            <div class="modal-dialog sm">
                                                <div class="modal-content">
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">[Delete] Data BC 2.7 PLB</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <fieldset>
                                                                <div class="alert">
                                                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                                                    <strong>Danger!</strong> Anda yakin ingin menghapus data ini?
                                                                    <input type="hidden" name="ID" value="<?= $row['NOMOR_AJU'] ?>">
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="javascript:;" class="btn btn-white" data-dismiss="modal"><i class="fas fa-times-circle"></i> Tidak</a>
                                                            <button type="submit" name="Delete_" class="btn btn-danger"><i class="fas fa-box-open"></i> Ya</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Delete -->
                                    <?php
                                        $no++;
                                    endforeach
                                    ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="17">
                                            <center>
                                                <div style="display: grid;">
                                                    <i class="far fa-times-circle no-data"></i> Tidak ada data
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
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
<?php include "include/pusat_bantuan.php"; ?>
<?php include "include/riwayat_aktifitas.php"; ?>
<?php include "include/panel.php"; ?>
<?php include "include/footer.php"; ?>
<?php include "include/jsDatatables.php"; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "lengthMenu": [5, 10, 15, 20, 25, 30, 35, 40, 45, 50],
            "pageLength": 5
        });
    });

    // DELETE
    function deleteData(NOMOR_AJU) {
        var r = confirm("Are you sure you want to delete this record?");
        if (r == true) {
            location.href = "data_proses.php?a=delete&m=report_ck5_plb&NOMOR_AJU=" + NOMOR_AJU;
        }
    }

    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UploadSuccess') > -1) {
        Swal.fire({
            title: 'Data Berhasil Diupload!',
            icon: 'success',
            text: 'Data berhasil diupload!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
    }
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UploadFailed') > -1) {
        Swal.fire({
            title: 'Data Gagal Diupload!',
            icon: 'error',
            text: 'Data gagal diupload!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
    }

    // DELETE SUCCESS
    if (window?.location?.href?.indexOf('DeleteSuccess') > -1) {
        Swal.fire({
            title: 'Data Berhasil Dihapus!',
            icon: 'success',
            text: 'Data berhasil dihapus!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
    }
    // DELETE FAILED
    if (window?.location?.href?.indexOf('DeleteFailed') > -1) {
        Swal.fire({
            title: 'Data Gagal Dihapus!',
            icon: 'error',
            text: 'Data gagal dihapus!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
    }

    // UPLOAD ALREADY
    if (window?.location?.href?.indexOf('UploadAlready') > -1) {
        Swal.fire({
            title: 'Data Sudah Tersedia!',
            icon: 'info',
            text: 'Ada Data dengan Nomor Pengajuan yang sama!'
        })
        history.replaceState({}, '', './report_ck5_plb.php');
    }
</script>