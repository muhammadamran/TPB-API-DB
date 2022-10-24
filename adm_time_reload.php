<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/top-header.php";
include "include/sidebar.php";
?>
<?php
// Saved
if (isset($_POST["SaveReload"])) {

    $reload                 = $_POST['reload'];

    $query = $dbcon->query("UPDATE tbl_realtime SET reload='$reload'
                                                   WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengatuan RealTime Reload';
    $InputDescription     = $me . " Update Data RealTime Reload: " .  $query . ", Simpan Data Sebagai Log Pengaturan RealTime Reload";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_time_reload.php?SaveSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_time_reload.php?SaveFailed=true';</script>";
    }
}

// Update
if (isset($_POST["EditReload"])) {

    $reload                 = $_POST['reload'];

    $query = $dbcon->query("UPDATE tbl_realtime SET reload='$reload'
                                                   WHERE id='1'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengatuan RealTime Reload';
    $InputDescription     = $me . " Insert Data RealTime Reload: " .  $reload . ", Simpan Data Sebagai Log Pengaturan RealTime Reload";
    $InputAction          = 'Insert';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_time_reload.php?UpdateSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_time_reload.php?UpdateFailed=true';</script>";
    }
}
?>
<!-- begin #content -->
<div id="content" class="content">
    <div class="page-title-css">
        <div>
            <h1 class="page-header-css">
                <i class="fab fa-adn icon-page"></i>
                <font class="text-page">Administrator Tools</font>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index_viewonline.php">View Data Online</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">Administrator Tools</a></li>
                <li class="breadcrumb-item active">Pengaturan RealTime Reload</li>
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
            <div class="panel panel-inverse" data-sortable-id="data-table">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Administrator Tools] Pengaturan RealTime Reload</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php
                    $data = $dbcon->query("SELECT * FROM tbl_realtime");
                    $row = mysqli_fetch_array($data);
                    ?>
                    <?php if ($row['id'] == NULL) { ?>
                        <form action="" method="POST">
                            <fieldset>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">Time Second</label>
                                    <div class="col-md-7">
                                        <input type="number" class="form-control" name="reload" value="<?= $row['reload'] ?>" placeholder="Time Second ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-7 offset-md-3">
                                        <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                                            <button type="submit" class="btn btn-primary m-r-5" name="EditReload"><i class="fa fa-save"></i> Simpan</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    <?php } else { ?>
                        <form action="" method="POST">
                            <fieldset>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">Time Second</label>
                                    <div class="col-md-7">
                                        <input type="number" class="form-control" name="reload" value="<?= $row['reload'] ?>" placeholder="Time Second ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-7 offset-md-3">
                                        <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                            <button type="submit" class="btn btn-warning m-r-5" name="SaveReload"><i class="fa fa-edit"></i> Update</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    <?php } ?>
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
<script type="text/javascript">
    // SAVED SUCCESS
    if (window?.location?.href?.indexOf('SaveSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil disimpan!',
            icon: 'success',
            text: 'Data berhasil disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_time_reload.php');
    }
    // SAVED FAILED
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_time_reload.php');
    }

    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil diupdate!',
            icon: 'success',
            text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_time_reload.php');
    }
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupdate!',
            icon: 'error',
            text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_time_reload.php');
    }
</script>