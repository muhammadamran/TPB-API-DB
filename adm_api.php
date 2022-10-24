<?php
include "include/connection.php";
include "include/restrict.php";
include "include/head.php";
include "include/top-header.php";
include "include/sidebar.php";
?>
<?php
// Saved
if (isset($_POST["SaveAPInDB"])) {

    $ID                = $_POST['ID'];
    $url_api           = $_POST['url_api'];
    $user_api          = $_POST['user_api'];
    $pass_api          = md5($_POST['pass_api']);
    $port_api          = $_POST['port_api'];
    $database_module   = $_POST['database_module'];

    $query = $dbcon->query("UPDATE api SET url_api='$url_api',
                                           user_api='$user_api',
                                           pass_api='$pass_api',
                                           port_api='$port_api',
                                           database_module='$database_module'
                            WHERE id='$ID'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengatuan RealTime Reload';
    $InputDescription     = $me . " Update Data API & Database: " .  $query . ", Simpan Data Sebagai Log API & Database";
    $InputAction          = 'Update';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_api.php?SaveSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_api.php?SaveFailed=true';</script>";
    }
}

// Update
if (isset($_POST["EditAPInDB"])) {

    $ID                = $_POST['ID'];
    $url_api           = $_POST['url_api'];
    $user_api          = $_POST['user_api'];
    $pass_api          = md5($_POST['pass_api']);
    $port_api          = $_POST['port_api'];
    $database_module   = $_POST['database_module'];

    $query = $dbcon->query("UPDATE api SET url_api='$url_api',
                                           user_api='$user_api',
                                           pass_api='$pass_api',
                                           port_api='$port_api',
                                           database_module='$database_module'
                            WHERE id='$ID'");

    // FOR AKTIFITAS
    $me = $_SESSION['username'];
    $datame = $dbcon->query("SELECT * FROM view_privileges WHERE USER_NAME='$me'");
    $resultme = mysqli_fetch_array($datame);

    $IDUNIQme             = $resultme['USRIDUNIQ'];
    $InputUsername        = $me;
    $InputModul           = 'Administrator Tools/Pengatuan RealTime Reload';
    $InputDescription     = $me . " Insert Data API & Database: " .  $reload . ", Simpan Data Sebagai Log API & Database";
    $InputAction          = 'Insert';
    $InputDate            = date('Y-m-d h:m:i');

    $query .= $dbcon->query("INSERT INTO tbl_aktifitas
                           (id,IDUNIQ,username,modul,description,action,date_created)
                           VALUES
                           ('','$IDUNIQme','$InputUsername','$InputModul','$InputDescription','$InputAction','$InputDate')");

    if ($query) {
        echo "<script>window.location.href='adm_api.php?UpdateSuccess=true';</script>";
    } else {
        echo "<script>window.location.href='adm_api.php?UpdateFailed=true';</script>";
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
                <li class="breadcrumb-item active">API & Database</li>
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
                    <h4 class="panel-title"><i class="fas fa-info-circle"></i> [Administrator Tools] API & Database</h4>
                    <?php include "include/panel-row.php"; ?>
                </div>
                <div class="panel-body text-inverse">
                    <?php
                    $data = $dbcon->query("SELECT * FROM api");
                    $row = mysqli_fetch_array($data);
                    ?>
                    <?php if ($row['id'] == NULL) { ?>
                        <form action="" method="POST">
                            <fieldset>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">URL API</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="url_api" value="<?= $row['url_api'] ?>" placeholder="URL API ...">
                                        <input type="hidden" class="form-control" name="ID" value="<?= $row['id'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">User API</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="user_api" value="<?= $row['user_api'] ?>" placeholder="User API ...">
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">Pass API</label>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="pass_api" value="<?= $row['pass_api'] ?>" placeholder="Pass API ...">
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">Port API</label>
                                    <div class="col-md-7">
                                        <input type="number" class="form-control" name="port_api" value="<?= $row['port_api'] ?>" placeholder="Port API ...">
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">Database</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="database_module" value="<?= $row['database_module'] ?>" placeholder="Database ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-7 offset-md-3">
                                        <?php if ($resultForPrivileges['INSERT_DATA'] == 'Y') { ?>
                                            <button type="submit" class="btn btn-primary m-r-5" name="EditAPInDB"><i class="fa fa-save"></i> Simpan</button>
                                        <?php } ?>
                                        <button type="submit" class="btn btn-success m-r-5" name="TestConnect"><i class="fa-solid fa-satellite-dish"></i> Test</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    <?php } else { ?>
                        <form action="" method="POST">
                            <fieldset>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">URL API</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="url_api" value="<?= $row['url_api'] ?>" placeholder="URL API ...">
                                        <input type="hidden" class="form-control" name="ID" value="<?= $row['id'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">User API</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="user_api" value="<?= $row['user_api'] ?>" placeholder="User API ...">
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">Pass API</label>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="pass_api" value="<?= $row['pass_api'] ?>" placeholder="Pass API ...">
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">Port API</label>
                                    <div class="col-md-7">
                                        <input type="number" class="form-control" name="port_api" value="<?= $row['port_api'] ?>" placeholder="Port API ...">
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-3 col-form-label">Database</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control" name="database_module" value="<?= $row['database_module'] ?>" placeholder="Database ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-7 offset-md-3">
                                        <?php if ($resultForPrivileges['UPDATE_DATA'] == 'Y') { ?>
                                            <button type="submit" class="btn btn-warning m-r-5" name="SaveAPInDB"><i class="fa fa-edit"></i> Update</button>
                                        <?php } ?>
                                        <button type="submit" class="btn btn-success m-r-5" name="TestConnect"><i class="fa-solid fa-satellite-dish"></i> Test</button>
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
        history.replaceState({}, '', './adm_api.php');
    }
    // SAVED FAILED
    if (window?.location?.href?.indexOf('SaveFailed') > -1) {
        Swal.fire({
            title: 'Data gagal disimpan!',
            icon: 'error',
            text: 'Data gagal disimpan didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_api.php');
    }

    // UPDATE SUCCESS
    if (window?.location?.href?.indexOf('UpdateSuccess') > -1) {
        Swal.fire({
            title: 'Data berhasil diupdate!',
            icon: 'success',
            text: 'Data berhasil diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_api.php');
    }
    // UPDATE FAILED
    if (window?.location?.href?.indexOf('UpdateFailed') > -1) {
        Swal.fire({
            title: 'Data gagal diupdate!',
            icon: 'error',
            text: 'Data gagal diupdate didalam <?= $alertAppName ?>!'
        })
        history.replaceState({}, '', './adm_api.php');
    }
</script>