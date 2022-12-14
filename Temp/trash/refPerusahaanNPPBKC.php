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
$content = get_content($resultAPI['url_api'] . 'refPerusahaanNPPBKC.php?id=' . $_GET['id'] . '&NPWP=' . $_GET['NPWP']);
$data = json_decode($content, true);

// UPDATE NPPBKC
if (isset($_POST["add_nppbkc"])) {

    $IDUNIQ                   = $_POST['UNIQID'];
    $IDNPWP                   = $_POST['UNIQNWPW'];
    $NameNPPBKC               = $_POST['NameNPPBKC'];

    $query = get_content($resultAPI['url_api'] . 'refPerusahaanNPPBKC_add.php?id=' . $IDUNIQ . '&NPWP=' . $IDNPWP . '&NPPBKC=' . $NameNPPBKC);

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Referensi/Perusahaan';
    $InputDescription     = $me . " Update Data: " .  $UpdateNameDepartment . ", Simpan Data Sebagai Log Referensi Perusahaan";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d H:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='ref_perusahaan.php?UpdateSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='ref_perusahaan.php?UpdateFailed=true';</script>";
    }
}
// END UPDATE NPPBKC
?>
<?php if ($resultHeadSetting['app_name'] == NULL || $resultHeadSetting['company'] == NULL || $resultHeadSetting['title'] == NULL) { ?>
    <title>NPPBKC Perusahaan App Name | Company </title>
<?php } else { ?>
    <title>NPPBKC Perusahaan - <?= $resultHeadSetting['app_name'] ?> | <?= $resultHeadSetting['company'] ?> -
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
                <li class="breadcrumb-item active">Perusahaan</li>
            </ol>
        </div>
        <div>
            <button class="btn btn-primary-css"><i class="fas fa-calendar-alt"></i>
                <span><?= date_indo(date('Y-m-d'), TRUE); ?> <?= date('H:i A') ?></span></button>
        </div>
    </div>
    <div class="line-page"></div>
    <!-- BACK -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-icons-1" style="padding: 15px;">
                <a href="ref_perusahaan.php" class="btn btn-dark"><i class="fas fa-caret-square-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <!-- END BACK -->
    <!-- begin row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="panel panel-inverse" data-sortable-id="ui-perusahaan">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Referensi] Perusahaan</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php if ($data['status'] == 404) { ?>
                        <center>
                            <div style="display: grid;">
                                <i class="far fa-times-circle no-data"></i> Tidak ada data
                            </div>
                        </center>
                    <?php } else { ?>
                        <?php foreach ($data['result'] as $row) { ?>
                            <form action="" method="POST" id="myForm">
                                <div class="modal-body">
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="IdCARTON">NPWP</label>
                                                    <input type="text" class="form-control" placeholder="NPWP" value="<?= $row['NPWP']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="IdLITER">Nama</label>
                                                    <input type="text" class="form-control" value="<?= $row['NAMA'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="IdLITER">NPPBKC <font style="color: red;">*</font></label>
                                                    <input type="text" class="form-control" name="NameNPPBKC" id="IDNPPBKC" placeholder="NPPBKC" required>
                                                    <input type="hidden" class="form-control" name="UNIQID" value="<?= $_GET['id'] ?>">
                                                    <input type="hidden" class="form-control" name="UNIQNWPW" value="<?= $_GET['NPWP'] ?>">
                                                    <input type="hidden" class="form-control" name="UNIQNAMA" value="<?= $row['NAMA'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <font style="color: red;">*</font> <i>Wajib diisi.</i>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="modal-footer" style="margin-bottom: -15px;">
                                    <a href="javascript:;" class="btn btn-yellow" onclick="myFunction()"><i class="fas fa-refresh"></i> Reset</a>
                                    <button type="submit" name="add_nppbkc" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </form>
                        <?php } ?>
                    <?php } ?>

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
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
    // NO KK
    var numberMask = IMask(
        document.getElementById('IDNPPBKC'), {
            mask: '0000.000000',
        });

    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil diupdate!',
            icon: 'success',
            text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './ref_perusahaan.php');
    }
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupdate!',
            icon: 'error',
            text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './ref_perusahaan.php');
    }
    // RESET
    function myFunction() {
        document.getElementById("myForm").reset();
    }
</script>